<?php


namespace App\Admin;


use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class InformeRecepcionEconomicoAdmin extends _BaseAdmin_
{
    protected $baseRoutePattern = 'movimientoalmacen-alamacen-economico';
    protected $baseRouteName = 'movimientoalmacen-alamacen-economico';

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('export');
        $collection->remove('delete');
        $collection->remove('create');
        $collection->remove('edit');
        $collection->remove('show');
    }

    protected function configureFormFields(FormMapper $form)
    {
        return false;
    }

    protected function configureListFields(ListMapper $list)
    {
        $list->remove('bash');
        $list
            ->add('fecha', null, ['label' => 'Fecha'])
            ->add('numero_factura', null, ['label' => 'No. Factura'])
            ->add('numero_informe_recepcion', null, ['label' => 'No. Recepción'])
            ->add('office_destino', null, ['label' => 'Destino'])
            ->add('producto', null, [
                'label' => 'Productos',
                'template' => '::Admin\informe_recepcion_optica\producto__list.html.twig'
            ])
            ->add('usuario_creador', null, ['label' => 'Creado'])
            ->add('estado', null, ['template' => '::Admin\informe_recepcion_optica\tr__estado.html.twig']);

        $list->add('_action', null, array(
            'label' => '',
            'actions' => [
                'others' => ['template' => '::Admin\informe_recepcion_optica\economia\list__action_export.html.twig'],
            ],
        ));;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('numero_factura')
            ->add('numero_informe_recepcion')
            ->add('office_destino', null, [], null, ['expanded' => true, 'multiple' => true]);
    }
}