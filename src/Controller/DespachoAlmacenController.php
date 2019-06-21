<?php


namespace App\Controller;


use App\Entity\DespachoAlmacen\AppDespachoAlmacen;
use DateTime;
use Doctrine\ORM\EntityManager;
use Exception;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DespachoAlmacenController extends CRUDController
{
    /**
     * @param string $fecha
     * @return Response
     * @throws Exception
     */
    public function despachoAction(string $fecha)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        /** @var AppDespachoAlmacen $object */
        $object = $em->getRepository(AppDespachoAlmacen::class)->findBy(['fecha' => new DateTime($fecha)]);

        if ($object === null) {
            $this->admin->setSubject($object);
            $object = new AppDespachoAlmacen();
        }


        return $this->renderWithExtraParams('::Admin\DespachoAlmacen\despacho.html.twig');
    }
}