<?php

namespace App\Admin;

use App\Form\ProductoType;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class AppAccesorioAdmin extends _BaseAdmin_
{
    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {

        $listMapper
            ->add('producto.imagen', 'media_thumbnail', array(
                'label' => 'nomenclador.imagen',
                'class' => 'img-polaroid',
            ))
            ->add('producto.codigo',null,[
                'label' => 'nomenclador.codigo',
            ])
            ->add('producto.precio',null,[
                'label' => 'nomenclador.precio',
            ])
            ->add('producto.descripcion',null,[
                'label' => 'nomenclador.descripcion',
            ])
            ->add('_action', null, array(
                'label' => 'Acciones',
                'row_align' => 'right',
                'header_style' => 'width: 160px',
                'actions' => $this->actions ,
            ));
    }

    /**
     * @param FormMapper $formMapper
     * @throws \Exception
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Datos Primarios', array('class' => 'col-md-6'))
            ->add('producto', ProductoType::class)
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
            ->add('producto.codigo',null,[
                'label' => 'nomenclador.codigo',
            ])
            ->add('producto.precio',null,[
                'label' => 'nomenclador.precio',
            ])
            ->add('producto.descripcion',null,[
                'label' => 'nomenclador.descripcion',
            ])
        ;
    }
}