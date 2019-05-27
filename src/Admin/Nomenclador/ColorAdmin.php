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
        unset($this->listModes['mosaic']);

        $listMapper
            ->remove('batch')
            ->add('valor')
            ->add('_action', null, array(
                'label'=> 'Acciones',
                'row_align' => 'center',
                'header_style' => 'width: 190px',
                'actions' => array(
                    'edit' => array(),
                ),
            ));
    }
}