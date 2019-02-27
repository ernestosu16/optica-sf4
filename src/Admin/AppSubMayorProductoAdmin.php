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
        $object = $this->getSubject();

        $formMapper
            ->add('producto', EntityType::class, [
                'class' => AppProducto::class,
                'label' => 'nomenclador.producto',
                'disabled' => !$object,
            ])
            ->add('cantidad', NumberType::class, [
                'label' => 'nomenclador.cantidad',
                'disabled' => !$object,
                'attr' => ['style'=>'width: 100px'],
            ])
        ;
    }

}