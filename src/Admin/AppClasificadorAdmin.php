<?php
/**
 * Created by PhpStorm.
 * User: ernestosr
 * Date: 30/01/2019
 * Time: 05:17 PM
 */

namespace App\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AppClasificadorAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General', ['class' => 'col-md-6'])
            ->add('type', TextType::class, [
                'label' => 'app.type',
            ])
            ->add('descripcion', TextType::class, [
                'label' => 'app.descripcion',
            ])
            ->end();
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('type', TextType::class, [
                'label' => 'app.type',
            ])
            ->add('descripcion', TextType::class, [
                'label' => 'app.descripcion',
            ]);
    }
}