<?php

namespace App\Controller;

use FOS\UserBundle\Form\Factory\FormFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;

/**
 * Class BackupsController
 * @package App\Controller
 */
class BackupsController
{
    private $twig;
    private $container;
    private $router;

    /**
     * DemoController constructor.
     * @param Environment $twig
     * @param ContainerInterface $container
     * @param RouterInterface $router
     */
    public function __construct(Environment $twig, ContainerInterface $container, RouterInterface $router)
    {
        $this->twig = $twig;
        $this->container = $container;
        $this->router = $router;
    }


    /**
     * @Route("/admin/backups", name="admin_backups")
     *
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index()
    {
        return new Response(
            $this->twig->render('backups/index.html.twig', array()),
            200, array('Content-Type' => 'text/html')
        );

    }

    /**
     * @Route("/admin/backups/export", name="admin_backups_export")
     *
     */
    public function exportarAction()
    {
        $conexData = $this->container->get('doctrine')->getConnection()->getParams();

        //ENTER THE RELEVANT INFO BELOW
        $user = $conexData['user'];
        $pass = $conexData['password'];
        $host = $conexData['host'];
        $name = $conexData['dbname'];
        $backup_name = "backup_" . date('Y-m-d') . ".sql";
        $tables = false;

        $contentInicio = "/*
Source Server         : $host
Source Server Version : {$conexData['serverVersion']}
Source Host           : $host:3306
Source Database       : $name
Charset               : {$conexData['defaultTableOptions']['charset']}
Collate               : {$conexData['defaultTableOptions']['collate']}

Date: " . date('Y-m-d H:m:s') . "
*/

SET FOREIGN_KEY_CHECKS=0;

";

        $mysqli = new \mysqli($host, $user, $pass, $name);
        $mysqli->select_db($name);
        $mysqli->query("SET NAMES 'utf8'");

        $target_tables = array();
        $queryTables = $mysqli->query('SHOW TABLES');
        while ($row = $queryTables->fetch_row()) {
            $target_tables[] = $row[0];
        }
        if ($tables !== false) {
            $target_tables = array_intersect($target_tables, $tables);
        }

        $content = '';
        foreach ($target_tables as $table) {
            $result = $mysqli->query('SELECT * FROM ' . $table);
            $fields_amount = $result->field_count;
            $rows_num = $mysqli->affected_rows;
            $res = $mysqli->query('SHOW CREATE TABLE ' . $table);
            $TableMLine = $res->fetch_row();
            $dropTable = "DROP TABLE IF EXISTS $table;";
            $content = (!isset($content) ? '' : $content) . $dropTable . "\n" . $TableMLine[1] . ";\n\n";

            for ($i = 0, $st_counter = 0; $i < $fields_amount; $i++, $st_counter = 0) {
                while ($row = $result->fetch_row()) { //when started (and every after 100 command cycle):
                    if ($st_counter % 100 == 0 || $st_counter == 0) {
                        $content .= "\nINSERT INTO " . $table . " VALUES";
                    }
                    $content .= "\n(";
                    for ($j = 0; $j < $fields_amount; $j++) {
                        $row[$j] = str_replace("\n", "\\n", addslashes($row[$j]));
                        if (isset($row[$j])) {
                            $content .= '"' . $row[$j] . '"';
                        } else {
                            $content .= '""';
                        }
                        if ($j < ($fields_amount - 1)) {
                            $content .= ',';
                        }
                    }
                    $content .= ")";
                    //every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
                    if ((($st_counter + 1) % 100 == 0 && $st_counter != 0) || $st_counter + 1 == $rows_num) {
                        $content .= ";";
                    } else {
                        $content .= ",";
                    }
                    $st_counter = $st_counter + 1;
                }
            }
            $content .= "\n\n\n";
        }

        $backup_name = $backup_name ? $backup_name : $name . ".sql";

        return new Response(
            $contentInicio . $content,
            200, array(
                'Content-Type' => 'application/octet-stream',
                'Content-Transfer-Encoding' => 'Binary',
                'Content-disposition' => "attachment; filename=\"" . $backup_name . "\"",
            )
        );
    }

    /**
     * @Route("/admin/backups/import", name="admin_backups_import")
     *
     */
    public function importarAction(Request $request)
    {
        $conexData = $this->container->get('doctrine')->getConnection()->getParams();

        //ENTER THE RELEVANT INFO BELOW
        $user = $conexData['user'];
        $pass = $conexData['password'];
        $host = $conexData['host'];
        $name = $conexData['dbname'];
        $filename  = $request->files->get('import_file');

        $fileName = 'import.'.'sql';
        $uploadDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/importSql/';
        $filename->move($uploadDir, $fileName);

        $mysqli = new \mysqli($host,$user,$pass,$name);
        $mysqli->select_db($name);
        $mysqli->query("SET NAMES 'utf8'");
//        $mysqli->begin_transaction();
        // Temporary variable, used to store current query
        $templine = '';
        // Read in entire file
        $lines = file($uploadDir.$fileName);
        // Loop through each line
        foreach ($lines as $line)
        {
            // Skip it if it's a comment
            if (substr($line, 0, 2) == '--' || $line == '')
                continue;

            // Add this line to the current segment
            $templine .= $line;
            // If it has a semicolon at the end, it's the end of the query
            if (substr(trim($line), -1, 1) == ';')
            {
                // Perform the query
                $mysqli->query($templine);
                // Reset temp variable to empty
                $templine = '';
            }
        }
//        $mysqli->commit();
        $mysqli->close();

        return new RedirectResponse($this->router->generate('admin_backups'));
    }
}
