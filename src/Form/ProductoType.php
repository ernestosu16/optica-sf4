<?php

namespace App\Form;

use App\Entity\AppProducto;
use Sonata\MediaBundle\Form\Type\MediaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imagen', MediaType::class, array(
                'provider' => 'sonata.media.provider.image',
                'context' => 'office'
            ))
            ->add('codigo')
            ->add('descripcion')
            ->add('precio')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AppProducto::class,
        ]);
    }
}
