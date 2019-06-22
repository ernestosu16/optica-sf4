<?php


namespace App\Controller;


use App\Admin\AppDespachoAlmacenAdmin;
use App\Entity\AppOrdenServicio;
use App\Entity\DespachoAlmacen\AppDespachoAlmacen;
use App\Entity\DespachoAlmacen\AppDespachoAlmacenOrdenServicio;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Exception;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AppCorteMontajeController extends CRUDController
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
        $this->admin->user = $this->getUser();

        /** @var AppDespachoAlmacen $object */
        $object = $em->getRepository(AppDespachoAlmacen::class)->findOneBy(['fecha' => $fecha]);


        /** @var $list_orden_servicio AppDespachoAlmacenOrdenServicio[] */
        $list_orden_servicio = $em
            ->getRepository(AppOrdenServicio::class)
            ->listaOrdenServicioPorFecha($fecha, $this->admin->user->getOffice());

        return $this->renderWithExtraParams('::Admin\CorteMontaje\despacho.html.twig', [
            'object' => $object,
            'list_orden_servicio' => $list_orden_servicio,
        ]);
    }

    /**
     * @param $id
     * @return RedirectResponse
     * @throws ORMException
     */
    public function confirmarCorteMontajeAction($id)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        /** @var AppDespachoAlmacenOrdenServicio $despachoOrdenServicio */
        $despachoOrdenServicio = $em->getReference(AppDespachoAlmacenOrdenServicio::class, $id);

        $despachoOrdenServicio->setMontaje(true);

        $em->flush();

        return $this->redirect($this->admin->generateUrl('despacho', [
            'fecha' => $despachoOrdenServicio->getDespachoAlmacen()->getFecha()->format('Y-m-d')
        ]));
    }
}