<?php


namespace App\Controller;


use App\Entity\MovimientoAlmacen\Alamacen;
use App\Entity\MovimientoAlmacen\InformeRecepcionOptica;
use App\Entity\MovimientoAlmacen\InformeRecepcionOpticaAccesorio;
use App\Entity\SecurityUser;

use App\Repository\AlamacenRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class AlmacenController extends CRUDController
{
    /** @var SecurityUser */
    private $user;
    /** @var EntityManager $em */
    private $em;

    public function confirmarFacturaAction()
    {
        $this->user = $this->getUser();
        $this->em = $this->getDoctrine()->getManager();
        $object = null;
        if ($this->user->getOffice()) {
            $object = $this->em->getRepository(InformeRecepcionOptica::class)
                ->obtenerFacturaAsignadaOficina($this->user->getOffice());
        }

        return $this->renderWithExtraParams($this->admin->getTemplate('confirm_factura'), array(
            'object' => $object
        ));
    }

    /**
     * @param $id
     * @param $redirectTo
     * @return RedirectResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function saveConfirmarFacturaAction($id, $redirectTo)
    {
        $this->user = $this->getUser();
        $this->em = $this->getDoctrine()->getManager();
        $object = null;
        $url = null;


        if ($id) {
            /** @var InformeRecepcionOptica $factura */
            $factura = $this->em->getRepository(InformeRecepcionOptica::class)
                ->find($id);

            $this->confirmFactura($factura);

        }

        $object = $this->em->getRepository(InformeRecepcionOptica::class)
            ->obtenerFacturaAsignadaOficina($this->user->getOffice());

        if ($object) {
            $url = $this->admin->generateUrl('confirmar_factura');
        } else {
            $url = $this->admin->generateUrl($redirectTo);
        }

        return new RedirectResponse($url);
    }

    /**
     * @param InformeRecepcionOptica $factura
     * @throws ORMException
     * @throws OptimisticLockException
     */
    private function confirmFactura(InformeRecepcionOptica $factura)
    {
        $productos = [
            $factura->getAccesorios(),
            $factura->getArmaduras(),
            $factura->getCristales(),
            $factura->getLupas(),
            $factura->getTinteCristales(),
        ];

        foreach ($productos as $producto) {
            foreach ($producto as $item) {
                $this->save($item, $factura->getPendiente());
            }
        }

        /** @var SecurityUser user */
        $this->user = $this->getUser();

        $factura->setUsuarioConfirmado($this->user);

        if ($factura->getPendiente()) {
            $factura->setConfirmado(true);
            $factura->setPendiente(false);
        } else {
            $factura->setPendiente(true);
        }

        $this->em->persist($factura);
        $this->em->flush();
    }

    /**
     * @param $item InformeRecepcionOpticaAccesorio
     * @param $pendiente bool
     * @throws ORMException
     */
    private function save($item, bool $pendiente)
    {
        $producto = $this->em->getRepository(Alamacen::class)
            ->getProductoOficina(
                $item->getProducto()->getProducto(),
                $this->user->getOffice());

        if ($producto) {
            if ($pendiente) {
                $cantidad_pendiente = $producto->getCantidadPendiente() - $item->getCantidad();
                $cantidad_existencia = $producto->getCantidadExistencia() + $item->getCantidad();
            } else {
                $cantidad_pendiente = $producto->getCantidadPendiente() + $item->getCantidad();
                $cantidad_existencia = $producto->getCantidadExistencia();
            }

            $producto->setCantidadPendiente($cantidad_pendiente);
            $producto->setCantidadExistencia($cantidad_existencia);
            $this->em->persist($producto);
        } else {
            $new = AlamacenRepository::addProductoOficinaPendiente(
                $item->getCantidad(),
                $item->getProducto()->getProducto(),
                $this->user->getOffice());
            $this->em->persist($new);
        }
    }

    public function cancelarFacturaAction($id, $redirectTo)
    {
        $this->user = $this->getUser();
        $this->em = $this->getDoctrine()->getManager();
        $object = null;
        $url = null;


        if ($id) {
            /** @var InformeRecepcionOptica $factura */
            $factura = $this->em->getRepository(InformeRecepcionOptica::class)
                ->find($id);

            if ($this->getRequest()->getMethod() === Request::METHOD_POST) {
                $factura->setDevueltoDescripcion($this->getRequest()->request->get('descripcion'));
                $factura->setPendiente(false);
                $factura->setDevuelto(true);
                $this->em->flush();


                $url = $this->admin->generateUrl($redirectTo);

                return new RedirectResponse($url);
            }

        }

        $object = $this->em->getRepository(InformeRecepcionOptica::class)->find($id);
        return $this->renderWithExtraParams($this->admin->getTemplate('cancelar_factura'), array(
            'object' => $object,
            'redirectTo' => $redirectTo,
        ));
    }

    public function listaProductoFacturaAction($id, $redirectTo)
    {
        $object = null;
        $this->em = $this->getDoctrine()->getManager();

        if ($id) {
            /** @var InformeRecepcionOptica $factura */
            $object = $this->em->getRepository(InformeRecepcionOptica::class)
                ->find($id);
        }

        return $this->renderWithExtraParams($this->admin->getTemplate('lista_producto_factura'), array(
            'object' => $object,
            'redirectTo' => $redirectTo
        ));
    }

    public function listaFacturaAction()
    {
        $object = null;
        $this->em = $this->getDoctrine()->getManager();

        $object = $this->em->getRepository(InformeRecepcionOptica::class)
            ->obtenerFacturaPendienteEconomico();

        return $this->renderWithExtraParams($this->admin->getTemplate('lista_factura'), array(
            'object' => $object
        ));
    }


}