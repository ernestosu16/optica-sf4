<?php


namespace App\Admin;


use App\Entity\AppOrdenServicio;
use App\Entity\SecurityUser;
use Doctrine\ORM\EntityManager;
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
    private $user;

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
        $formMapper->add('numero');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        /** @var SecurityUser $user */
        $this->user = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();

        $this->lista_pendiente = $this->obtenerListaPendienteDespacho();
        $listMapper->add('numero');
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('numero');
    }

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
        $em = $this->getConfigurationPool()->getContainer()->get('doctrine');

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
}