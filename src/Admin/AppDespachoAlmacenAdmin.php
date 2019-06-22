<?php


namespace App\Admin;


use App\Entity\AppOrdenServicio;
use App\Entity\DespachoAlmacen\AppDespachoAlmacen;
use App\Entity\SecurityUser;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NonUniqueResultException;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class AppDespachoAlmacenAdmin extends _BaseAdmin_
{
    /**
     * @var array
     */
    public $lista_pendiente = [];
    /**
     * @var SecurityUser|string
     */
    public $user;
    /**
     * @var EntityManager
     */
    public $em;

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['list', 'edit']);

        # Creación y edición del despacho
        $collection->add('despacho', 'despacho/{fecha}');

    }

    public function configureActionButtons($action, $object = null)
    {
        $list = parent::configureActionButtons($action, $object);
        $list['lista_despacho']['template'] = '::Admin\DespachoAlmacen\button\button__lista_despacho.html.twig';

        return $list;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
//        $formMapper
//            ->add('fecha')
//            ->add('numero')
//        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);

        /** @var SecurityUser $user */
        $this->user = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();

        $this->lista_pendiente = $this->obtenerListaPendienteDespacho();
        $listMapper
            ->add('fecha', null, ['format' => 'Y-m-d'])
            ->add('Asociado', null, [
                'template' => '::Admin\DespachoAlmacen\fields\asociado.html.twig'
            ])
            ->add('_action', null, array(
                'label' => 'Acción',
                'actions' => array(
//                    'show' => array(),
                    'others' => array(
                        'template' => '::Admin\DespachoAlmacen\button\button__others.html.twig',
                    ),
//                    'delete' => array(),
                )));
    }

//    protected function configureDatagridFilters(DatagridMapper $filter)
//    {
//        $filter->add('numero');
//    }

    /**
     * Obtener la lista de los despacho pendiente ejemplo
     * [fecha=>cantidad]
     * ['2019-05-01'=>5,'2019-05-02'=>15]
     * @return array
     */
    private function obtenerListaPendienteDespacho()
    {
        $list = [];

        /** @var EntityManager $em */
        $em = $this->em = $this->getConfigurationPool()->getContainer()->get('doctrine');

        $lista = $em
            ->getRepository(AppOrdenServicio::class)
            ->listaOrdenServicioNoDespacho($this->user->getOffice());

        /** @var AppOrdenServicio $item */
        foreach ($lista as $item) {
            if (!isset($list[$item->getCreatedAt()->format('Y-m-d')])) {
                $list[$item->getCreatedAt()->format('Y-m-d')] = 1;
            } else {
                $list[$item->getCreatedAt()->format('Y-m-d')]++;
            }
        }

        return $list;
    }

    /**
     * @param AppDespachoAlmacen $object
     * @return int|string|null
     * @throws NonUniqueResultException
     */
    public function getNuevoNumeroSolicitud(AppDespachoAlmacen $object)
    {
        if ($object->getId()) {
            return $object->getNumero();
        }
        /** @var SecurityUser $user */
        $this->user = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();

        /** @var EntityManager $em */
        $em = $this->em = $this->getConfigurationPool()->getContainer()->get('doctrine');
        $lastRow = $em->getRepository(AppDespachoAlmacen::class)->getOfficeLastRow($this->user->getOffice());

        return (!$lastRow) ? 1 : $lastRow->getNumero() + 1;
    }
}