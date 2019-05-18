<?php


namespace App\Controller;


use App\Entity\MovimientoAlmacen\InformeRecepcionOptica;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use ReflectionClass;
use Sonata\AdminBundle\Controller\CRUDController;

class InformeRecepcionOpticaAdminController extends CRUDController
{
    /**
     * @var ObjectManager
     */
    private $em;
    private $user;

    public function exportPdfAction($id)
    {
        $this->user = $this->getUser();
        $this->em = $this->getDoctrine()->getManager();
        $object = null;
        $url = null;

        /** @var InformeRecepcionOptica $object */
        $object = $this->em->getRepository(InformeRecepcionOptica::class)->find($id);

        $tipo_factura = [
            $object->getAccesorios(),
            $object->getArmaduras(),
            $object->getCristales(),
            $object->getLupas(),
            $object->getTinteCristales(),
        ];

        $tipo_factura_string = "";

        /** @var Collection $item */
        foreach ($tipo_factura as $item) {
            if (!$item->isEmpty()) {
                $reflect = new ReflectionClass($item->toArray()[0]);
                $tipo_factura_string =
                    preg_replace('/(?<!\ )[A-Z]/', ' $0',
                        str_replace("InformeRecepcionOptica", "", $reflect->getShortName())
                    );
            }

        }

        $html = $this->renderView('::Admin\informe_recepcion_optica\modelo\vale_salida.html.twig', array(
            'object' => $object,
            'tipo_factura' => $tipo_factura_string,
        ));

        return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html, array('orientation' => 'Landscape')),
            $object->getOfficeDestino() . '-' . $id . '.pdf'
        );
    }

}