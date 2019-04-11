<?php


namespace App\Admin;


use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;

class AppRecetaAdmin extends _BaseAdmin_
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $object = $this->getSubject();
        $formMapper
            ->with('Receta', array('class' => 'col-md-12'))
            ->add('numero')
            ->add('paciente', $object->getId() ? null : ModelListType::class, array(
                'required' => true,
                'disabled' => $object->getId(),
            ))
            ->end()
            ;

    }

}