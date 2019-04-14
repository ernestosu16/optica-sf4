<?php
/**
 * Created by PhpStorm.
 * User: Carlos
 * Date: 02/03/2017
 * Time: 01:13 PM
 */

namespace  App\Auditoria\Twig\Extension;
use  App\Auditoria\Entity\AuditoriaLog;
use Twig_Environment;
use Twig_Error_Loader;
use Twig_Error_Runtime;
use Twig_Error_Syntax;
use Twig_Extension;

class AuditoriaExtension extends Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        $defaults = [
            'is_safe' => ['html'],
            'needs_environment' => true,
        ];
        return [
            new \Twig_SimpleFunction('audit', [$this, 'audit'], $defaults),
            new \Twig_SimpleFunction('audit_value', [$this, 'value'], $defaults),
            new \Twig_SimpleFunction('audit_assoc', [$this, 'assoc'], $defaults),
            new \Twig_SimpleFunction('audit_blame', [$this, 'blame'], $defaults),
        ];
    }

    /**
     * @param Twig_Environment $twig
     * @param AuditoriaLog $log
     * @return string
     * @throws Twig_Error_Loader
     * @throws Twig_Error_Runtime
     * @throws Twig_Error_Syntax
     */
    public function audit(Twig_Environment $twig, AuditoriaLog $log)
    {
        return $twig->render("app/auditoria/{$log->getAction()}.html.twig", compact('log'));
    }

    /**
     * @param Twig_Environment $twig
     * @param $assoc
     * @return string
     * @throws Twig_Error_Loader
     * @throws Twig_Error_Runtime
     * @throws Twig_Error_Syntax
     */
    public function assoc(Twig_Environment $twig, $assoc)
    {
        return $twig->render("app/auditoria/assoc.html.twig", compact('assoc'));
    }

    /**
     * @param Twig_Environment $twig
     * @param $blame
     * @return string
     * @throws Twig_Error_Loader
     * @throws Twig_Error_Runtime
     * @throws Twig_Error_Syntax
     */
    public function blame(Twig_Environment $twig, $blame)
    {
        return $twig->render("app/auditoria/blame.html.twig", compact('blame'));
    }

    /**
     * @param Twig_Environment $twig
     * @param $val
     * @return false|string
     * @throws Twig_Error_Loader
     * @throws Twig_Error_Runtime
     * @throws Twig_Error_Syntax
     */
    public function value(Twig_Environment $twig, $val)
    {
        switch (true) {
            case is_bool($val):
                return $val ? 'true' : 'false';
            case is_array($val) && isset($val['fk']):
                return $this->assoc($twig, $val);
            case is_array($val):
                return json_encode($val);
            case is_string($val):
                return strlen($val) > 60 ? substr($val, 0, 60) . '...' : $val;
            case is_null($val):
                return 'NULL';
            default:
                return $val;
        }
    }
    public function getName()
    {
        return 'app_auditoria_extension';
    }
}