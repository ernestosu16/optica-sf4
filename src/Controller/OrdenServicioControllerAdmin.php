<?php


namespace App\Controller;


use App\Entity\AppOrdenServicio;
use App\Entity\AppReceta;
use App\Entity\MovimientoAlmacen\Alamacen;
use App\Entity\SecurityUser;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OrdenServicioControllerAdmin extends CRUDController
{
    private function getNuevoNumeroFactura(AppOrdenServicio $object)
    {
        if ($object->getId()) {
            return $object->getNumero();
        }
        /** @var SecurityUser $user */
        $user = $this->getUser();

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $lastRow = $em->getRepository(AppOrdenServicio::class)->getLastRowForOffice($user->getOffice());

        return (!$lastRow) ? 1 : $lastRow->getNumero() + 1;
    }

    /**
     * @param $object AppOrdenServicio
     * @return AppOrdenServicio
     */
    private function setOrdenServicio($object)
    {
        /** @var SecurityUser $user */
        $user = $this->getUser();

        $object->setNumero($this->getNuevoNumeroFactura($object));
        $object->setOffice($user->getOffice());
        $object->setUsuarioCreador($user);

        return $object;
    }

    /**
     * @param $receta_id
     * @return Response
     * @throws ORMException
     */
    public function ordenServicioRecetaAction($receta_id)
    {
        $class = $this->admin->getClass();
        /** @var AppOrdenServicio $object */
        $object = new $class();
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        /** @var AppReceta $recetaEntity */
        $recetaEntity = $em->getReference(AppReceta::class, $receta_id);

        $object->setReceta($recetaEntity);
        $this->admin->setSubject($object);

        /** @var Form $form */
        $form = $this->admin->getForm();
        $form->get('receta')->setData($recetaEntity);

        if ($this->getRequest()->getMethod() === Request::METHOD_POST) {
            $request = $this->getRequest()->request->get($this->admin->getUniqid());
            $object->setPrecio((double)$request['precio']);
            $object = $this->setOrdenServicio($object);

            $em->persist($object);
            $em->flush();

            return new RedirectResponse($this->admin->generateUrl('datos_orden_servicio',
                ['id' => $object->getId()]
            ));
        }


        return $this->renderWithExtraParams('::Admin\OrdenServicio\orden_servicio_receta.html.twig ', array(
            'object' => $object,
            'form' => $form->createView(),
            'action' => ''
        ));
    }

    public function datosOrdenServicioAction()
    {
        return $this->renderWithExtraParams('::Admin\OrdenServicio\datos_orden_servicio.html.twig ', [

        ]);
    }

    /**
     * @param $receta_id
     * @return Response
     * @throws ORMException
     */
    public function comprobarExitenciaAction($receta_id)
    {
        /** @var SecurityUser $user */
        $user = $this->getUser();
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        /** @var AppReceta $recetaEntity */
        $recetaEntity = $em->getReference(AppReceta::class, $receta_id);
        $almacen = [];
        $almacen['OD'] = $em->getRepository(Alamacen::class)
            ->getProductoOficina($recetaEntity->getCristalOd()->getProducto(), $user->getOffice());
        $almacen['OI'] = $em->getRepository(Alamacen::class)
            ->getProductoOficina($recetaEntity->getCristalOi()->getProducto(), $user->getOffice());


        return $this->renderWithExtraParams('::Admin\OrdenServicio\comprobar_existencia.html.twig', [
            'almacen' => $almacen
        ]);
    }

    public function ordenServicioSinRectaAction()
    {
        $class = $this->admin->getClass();
        /** @var AppOrdenServicio $object */
        $object = new $class();
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $this->admin->setSubject($object);

//        dump($this->admin);exit;

        /** @var Form $form */
        $form = $this->admin->getForm();
        $object->setReceta(new AppReceta());

        return $this->renderWithExtraParams('::Admin\OrdenServicio\orden_servicio_sin_receta.html.twig ', array(
            'object' => $object,
            'form' => $form->createView(),
            'action' => ''
        ));
    }
}