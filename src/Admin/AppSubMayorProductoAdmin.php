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
        ->add('producto', EntityType::class, [
            'label' => 'app.producto',
            'class' => AppProducto::class,
        ])
        ->add('cantidad', NumberType::class, [
            'label' => 'app.cantidad',
        ])
    ;
}

}