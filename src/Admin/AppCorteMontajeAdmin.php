<?php


namespace App\Admin;


use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class AppCorteMontajeAdmin extends _BaseAdmin_
{
    protected $baseRoutePattern = 'corte_montaje';
    protected $baseRouteName = 'corte_montaje';

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['list']);

        # Creación y edición del despacho
        $collection->add('despacho', 'despacho/{fecha}');
        $collection->add('confirmar_corte_montaje', 'confirmar_corte_montaje/{id}');

    }

    protected function configureFormFields(FormMapper $form)
    {
        // TODO: Implement configureFormFields() method.
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);

        $listMapper
            ->add('fecha', null, ['format' => 'Y-m-d'])
            ->add('Asociado', null, [
                'template' => '::Admin\DespachoAlmacen\fields\asociado.html.twig'
            ])
            ->add('_action', null, array(
                'label' => 'Acción',
                'actions' => array(
                    'other' => array('template' => '::Admin\CorteMontaje\buttons\other.html.twig'),
                )));
    }
}