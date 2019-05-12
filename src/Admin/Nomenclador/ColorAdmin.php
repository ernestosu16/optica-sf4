<?php


namespace App\Admin\Nomenclador;


use App\Admin\_BaseAdmin_;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ColorAdmin extends _BaseAdmin_
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('valor', null, [
            'label' => 'Color'
        ]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->add('valor');
    }
}