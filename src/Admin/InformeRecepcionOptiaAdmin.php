<?php


namespace App\Admin;

use App\Entity\MovimientoAlmacen\InformeRecepcionOptica;
use App\Entity\MovimientoAlmacen\InformeRecepcionOpticaArmadura;
use App\Entity\SecurityUser;
use Doctrine\ORM\EntityManager;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelHiddenType;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\Form\Type\CollectionType;
use Sonata\Form\Type\DatePickerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class InformeRecepcionOptiaAdmin extends _BaseAdmin_
{
    protected $baseRoutePattern = 'informerecepcionoptica';

    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);
        $collection->remove('show');
        $collection->add('export_pdf', $this->getRouterIdParameter() . "/export");

        $collection->add('informe_recepcion_pdf', $this->getRouterIdParameter() . "/informe_recepcion_pdf");
    }

    public function getTemplate($name)
    {
        if ($name == "export_pdf")
            return '::Admin\informe_recepcion_optica\modelo\vale_salida.html.twig';

        return parent::getTemplate($name);
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $object = $this->getSubject();
        /* @var $object InformeRecepcionOptica */

        /** @var EntityManager $em */
        $em = $this->getConfigurationPool()->getContainer()->get('doctrine');

        if (!$object->getId()) {
            $formMapper
                ->with('Tipo de Factura', array('class' => 'col-md-3'))
//                ->add('usuario_creador', TextType::class, ['data'=>$this->getUser()])
//                ->add('office_origen', ModelHiddenType::class)
                ->add('tipo_factura', ChoiceType::class, [
                    'expanded' => true,
                    'label' => false,
                    'choices' => [
                        'Acccesorios' => 0,
                        'Armaduras' => 1,
                        'Cristales' => 2,
                        'Lupas' => 3,
                        'Tinte Cristal' => 4,
                    ]
                ])
                ->end();
        }
        $formMapper->with('Datos de la Recepción', array('class' => 'col-md-3'))
            ->add('fecha', DatePickerType::class, array(
                'format' => 'dd/MM/yyyy',
                'required' => true,
                'disabled' => $object->getId(),
            ))
            ->add('numero_factura', null, array(
                'disabled' => true,
                'label' => 'Número de la factura',
                'data' => $this->getNuevoNumeroFactura($object),
            ))
            ->add('office_destino', null, [
                'label' => 'Oficina destino',
                'required' => true,
                'disabled' => $object->getId(),
            ])
            ->end();


        $disabled = false;
        if ($object->getId() && $object->getDevuelto() !== true) {
            $disabled = true;

        }
        if ($object->getId() && $disabled === false) {
            $formMapper->with('Nota de la devolución', array('class' => 'col-md-6'))
                ->add('devuelto_descripcion', TextareaType::class, [
                    'label' => ' Descripción',
                    'disabled' => !$disabled,
                ])
                ->end();
        }

        if (!$object->getId() || count($object->getAccesorios())) {
            $formMapper->with('Accesorios', array('class' => 'col-md-6'))
                ->add('accesorios', CollectionType::class, array(
                    'label' => false,
                    'disabled' => $disabled,
                    "by_reference" => false,
                    'btn_add' => $disabled ? false : 'link_add',
                    'type_options' => array(
                        'delete' => !$disabled,
                    )
                ), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                ))
                ->end();
        }

        if (!$object->getId() || count($object->getArmaduras())) {
            $formMapper->with('Armaduras', array('class' => 'col-md-6'))
                ->add('armaduras', CollectionType::class, array(
                    'label' => false,
                    'disabled' => $disabled,
                    "by_reference" => false,
                    'btn_add' => $disabled ? false : 'link_add',
                    'type_options' => array(
                        'delete' => !$disabled,
                    )
                ), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                ))
                ->end();
        }

        if (!$object->getId() || count($object->getCristales())) {
            $formMapper->with('Cristales', array('class' => 'col-md-6'))
                ->add('cristales', CollectionType::class, array(
                    'label' => false,
                    'disabled' => $disabled,
                    "by_reference" => false,
                    'btn_add' => $disabled ? false : 'link_add',
                    'type_options' => array(
                        'delete' => !$disabled,
                    )
                ), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                ))
                ->end();
        }

        if (!$object->getId() || count($object->getLupas())) {
            $formMapper->with('Lupas', array('class' => 'col-md-6'))
                ->add('lupas', CollectionType::class, array(
                    'label' => false,
                    'disabled' => $disabled,
                    "by_reference" => false,
                    'btn_add' => $disabled ? false : 'link_add',
                    'type_options' => array(
                        'delete' => !$disabled,
                    )
                ), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                ))
                ->end();
        }
        if (!$object->getId() || count($object->getTinteCristales())) {
            $formMapper->with('Tinte Cristal', array('class' => 'col-md-6'))
                ->add('tinte_cristales', CollectionType::class, array(
                    'label' => false,
                    'disabled' => $disabled,
                    "by_reference" => false,
                    'btn_add' => $disabled ? false : 'link_add',
                    'type_options' => array(
                        'delete' => !$disabled,
                    )
                ), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                ))
                ->end();
        }
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);

        $listMapper
            ->remove('batch')
            ->add('numero_factura', null, ['label' => 'No.'])
            ->add('fecha', null, array(
                'format' => 'd/m/Y',
            ))
            ->add('producto', null, [
                'label' => 'Productos',
                'template' => '::Admin\informe_recepcion_optica\producto__list.html.twig'
            ])
            ->add('office_destino', null, ['label' => 'Destino'])
            ->add('estado', null, ['template' => '::Admin\informe_recepcion_optica\tr__estado.html.twig'])
//            ->add('accesorios')
//            ->add('armaduras')
//            ->add('cristales')
//            ->add('confirmado')
//            ->add('pendiente')
//            ->add('devuelto')
            ->add('_action', null, array(
                'label' => 'Acciones',
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                    'export' => array(
                        'template' => '::Admin\informe_recepcion_optica\list__action_export.html.twig'
                    ),
                ),
            ));
    }

    /**
     * @param $object InformeRecepcionOptica
     */
    public function prePersist($object)
    {
        /** @var SecurityUser $user */
        $user = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();

        /** @var InformeRecepcionOpticaArmadura[] $armadura */
        $armaduras = $this->getForm()->get('armaduras')->getData();

        /** @var InformeRecepcionOpticaArmadura $item */
        foreach ($armaduras as $item) {
            $item->setInformeRecepcion($this->getSubject());

        }


        $object->setNumeroFactura($this->getNuevoNumeroFactura($object));
        $object->setUsuarioCreador($user);
        $object->setOfficeOrigen($user->getOffice());
    }

    /**
     * @param $object InformeRecepcionOptica
     */
    public function Update($object)
    {
//        /** @var InformeRecepcionOpticaArmadura[] $armadura */
//        $armaduras = $this->getForm()->get('armaduras')->getData();
//
//        /** @var InformeRecepcionOpticaArmadura $item */
//        foreach ($armaduras as $item) {
//            $item->setInformeRecepcion($this->getSubject());
//
//        }
        $object->setDevuelto(false);

        parent::Update($object);
    }

    private function getNuevoNumeroFactura(InformeRecepcionOptica $object)
    {
        if ($object->getId()) {
            return $object->getNumeroFactura();
        }

        /** @var EntityManager $em */
        $em = $this->getConfigurationPool()->getContainer()->get('doctrine');
        $lastRow = $em->getRepository(InformeRecepcionOptica::class)->getLastRow();

        return (!$lastRow) ? 1 : $lastRow->getNumeroFactura() + 1;
    }
}