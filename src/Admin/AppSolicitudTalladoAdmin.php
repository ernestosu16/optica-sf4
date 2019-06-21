<?php


namespace App\Admin;


use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class AppSolicitudTalladoAdmin extends _BaseAdmin_
{
    protected function configureRoutes(RouteCollection $collection)
    {
        // OR remove all route except named ones
        return $collection->clearExcept(array('list', 'show'));
    }

    protected function configureFormFields(FormMapper $form)
    {
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);
        $listMapper
            ->add('created_at', null, [
                'label' => 'Creado',
                'format' => 'Y-m-d H:i:s'
            ])
            ->add('orden_servicio.office', null, [
                'label' => 'Oficina',
            ])
            ->add('numero')
            ->add('_action', null, array(
                'label' => '',
                'actions' => array('show' => [])
            ));
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('orden_servicio.office');
    }

    protected function configureShowFields(ShowMapper $show)
    {
        $show
            ->add('created_at', null, [
                'label' => 'Creado',
                'format' => 'Y-m-d H:i:s'
            ])
            ->add('orden_servicio.office', null, [
                'label' => 'Oficina',
            ])
            ->add('numero')
            ->add('orden_servicio.receta.add')
            ->add('orden_servicio.receta.cristal_od')
            ->add('orden_servicio.receta.cristal_oi');
    }
}