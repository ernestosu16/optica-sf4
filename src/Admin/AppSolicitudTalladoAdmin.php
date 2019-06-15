<?php


namespace App\Admin;


use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class AppSolicitudTalladoAdmin extends _BaseAdmin_
{

    protected function configureFormFields(FormMapper $form)
    {
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('created_at')
            ->add('office')
            ->add('numero');
    }
}