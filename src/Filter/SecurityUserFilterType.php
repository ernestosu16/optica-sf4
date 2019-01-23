<?php
/**
 * Created by PhpStorm.
 * User: usuario
 * Date: 30/12/2018
 * Time: 12:28
 */

namespace App\Filter;

use App\Entity\Categoria;
use App\Entity\SecurityGroup;
use Doctrine\ORM\EntityRepository;
use Lexik\Bundle\FormFilterBundle\Filter\FilterOperands;
use Lexik\Bundle\FormFilterBundle\Filter\Query\QueryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type as Filters;

class SecurityUserFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', Filters\TextFilterType::class)
            ->add('email', Filters\TextFilterType::class)
            ->add('firstname', Filters\TextFilterType::class)
            ->add('lastname', Filters\TextFilterType::class)
            ->add('gender')
            ->add('enabled', Filters\BooleanFilterType::class)
            ->add('lastLogin', Filters\DateRangeFilterType::class, array(
                //'widget' => 'single_text'
                'left_date_options' => array(
                    'label' => 'Desde',
                    'widget' => 'single_text'
                ),
                'right_date_options' => array(
                    'label' => 'Hasta',
                    'widget' => 'single_text'
                )
            ))
            ->add('dateOfBirth', Filters\DateRangeFilterType::class, array(
                //'widget' => 'single_text'
                'left_date_options' => array(
                    'label' => 'Desde',
                    'widget' => 'single_text'
                ),
                'right_date_options' => array(
                    'label' => 'Hasta',
                    'widget' => 'single_text'
                )
            ))
            ->add('locale')
            ->add('timezone')
            //->add('phone')
            ->add('roles')
            ->add('groups', Filters\EntityFilterType::class, [
                'class' => SecurityGroup::class
            ]);
    }

    public function getBlockPrefix()
    {
        return 'form_filter';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
            'validation_groups' => array('filtering') // avoid NotBlank() constraint-related message
        ));
    }
}