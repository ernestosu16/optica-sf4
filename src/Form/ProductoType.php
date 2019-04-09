<?php

namespace App\Form;

use App\Entity\AppProducto;
use Sonata\MediaBundle\Form\Type\MediaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;

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
            ->add('precio', MoneyType::class, array(
                'currency' => 'USD',
                'attr' => array(
                    'placeholder' => 'x.xx',
                ),
                'constraints' => array(
                    new Regex(array('pattern' => '/^\d{0,2}(\.\d{1,2})?$/')),
                ),
            ))
            ->add('precio_costo', MoneyType::class, array(
                'currency' => 'USD',
                'attr' => array(
                    'placeholder' => 'x.xx',
                ),
                'constraints' => array(
                    new Regex(array('pattern' => '/^\d{0,2}(\.\d{1,2})?$/')),
                ),
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AppProducto::class,
        ]);
    }
}
