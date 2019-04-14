<?php

namespace  App\Auditoria\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\DateRangePickerType;
use Sonata\Form\Type\DateTimeRangeType;

class AuditoriaLogAdmin extends AbstractAdmin
{
    /**
     *
     * @return string
     */
    public function getTranslationDomain() {
       return 'SIPAuditoria';
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
           // ->add('id')
            ->add('action')
            ->add('source.class')
            ->add('blame.label')
//            ->add('loggedAt',DateRangePickerType::class, array(
////                'field_type' => DateRangePickerType::class,
////                'show_filter' => true
//            ))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
           // ->add('id')
            ->add('action')
           // ->add('tbl')
           // ->add('diff')
            ->add('loggedAt')
           /* ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))*/
        ;
    }

    /**
     *
     * @param \Sonata\AdminBundle\Route\RouteCollection $routes
     */
    protected function configureRoutes(\Sonata\AdminBundle\Route\RouteCollection $routes) {
        $routes->remove('history');
        $routes->remove('create');
        $routes->remove('edit');
        $routes->remove('export');
    }

    /**
     * @param FormMapper $formMapper
     * @return FormMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        return $formMapper;
//        $formMapper
//            ->add('id')
//            ->add('action')
//            ->add('tbl')
//            ->add('diff')
//            ->add('loggedAt')
//        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
           // ->add('id')
            ->add('action')
          //  ->add('tbl')
            ->add('diff')
            ->add('source')
          //  ->add('loggedAt')
        ;
    }

    /***
     * @param string $name
     * @return mixed|null|string
     */
    public function getTemplate($name) {
        switch ($name) {
            case 'list':
                return "app/auditoria/Admin/base_list.html.twig";
                break;
            case 'show':
                return "app/auditoria/diff.html.twig";
                break;
        }
        return parent::getTemplate($name);
    }
}
