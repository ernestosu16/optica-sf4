<?php

namespace App\Admin;


use App\Entity\AppProducto;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class AppSubMayorProductoAdmin extends _BaseAdmin_
{
protected function configureFormFields(FormMapper $formMapper)
{
    $formMapper
        ->with('Producto', ['class' => 'col-md-4'])
        ->add('producto.codigo',null,[
            'label' => 'nomenclador.codigo',
            'disabled' => true,
        ])
        ->add('producto.precio',null,[
            'label' => 'nomenclador.precio',
            'disabled' => true,
        ])
        ->add('cantidad', NumberType::class, [
            'label' => 'nomenclador.cantidad',
            'disabled' => true,
        ])
        ->end()
    ;
}

}