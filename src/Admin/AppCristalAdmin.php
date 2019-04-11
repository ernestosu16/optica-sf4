<?php

namespace App\Admin;


use App\Form\ProductoType;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Validator\Constraints\Regex;

class AppCristalAdmin extends _BaseAdmin_
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
            ->add('grosor')
            ->add('esfera')
            ->add('cilindro');
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
//            ->add('producto.precio_costo', null, [
//                'label' => 'nomenclador.precio_costo',
//            ])
            ->add('producto.descripcion', null, [
                'label' => 'nomenclador.descripcion',
            ])
            ->add('grosor')
            ->add('esfera', 'string', array(
                'template' => '::Admin/producto/list/esfera.html.twig'
            ))
            ->add('cilindro', 'string', array(
                'template' => '::Admin/producto/list/cilindro.html.twig'
            ))
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
            ->with('Datos del Cristal', array('class' => 'col-md-3'))
            ->add('grosor', NumberType::class, array(
                'constraints' => array(
                    new Regex(array('pattern' => '/^\d{0,}(\.\d{1,2})?$/')),
                ),
            ))
            ->add('esfera', NumberType::class, array(
                'constraints' => array(
                    new Regex(array('pattern' => '/[-+]?\d{0,2}(\.\d{1,2})?$/')),
                ),
            ))
            ->add('cilindro', NumberType::class, array(
                'constraints' => array(
                    new Regex(array('pattern' => '/[-+]?\d{0,2}(\.\d{1,2})?$/')),
                ),
            ))
            ->end();
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('producto')
            ->add('grosor')
            ->add('esfera')
            ->add('cilindro');
    }
}