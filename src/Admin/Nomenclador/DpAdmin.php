<?php

namespace App\Admin\Nomenclador;

use App\Admin\_BaseAdmin_;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class DpAdmin extends _BaseAdmin_
{
    /**
     * Para indicar los formatos a los que permitirá exportar la lista
     */
    public function getExportFormats()
    {
        return array(// 'json', 'xml', 'csv', 'xls'
        );
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
            ->add('cerca')
            ->add('lejos');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);

        $listMapper
            ->remove('batch')
            /**->add('id', null, array(
                'label' => 'No.'
            ))*/
            ->add('cerca')
            ->add('lejos')
            ->add('_action', null, array(
                'label'=> 'Acciones',
                'row_align' => 'center',
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
        $formMapper
            //->add('id')
            ->with('Indique los valores de las distancias pupilares', array(
                'class' => 'col-md-3'
            ))
            ->add('cerca', null, [
                'attr' => [
                    'title' => 'El campo solo puedo contener número',
                    'pattern' => '^[\d]*$',
                ]
            ])
            ->add('lejos', null, [
                'attr' => [
                    'title' => 'El campo solo puedo contener número',
                    'pattern' => '^[\d]*$',
                ]
            ])
            ->end();
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            //->add('id')
            ->add('cerca')
            ->add('lejos');
    }
}
