<?php


namespace App\Controller;


use App\Admin\AppDespachoAlmacenAdmin;
use App\Entity\DespachoAlmacen\AppDespachoAlmacen;
use App\Entity\DespachoAlmacen\AppDespachoAlmacenOrdenServicio;
use DateTime;
use Doctrine\ORM\EntityManager;
use Exception;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DespachoAlmacenController
 * @package App\Controller
 */
class DespachoAlmacenController extends CRUDController
{
    /** @var AppDespachoAlmacenAdmin */
    protected $admin;

    /**
     * @param string $fecha
     * @return Response
     * @throws Exception
     */
    public function despachoAction(string $fecha)
    {
        $fecha = new DateTime($fecha);
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        /** @var AppDespachoAlmacen $object */
        $object = $em->getRepository(AppDespachoAlmacen::class)->findOneBy(['fecha' => $fecha]);

        # Si no existe creo la oder de despacho al entrar al link
        if (!$object) {
            $this->admin->setSubject($object);
            # Creando el nuevo despacho automáticamente
            $object = new AppDespachoAlmacen();
            $object->setFecha($fecha);
            $object->setUsuarioCreador($this->admin->user);
            $object->setOffice($this->admin->user->getOffice());
            $em->persist($object);
            $em->flush();
        }

        /** @var $list_orden_servicio AppDespachoAlmacenOrdenServicio[] */
        $list_orden_servicio = null;

        return $this->renderWithExtraParams('::Admin\DespachoAlmacen\despacho.html.twig', [
            'object' => $object,
            'list_orden_servicio' => $list_orden_servicio,
        ]);
    }

}