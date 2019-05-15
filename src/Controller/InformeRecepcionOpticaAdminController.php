<?php


namespace App\Controller;


use App\Entity\MovimientoAlmacen\InformeRecepcionOptica;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
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

        $html = $this->renderView('::Admin\informe_recepcion_optica\modelo\vale_salida.html.twig', array(
            'object' => $object
        ));

        return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html, array('orientation' => 'Landscape')),
            $object->getOfficeDestino() . '-' . $id . '.pdf'
        );
    }

}