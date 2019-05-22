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

        /** @var SecurityUser user */
        $this->user = $this->getUser();
        $productos = [
            $factura->getAccesorios(),
            $factura->getArmaduras(),
            $factura->getCristales(),
            $factura->getLupas(),
            $factura->getTinteCristales(),
        ];

        $factura->setUsuarioConfirmado($this->user);

        if ($factura->getPendiente()) { # Cuando Confirmar el económico
            $factura->setConfirmado(true);
            $factura->setPendiente(false);
            $factura->setDatoExtra($this->getExtraDataProducto($productos));
        } else { # para cuando confirmar el almacén
            $factura->setPendiente(true);
            $factura->setNumeroInformeRecepcion($this->getNuevoNumeroInformeRecepcion());
        }

        foreach ($productos as $producto) {
            foreach ($producto as $item) {
                $this->save($item, $factura->getPendiente());
            }
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


                if ($factura->getPendiente()) {
                    $productos = [
                        $factura->getAccesorios(),
                        $factura->getArmaduras(),
                        $factura->getCristales(),
                        $factura->getLupas(),
                        $factura->getTinteCristales(),
                    ];


                    foreach ($productos as $producto) {
                        foreach ($producto as $item) {
                            /** @var $almacenEntity Alamacen */
                            $almacenEntity = $this->em->getRepository(Alamacen::class)
                                ->getProductoOficina(
                                    $item->getProducto()->getProducto(),
                                    $this->user->getOffice());

                            $almacenEntity->setCantidadPendiente(
                                $almacenEntity->getCantidadPendiente() - $item->getCantidad()
                            );

                        }
                    }
                }


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
            /** @var InformeRecepcionOptica $object */
            $object = $this->em->getRepository(InformeRecepcionOptica::class)
                ->find($id);

            $almacen = $this->em->getRepository(Alamacen::class)
                ->getAllProductoOficina($object->getOfficeDestino());
        }

        return $this->renderWithExtraParams($this->admin->getTemplate('lista_producto_factura'), array(
            'object' => $object,
            'redirectTo' => $redirectTo,
            'almacen' => $almacen,
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

    /**
     * @return string
     */
    private function getNuevoNumeroInformeRecepcion()
    {
        $this->user = $this->getUser();
        $this->em = $this->getDoctrine()->getManager();

        /** @var $InformeRecepcion InformeRecepcionOptica */
        $InformeRecepcion = $this->em->getRepository(InformeRecepcionOptica::class)->getOfficeLastRow(
            $this->user->getOffice()
        );

        $NumeroInformeRecepcion = 1;

        if ($InformeRecepcion) {
            $NumeroInformeRecepcion = $InformeRecepcion->getNumeroInformeRecepcion() + 1;
        }

        return $NumeroInformeRecepcion;
    }

    /**
     * @param $productos
     * @return array
     */
    private function getExtraDataProducto($productos)
    {
        $data = [];
        foreach ($productos as $producto) {
            foreach ($producto as $item) {
                $almacen = $this->em->getRepository(Alamacen::class)->findOneBy([
                    'producto' => $item->getProducto()->getProducto(),
                    'office' => $this->user->getOffice(),
                ]);

                if ($almacen) {
                    $data['informe_recepcion'][] = [
                        'producto_id' => $almacen->getProducto()->getId(),
                        'existencia_inicial' => $almacen->getCantidadExistencia(),
                        'existencia_final' => $almacen->getCantidadExistencia() + $item->getCantidad(),
                    ];
                }
            }
        }

        return $data;
    }


}