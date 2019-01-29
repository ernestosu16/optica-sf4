<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class NomencladorAccesorioAdmin extends AbstractAdmin
{
    /**
     * Para indicar los formatos a los que permitirá exportar la lista
     */
    public function getExportFormats()
    {
        return array();
    }

    /**
     *
     * Para adicionar o eliminar funcionalidades del CRUD
     */
    protected function configureRoutes(RouteCollection $routes)
    {
        $routes->remove('history');
        $routes->remove('batch');
        $routes->remove('show');
        $routes->remove('export');
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            //->add('id')
            ->add('codigo')
            ->add('nombre')
            ->add('precioCosto', null, array(
                'label' => 'Precio de Costo'
            ))
            ->add('precioVenta', null, array(
                'label' => 'Precio de Venta'
            ))
            ->add('existencia', null, array(
                'label' => 'Cantidad en Existencia'
            ))
            ->add('reservado', null, array(
                'label' => 'Cantidad en Reserva'
            ))
            ->add('disponible', null, array(
                'label' => 'Cantidad Disponible'
            ));
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);

        $listMapper
            ->remove('batch')
            ->add('id', null, array(
                'label' => 'No.'
            ))
            ->add('codigo')
            ->add('nombre')
            ->add('precioCosto', null, array(
                'label' => 'Precio de Costo'
            ))
            ->add('precioVenta', null, array(
                'label' => 'Precio de Venta'
            ))
            ->add('existencia', null, array(
                'label' => 'Existencia'
            ))
            ->add('reservado', null, array(
                'label' => 'En Reserva',
            ))
            ->add('disponible', null, array(
                'label' => 'Disponible',
            ))
            ->add('_action', null, array(
                'label' => 'Acciones',
                'row_align' => 'right',
                'header_style' => 'width: 190px',
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                ),
            ));
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $object = $this->getSubject();

        $formMapper
            //->add('id')
            ->with('Datos Primarios', array('class' => 'col-md-4'))
            ->add('codigo')
            ->add('nombre')
            ->end()
            ->with('Precios', array('class' => 'col-md-4'))
            ->add('precioCosto', MoneyType::class, array(
                'label' => 'Precio de Costo',
                'currency' => 'USD',
                'grouping' => true,
                'scale' => 2,
            ))
            ->add('precioVenta', MoneyType::class, array(
                'label' => 'Precio de Venta',
                'currency' => 'USD',
                'grouping' => true,
                'scale' => 2,
            ))
            ->end()
            ->with('Existencia', array('class' => 'col-md-4'))
            ->add('existencia', null, array(
                'label' => 'Cantidad en Existencia',
                'disabled' => $object->getId() ? true : false,
                'grouping' => true,
                'scale' => 2,
            ))
            ->add('reservado', null, array(
                'label' => 'Cantidad en Reserva',
                'disabled' => true,
                'grouping' => true,
                'scale' => 2,
            ))
            ->add('disponible', null, array(
                'label' => 'Cantidad Disponible',
                'disabled' => true,
                'grouping' => true,
                'scale' => 2,
            ))
            ->end();
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('codigo')
            ->add('nombre')
            ->add('precioCosto')
            ->add('precioVenta')
            ->add('existencia')
            ->add('reservado')
            ->add('disponible');
    }

    public function prePersist($object)
    {
        parent::prePersist($object);

        $object->setReservado(0);
        $object->setDisponible($object->getExistencia());

    }
}
