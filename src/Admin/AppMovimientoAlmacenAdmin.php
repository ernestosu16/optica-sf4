<?php

namespace App\Admin;


use App\Form\SubMayorProductoType;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\Form\Type\CollectionType;


class AppMovimientoAlmacenAdmin extends _BaseAdmin_
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $object = $this->getSubject();

        $formMapper
            ->with('Datos de la Recepción', array('class' => 'col-md-4'))
            ->add('numero')
            ->add('state')
            ->add('discriminator')
            ->end()
            ->with('Productos', array('class' => 'col-md-8'))
            ->add('sub_mayor', CollectionType::class, array(
                'label' => false,
                'disabled' => $object->getId(),
                'by_reference' => false,
                'btn_add' => $object->getId() ? false : 'link_add',
                'type_options' => array(
                    'delete' => !$object->getId(),
                )
            ), array(
                'edit' => 'inline',
                'inline' => 'table',
            ))
            ->end();
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('numero')
            ->add('state')
            ->add('discriminator')
            ->add('sub_mayor', null, array(
                'label' => 'Productos'
            ))
            ->add('_action', null, array(
                'label' => 'Acciones',
                'row_align' => 'right',
                'header_style' => 'width: 160px',
                'actions' => $this->actions ,
            ));
    }
}