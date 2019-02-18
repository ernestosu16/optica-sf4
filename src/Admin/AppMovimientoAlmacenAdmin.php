<?php

namespace App\Admin;


use Sonata\AdminBundle\Form\FormMapper;

class AppMovimientoAlmacenAdmin extends _BaseAdmin_
{
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('numero')
            ->add('state')
            ->add('discriminator')
            ->add('sub_mayor')
        ;
    }
}