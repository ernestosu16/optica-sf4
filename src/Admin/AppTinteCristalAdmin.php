<?php
/**
 * Created by PhpStorm.
 * User: ernestosr
 * Date: 12/02/2019
 * Time: 05:24 PM
 */

namespace App\Admin;


use App\Entity\AppTinteCristal;
use App\Form\ProductoType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class AppTinteCristalAdmin extends _BaseAdmin_
{
    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('producto');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {

        $listMapper
            ->remove('batch')
            ->add('producto.imagen', 'media_thumbnail', array(
                'label' => 'nomenclador.imagen',
                'class' => 'img-polaroid',
                'header_style' => 'width: 80px',
            ))
            ->add('producto.codigo', null, [
                'label' => 'nomenclador.codigo',
            ])
            ->add('producto.precio', null, [
                'label' => 'nomenclador.precio',
            ])
            ->add('producto.descripcion', null, [
                'label' => 'nomenclador.descripcion',
            ])
            ->add('_action', null, array(
                'label' => 'Acciones',
                'row_align' => 'right',
                'header_style' => 'width: 170px',
                'actions' => $this->actions,
            ));
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Datos Primarios', array('class' => 'col-md-6'))
            ->add('producto', ProductoType::class)
            ->end()
            ->with('Tinte Cristal', array('class' => 'col-md-6'))
            ->add('color',ModelType::class, [
                'placeholder' => '',
                'label' => 'Color',
                'required' => true
            ])
            ->end();
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('producto.imagen', 'media_thumbnail', array(
                'label' => 'nomenclador.imagen',
                'class' => 'img-polaroid',
            ))
            ->add('producto.codigo', null, [
                'label' => 'nomenclador.codigo',
            ])
            ->add('producto.precio', null, [
                'label' => 'nomenclador.precio',
            ])
            ->add('producto.descripcion', null, [
                'label' => 'nomenclador.descripcion',
            ]);
    }
}