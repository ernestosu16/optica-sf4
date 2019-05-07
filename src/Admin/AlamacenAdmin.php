<?php


namespace App\Admin;


use App\Entity\MovimientoAlmacen\InformeRecepcionOptica;
use Doctrine\ORM\EntityManager;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class AlamacenAdmin extends _BaseAdmin_
{
    /**
     * @var int
     */
    public $count = 0;

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
        $collection->remove('edit');
        $collection->remove('delete');
        $collection->remove('show');
        $collection->remove('export');

        $collection->add('confirmar_factura', 'confirmar_factura');
        $collection->add('save_confirmar_factura', 'confirmar_factura/' . $this->getRouterIdParameter() . '/save');
        $collection->add('cancelar_factura', 'cancelar_factura/' . $this->getRouterIdParameter());
        $collection->add('lista_producto_factura', 'lista_producto_factura/' . $this->getRouterIdParameter());

    }

    public function configureActionButtons($action, $object = null)
    {
        $list = parent::configureActionButtons($action, $object);

        $list['confirm_factura']['template'] = '::Admin\Almacen\confirm_factura_button.html.twig';

        return $list;
    }

    // allows you to chose your custom showAction template :
    public function getTemplate($name)
    {
        if ($name == "confirm_factura")
            return '::Admin\Almacen\view__confirmar_factura.html.twig';

        if ($name == "cancelar_factura")
            return '::Admin\Almacen\view__cancelar_factura.html.twig';

        if ($name == "lista_producto_factura")
            return '::Admin\Almacen\view__lista_producto_factura.html.twig';

        return parent::getTemplate($name);
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('producto')
            ->add('producto.precio')
            ->add('cantidad_existencia', null, [
                'label' => 'Existencia'
            ])
            ->add('cantidad_reservado', null, [
                'label' => 'Reservado'
            ]);

        /** @var EntityManager $em */
        $em = $this->getConfigurationPool()->getContainer()->get('doctrine');
        $security = $this->getConfigurationPool()->getContainer()->get('security.token_storage');

        if ($security->getToken() && $security->getToken()->getUser()->getOffice()) {

            $object = $em->getRepository(InformeRecepcionOptica::class)
                ->obtenerFacturaAsignadaOficina($security->getToken()->getUser()->getOffice());
            $this->count = count($object);
        }
    }

    public function createQuery($context = 'list')
    {
        $security = $this->getConfigurationPool()->getContainer()->get('security.token_storage');

        $query = parent::createQuery($context);

        $oficinaID = 0;
        if ($security->getToken() && $security->getToken()->getUser()->getOffice()) {
            $oficinaID = $security->getToken()->getUser()->getOffice()->getId();
        }

        $query->where("{$query->getRootAliases()[0]}.office = {$oficinaID}");

        return $query;
    }
}