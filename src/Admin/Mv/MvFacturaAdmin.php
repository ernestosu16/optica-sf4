<?php


namespace App\Admin\Mv;


use App\Admin\_BaseAdmin_;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\Form\Type\CollectionType;


class MvFacturaAdmin extends _BaseAdmin_
{

    protected function configureFormFields(FormMapper $form)
    {
        $object = $this->getSubject();
        $form
            ->with('Datos de la Factura', array('class' => 'col-md-4'))
            ->add('office_destino', null, array(
                'label' => 'Oficina destino',
                'required' => true,
            ))
            ->add('numero_factura', null, array(
                'label' => 'Número de las Factura'
            ))
            ->end()
            ->with('Lista de Productos', array('class' => 'col-md-8'))
            ->add('factura_producto', CollectionType::class, array(
                'label' => false,
                'disabled' => $object->getId(),
                "by_reference" => false,
                'btn_add' => $object->getId() ? false : 'link_add',
                'type_options' => array(
                    'delete' => !$object->getId(),
                )), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                )
            )
            ->end();
    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->add('id', null, [
                'label' => '#'
            ])
            ->addIdentifier('numero_factura', null, [
                'label' => 'Número de la factura'
            ])
            ->add('office_destino', null, [
                'label' => 'Oficina de destino'
            ])
            ->add('factura_producto', null, [
                'label' => 'Lista de los productos'
            ])
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                ),
            ));
    }
}