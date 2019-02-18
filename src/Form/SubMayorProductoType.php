<?php

namespace App\Form;

use App\Entity\AppSubmayorProducto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubMayorProductoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cantidad')
            ->add('saldo_existente')
            ->add('saldo_disponible')
//            ->add('producto')
//            ->add('movimiento')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AppSubmayorProducto::class,
        ]);
    }
}
