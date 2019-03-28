<?php

namespace App\Admin;


use App\Entity\AppMovimientoAlmacen;
use App\Entity\AppSubmayorProducto;
use App\Form\SubMayorProductoType;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;


class AppMovimientoAlmacenAdmin extends _BaseAdmin_
{
    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);

        $query->where("{$query->getRootAliases()[0]}.delete_at is NULL");

        return $query;
    }

    /**
     * @param $object AppMovimientoAlmacen
     */
    public function prePersist($object)
    {
        $token =  $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser() ;

        $object->setOffice($token->getOffice());

    }
//    /**
//     * @param AppMovimientoAlmacen $object
//     */
//    public function prePersist($object)
//    {
//        parent::prePersist($object);
//
//
//        foreach ($object->getSubMayor() as $ar) /* @var $ar AppSubmayorProducto */ {
//            $ar->setMovimiento($object);
//        }
//    }


    protected function configureFormFields(FormMapper $formMapper)
    {
        $object = $this->getSubject();

        $formMapper
            ->with('Datos de la Recepción', array('class' => 'col-md-4'))
            ->add('numero')
            ->add('state')
            ->add('discriminator')
//            ->add('office',HiddenType::class)
            ->end()
            ->with('Productos', array('class' => 'col-md-8'))
            ->add('sub_mayor', CollectionType::class, array(
                'label' => false,
                'disabled' => $object->getId(),
                'by_reference' => false,
                'btn_add' => $object->getId() ? false : 'link_add',
                'type_options' => array(
                    'delete' => !$object->getId(),
                )
            ), array(
                'edit' => 'inline',
                'sortable' => 'pos',
                'inline' => 'table',
            ))
            ->end();
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->remove('batch')
            ->addIdentifier('numero')
            ->add('state')
            ->add('discriminator')
            ->add('sub_mayor', null, array(
                'label' => 'Productos'
            ))
            ->add('_action', null, array(
                'label' => 'Acciones',
                'row_align' => 'right',
                'header_style' => 'width: 170px',
                'actions' => $this->actions,
            ));
    }
}