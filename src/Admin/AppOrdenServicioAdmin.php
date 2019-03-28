<?php

namespace App\Admin;


use Sonata\AdminBundle\Form\FormMapper;

class AppOrdenServicioAdmin extends _BaseAdmin_
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('receta')
        ;
    }
}