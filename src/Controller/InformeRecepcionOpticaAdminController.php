<?php


namespace App\Controller;


use App\Entity\MovimientoAlmacen\InformeRecepcionOptica;
use Doctrine\Common\Persistence\ObjectManager;
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

        $object = $this->em->getRepository(InformeRecepcionOptica::class)->find($id);

        dump($object);
        return $this->renderWithExtraParams($this->admin->getTemplate('export_pdf'), array(
            'object' => $object
        ));
    }

}