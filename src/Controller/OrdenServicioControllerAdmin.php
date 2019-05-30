<?php


namespace App\Controller;


use App\Entity\AppOrdenServicio;
use App\Entity\AppReceta;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OrdenServicioControllerAdmin extends CRUDController
{
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

        $form = $this->admin->getForm();
        $form->get('receta')->setData($recetaEntity);

        if($this->getRequest()->getMethod() === Request::METHOD_POST){
            dump($this->getRequest()->request->all());exit;
        }


        return $this->renderWithExtraParams('::Admin\OrdenServicio\orden_servicio_receta.html.twig ', array(
            'object' => $object,
            'form' => $form->createView(),
            'action' => ''
        ));
    }
}