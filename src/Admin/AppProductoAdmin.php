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
use Sonata\MediaBundle\Form\Type\MediaType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AppProductoAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Imagen', ['class' => 'col-md-4'])
            ->add('imagen', MediaType::class, array(
                'provider' => 'sonata.media.provider.image',
                'context' => 'default',
            ))
            ->end()
            ->with('Producto', ['class' => 'col-md-4'])
            ->add('codigo', TextType::class, [
                'label' => 'app.codigo',
            ])
            ->add('precio', MoneyType::class, [
                'label' => 'app.precio',
                'currency' => 'CUP'
            ])
            ->add('descripcion', TextType::class, [
                'label' => 'app.descripcion',
            ])
            ->end()
            ->with('Extras', ['class' => 'col-md-4'])
            ->add('observaciones', TextType::class, [
                'label' => 'app.observaciones'
            ])
            ->add('descriminator', TextType::class, [
                'label' => 'app.descriminator',
            ])
            ->end();
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('codigo', TextType::class, ['label' => 'app.codigo'])
            ->add('descripcion')
            ->add('precio')
            ->add('_action', null, array(
                'label' => 'Acciones',
                'row_align' => 'right',
                'header_style' => 'width: 190px',
                'actions' => array(
                    'edit' => array(),
                    'delete' => array())));
    }
}