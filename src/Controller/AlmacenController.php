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
        # Obtener el usuario autenticado
        $this->user = $this->getUser();
        # Obtener el servicio del ORM de doctrine
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
        # Obtener el usuario autenticado
        $this->user = $this->getUser();
        # Obtener el servicio del ORM de doctrine
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

        $estado = $factura->getPendiente();
        if ($factura->getPendiente()) { # Cuando Confirmar el económico
            $factura->setConfirmado(true);
            $factura->setPendiente(false);
//            $factura->setDatoExtra($this->getExtraDataProducto($productos));
            $factura->setUsuarioEconomico($this->user);
            foreach ($productos as $producto) {
                foreach ($producto as $item) {
                    $this->actualizarSaldo($item);
                }
            }
        } else { # para cuando confirmar el almacén
            $factura->setPendiente(true);
            $factura->setNumeroInformeRecepcion($this->getNuevoNumeroInformeRecepcion());
        }

        foreach ($productos as $producto) {
            foreach ($producto as $item) {
                $this->save($item, $factura, $estado);
            }
        }

        $this->em->persist($factura);
        $this->em->flush();
    }

    /**
     * @param $item InformeRecepcionOpticaAccesorio
     * @param $factura InformeRecepcionOptica
     * @param bool $estado
     * @throws ORMException
     */
    private function save($item, InformeRecepcionOptica $factura, bool $estado)
    {
        $producto = $this->em->getRepository(Alamacen::class)
            ->getProductoOficina(
                $item->getProducto()->getProducto(),
                $factura->getOfficeDestino());

        if ($producto) {
            if ($estado) {
                $cantidad_pendiente = $producto->getCantidadPendiente() - $item->getCantidad();
                $cantidad_existencia = $producto->getCantidadExistencia() + $item->getCantidad();
            } else {
                $cantidad_pendiente = $producto->getCantidadPendiente() + $item->getCantidad();
                $cantidad_existencia = $producto->getCantidadExistencia();
            }

            $producto->setCantidadPendiente($cantidad_pendiente);
            $producto->setCantidadExistencia($cantidad_existencia);

        } else {
            $producto = AlamacenRepository::addProductoOficinaPendiente(
                $item->getCantidad(),
                $item->getProducto()->getProducto(),
                $this->user->getOffice());
        }

        $this->em->persist($producto);
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
        return $this->redirectToRoute('movimientoalmacen-alamacen-economico_list');
//        $object = null;
//        $this->em = $this->getDoctrine()->getManager();
//
//        $object = $this->em->getRepository(InformeRecepcionOptica::class)
//            ->obtenerFacturaPendienteEconomico();
//
//        return $this->renderWithExtraParams($this->admin->getTemplate('lista_factura'), array(
//            'object' => $object
//        ));
    }

    /**
     * Obtener el numero que continua del informe de recepción
     *
     * @return string
     */
    private function getNuevoNumeroInformeRecepcion()
    {
        # Obtener el usuario autenticado
        $this->user = $this->getUser();
        # Obtener el servicio del ORM de doctrine
        $this->em = $this->getDoctrine()->getManager();

        /**
         * Busco la ultima tupla de la columna
         * @var $InformeRecepcion InformeRecepcionOptica
         */
        $InformeRecepcion = $this->em->getRepository(InformeRecepcionOptica::class)->getOfficeLastRow(
            $this->user->getOffice()
        );

        # Por si es nueva y no existe ninguna el valor iniciar es 1
        $NumeroInformeRecepcion = 1;

        # compruebo que exista y si existe obtengo el numero y le sumo 1
        if ($InformeRecepcion) {
            $NumeroInformeRecepcion = $InformeRecepcion->getNumeroInformeRecepcion() + 1;
        }

        return $NumeroInformeRecepcion;
    }

    /**
     * @param $item InformeRecepcionOpticaAccesorio
     * @throws ORMException
     */
    private function actualizarSaldo($item)
    {
        $producto = $this->em->getRepository(Alamacen::class)
            ->getProductoOficina(
                $item->getProducto()->getProducto(),
                $this->user->getOffice());

        $item->setSaldoFinal($producto->getCantidadExistencia() + $item->getCantidad());
        $this->em->persist($item);
    }

//    /**
//     * Obtener los datos del informe de recepción
//     *
//     * @param $productos
//     * @return array
//     */
//    private function getExtraDataProducto($productos)
//    {
//        $data = [];
//        foreach ($productos as $producto) {
//            foreach ($producto as $item) {
//                # Buscar el producto en el almacén
//                $almacen = $this->em->getRepository(Alamacen::class)->findOneBy([
//                    'producto' => $item->getProducto()->getProducto(),
//                    'office' => $this->user->getOffice(),
//                ]);
//
//                # Si existe lo guardo en el arreglo
//                if ($almacen) {
//                    $data['informe_recepcion'][] = [
//                        'producto_id' => $almacen->getProducto()->getId(),
//                        'existencia_inicial' => $almacen->getCantidadExistencia(),
//                        'existencia_final' => $almacen->getCantidadExistencia() + $item->getCantidad(),
//                    ];
//                }
//            }
//        }
//
//        return $data;
//    }


}