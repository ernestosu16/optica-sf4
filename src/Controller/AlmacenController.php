<?php


namespace App\Controller;


use App\Entity\MovimientoAlmacen\Alamacen;
use App\Entity\MovimientoAlmacen\InformeRecepcionOptica;
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
        $object = $this->em->getRepository(InformeRecepcionOptica::class)
            ->obtenerFacturaAsignadaOficina($this->user->getOffice());

        return $this->renderWithExtraParams($this->admin->getTemplate('confirm_factura'), array(
            'object' => $object
        ));
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function saveConfirmarFacturaAction($id)
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
            $url = $this->admin->generateUrl('list');
        }

        return new RedirectResponse($url);
    }

    private function confirmFactura(InformeRecepcionOptica $factura)
    {
        foreach ($factura->getAccesorios() as $accesorio) {
            $this->save($accesorio);
        }
        foreach ($factura->getArmaduras() as $accesorio) {
            $this->save($accesorio);
        }
        foreach ($factura->getCristales() as $accesorio) {
            $this->save($accesorio);
        }

        $factura->setConfirmado(true);
        $this->em->persist($factura);
        $this->em->flush();
    }

    private function save($item)
    {
        $producto = $this->em->getRepository(Alamacen::class)
            ->getProductoOficina(
                $item->getProducto()->getProducto(),
                $this->user->getOffice());

        if ($producto) {
            $producto->setCantidadExistencia(
                $producto->getCantidadExistencia() + $item->getCantidad()
            );
            $this->em->persist($producto);
        } else {
            $new = AlamacenRepository::addProductoOficina(
                $item->getCantidad(),
                $item->getProducto()->getProducto(),
                $this->user->getOffice());
            $this->em->persist($new);
        }
    }

    public function cancelarFacturaAction($id)
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
                $factura->setDevuelto(true);
                $this->em->flush();


                if ($object) {
                    $url = $this->admin->generateUrl('confirmar_factura');
                } else {
                    $url = $this->admin->generateUrl('list');
                }

                return new RedirectResponse($url);
            }

        }

        $object = $this->em->getRepository(InformeRecepcionOptica::class)->find($id);
        return $this->renderWithExtraParams($this->admin->getTemplate('cancelar_factura'), array(
            'object' => $object
        ));
    }


}