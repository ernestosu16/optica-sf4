<?php


namespace App\Admin;


use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class InformeRecepcionOpticaProductoAdmin extends _BaseAdmin_
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('producto', null, [
            'required' => true,
        ]);
        $formMapper->add('cantidad', null, [
            'required' => true,
        ]);
    }

    protected function configureListFields(ListMapper $list)
    {
        // TODO: Implement configureListFields() method.
    }
}