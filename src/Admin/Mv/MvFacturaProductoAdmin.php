<?php


namespace App\Admin\Mv;


use App\Admin\_BaseAdmin_;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class MvFacturaProductoAdmin extends _BaseAdmin_
{

    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('producto')
            ->add('cantidad')
        ;
    }

    protected function configureListFields(ListMapper $list)
    {
        // TODO: Implement configureListFields() method.
    }
}