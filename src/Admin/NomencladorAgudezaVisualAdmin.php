<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class NomencladorAgudezaVisualAdmin extends AbstractAdmin
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
     * @param RouteCollection $routes
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
            ->add('valor', null, array(
				'label'=>'Valor de la Agudeza'
			))
        ;
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
				'label'=>'No.'
			))
            ->add('valor')
            ->add('_action', null, array(
				'row_align' => 'right',
				'header_style' => 'width: 190px',
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                ),
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            //->add('id')
			->with('Indique valor de la Agudeza Visual', array(
				'class'=>'col-md-4'
			))
            ->add('valor')
			->end()
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            //->add('id')
            ->add('valor')
        ;
    }
}
