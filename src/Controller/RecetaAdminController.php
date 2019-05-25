<?php


namespace App\Controller;


use App\Entity\AppReceta;
use Sonata\AdminBundle\Controller\CRUDController;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\DoctrineORMAdminBundle\Builder\FormContractor;
use Sonata\Form\Type\DateTimePickerType;
use Symfony\Component\Form\Forms;

class RecetaAdminController extends CRUDController
{
    public function crearRecetaPacienteAction($id)
    {

        /** @var string $class */
        $class = $this->admin->getClass();
        /** @var AppReceta $object */
        $object = new $class();

        $this->admin->setSubject($object);

        return $this->renderWithExtraParams('::Admin/receta/create_receta_paciente.html.twig', array(
            'id' => $id,
            'object' => $object,
            'form' => $this->admin->getFormBuilder()->getForm()->createView(),
        ));
    }

}