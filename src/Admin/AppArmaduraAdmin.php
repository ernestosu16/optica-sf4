<?php

namespace App\Admin;

use App\Form\ProductoType;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;


class AppArmaduraAdmin extends _BaseAdmin_
{
    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);
    }

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
            ->remove('batch')
            ->add('producto.imagen', 'media_thumbnail', array(
                'label' => 'nomenclador.imagen',
                'class' => 'img-polaroid',
                'header_style' => 'width: 80px',
            ))
            ->add('producto.codigo', null, [
                'label' => 'nomenclador.codigo',
            ])
            ->add('producto.precio', null, [
                'label' => 'nomenclador.precio',
            ])
            ->add('producto.descripcion', null, [
                'label' => 'nomenclador.descripcion',
            ])
            ->add('aro')
            ->add('puente')
            ->add('altura')
            ->add('_action', null, array(
                'label' => 'Acciones',
                'row_align' => 'right',
                'header_style' => 'width: 170px',
                'actions' => $this->actions,
            ));
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Datos Primarios', array('class' => 'col-md-6'))
            ->add('producto', ProductoType::class)
            ->end()
            ->with('Datos armadura', array('class' => 'col-md-3'))
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
            ->add('producto.imagen', 'media_thumbnail', array(
                'label' => 'nomenclador.imagen',
                'class' => 'img-polaroid',
            ))
            ->add('producto.codigo', null, [
                'label' => 'nomenclador.codigo',
            ])
            ->add('producto.precio', null, [
                'label' => 'nomenclador.precio',
            ])
            ->add('producto.descripcion', null, [
                'label' => 'nomenclador.descripcion',
            ])
            ->add('aro')
            ->add('puente')
            ->add('altura');
    }
}