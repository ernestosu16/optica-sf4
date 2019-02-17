<?php

namespace App\Admin;

use App\Form\ProductoType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;


class AppArmaduraAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('producto')
            ->add('aro')
            ->add('puente')
            ->add('altura');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {

        $listMapper
            ->add('producto')
            ->add('aro')
            ->add('puente')
            ->add('altura')
            ->add('_action', null, array(
                'label' => 'Acciones',
                'row_align' => 'right',
                'header_style' => 'width: 190px',
                'actions' => array(
                    'edit' => array(),
                    'delete' => array())));
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Datos Primarios', array('class' => 'col-md-4'))
            ->add('producto', ProductoType::class)
            ->end()
            ->with('Datos armadura', array('class' => 'col-md-4'))
            ->add('aro')
            ->add('puente')
            ->add('altura')
            ->end();
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('producto')
            ->add('codigo')
            ->add('modelo')
            ->add('aro');
    }
}