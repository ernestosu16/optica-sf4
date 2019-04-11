<?php


namespace App\Admin;


use App\Form\ProductoType;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\MediaBundle\Form\Type\MediaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AppLupaAdmin extends _BaseAdmin_
{
    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);
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
//            ->add('producto.precio_costo', null, [
//                'label' => 'nomenclador.precio_costo',
//            ])
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
     * @throws \Exception
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Datos Primarios', array('class' => 'col-md-6'))
            ->add('producto', ProductoType::class)
            ->end()
            ->with('Datos de la lupa', array('class' => 'col-md-6'))
            ->add('dioptrias')
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