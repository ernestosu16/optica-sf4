<?php

namespace App\Admin;


use App\Entity\AppAccesorio;
use App\Entity\AppArmadura;
use App\Entity\AppCristal;
use App\Entity\AppOrdenServicio;
use App\Entity\AppProducto;
use App\Entity\AppReceta;
use App\Entity\AppRecetaLugar;
use App\Entity\AppSolicitudTallado;
use App\Entity\MovimientoAlmacen\Alamacen;
use App\Entity\SecurityUser;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\QueryBuilder;
use Exception;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\Form\Type\DateTimePickerType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Request;

class AppOrdenServicioAdmin extends _BaseAdmin_
{
    public $formPaciente = false;
    public $formReceta = true;
    /**
     * @var SecurityUser
     */
    private $user;

//    public function getTemplate($name)
//    {
////        if ($name == "create")
////            return '::Admin\Almacen\view__confirmar_factura.html.twig';
//
//        return $this->getTemplateRegistry()->getTemplate($name);
//    }

    public function configureActionButtons($action, $object = null)
    {
        $list['button__crear_receta']['template'] = '::Admin\OrdenServicio\button__crear_receta.html.twig';
        $list['button__lista_receta']['template'] = '::Admin\OrdenServicio\button__lista_receta.html.twig';
        $list['button__cambio_armadura']['template'] = '::Admin\OrdenServicio\button__cambio_armadura.html.twig';

        return $list;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(array('list', 'create'));

        $collection->add('orden_servicio_sin_recta', 'orden_servicio_sin_receta');
        $collection->add('orden_servicio_receta', 'orden_servicio_receta/{receta_id}');
        $collection->add('datos_orden_servicio', 'datos_orden_servicio/{id}');
        # Ruta para comprobar la existencia de los productos
        $collection->add('comprobar_exitencia', 'comprobar_exitencia/{receta_id}');


        $collection->add('cambio_armadura', 'cambio_armadura');

        return $collection;
    }

    public function getPersistentParameters()
    {
        if (!$this->getRequest()) {
            return [];
        }

        return [
            'context' => $this->getRequest()->get('context', 'nueva_receta'),
        ];
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $this->user = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();
        $context = $this->getRequest()->get('context');

        if ($recetaId = $this->getRequest()->get('receta')) {
            $this->OrdenServicioReceta($formMapper, $recetaId);
            return;
        }

        if ($context === 'cambio_armadura') {
            $this->formReceta = false;
            $this->formPaciente = true;
        }

        /** @var AppOrdenServicio $object */
        $object = $this->getSubject();

        if ($this->isCurrentRoute('create')) {
            $this->formPaciente = true;
        }

        $formMapper
            ->with('Datos de la Orden', ['class' => 'col-md-4']);
        if ($this->formPaciente) {
            $formMapper->add('paciente', ModelListType::class);
        }
        $formMapper
            ->add('precio', MoneyType::class, [
                'currency' => 'CUP',
                'attr' => ['readonly' => true]
            ])
            ->add('armadura', ModelType::class, [
                'placeholder' => 'Propia',
                'btn_add' => '',
                'required' => false,
                'query' => $this->QueryArmadura(),
                'property' => 'getArmadura',
            ])
            ->add('accesorios', ModelType::class, [
                'multiple' => true,
//                'disabled' => $object->getId(),
                'attr' => ['placeholder' => 'Ningún',],
                'query' => $this->QueryAccesorio(),
                'property' => 'getAccesorio',
                'required' => false,
            ])
            ->add('observaciones', TextareaType::class, [
                'required' => false,
            ])
            ->end();

        if ($this->formReceta) {
            # Receta
            $formMapper
                ->with('Receta', ['class' => 'col-md-8', 'label' => 'Receta: ' . ($object->getReceta() ? $object->getReceta()->getPaciente() : null)])
                ->add($this->FormReceta($formMapper))
                ->end();
        }
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);

        $listMapper
            ->remove('batch')
            ->add('numero', null, array(
                'label' => 'Número'
            ))
            ->add('paciente', null, array(
                'label' => 'Paciente'
            ))
            ->add('precio', null, ['label' => 'Importe', 'template' => '::Admin\field__precio.html.twig'])
            ->add('observaciones')
//            ->add('paciente')
            ->add('tipo', null, ['label' => 'Tipo', 'template' => '::Admin\OrdenServicio\field__tipo.html.twig'])
            ->add('estado', null, ['label' => 'Estado', 'template' => '::Admin\OrdenServicio\field__estado.html.twig'])
            ->add('fecha_entrega')/*->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                ),
            ))*/
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('numero')
            ->add('paciente');
    }

    /**
     * @param $object AppOrdenServicio
     * @throws NonUniqueResultException
     */
    public function prePersist($object)
    {
        /** @var EntityManager $em */
        $em = $this->getConfigurationPool()->getContainer()->get('doctrine');

        /** @var SecurityUser $user */
        $user = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();

        $object->setNumero($this->getNuevoNumeroFactura($object));
        $object->setUsuarioCreador($user);
        $object->setOffice($user->getOffice());

        $recetaEntity = $em->getRepository(AppReceta::class)->findOneBy([
            'numero' => $object->getReceta()->getNumero(),
            'cristal_od' => $object->getReceta()->getCristalOd(),
            'cristal_oi' => $object->getReceta()->getCristalOi(),
        ]);

        $object->setReceta($recetaEntity);
        $object->setPaciente($recetaEntity->getPaciente());

        $request = $this->getRequest();

        if ($request->request->has('solicitud-tallado')) {
            $solicitud = new AppSolicitudTallado();
            $solicitud->setNumero($this->getNuevoNumeroSolicitud($object));

            $object->setSolicitudTallado($solicitud);
        } else {
            $this->ReservarProducto($object);
        }
    }

    private function FormReceta($formMapper, array $optionParameters = [])
    {
        $option = [
            'disabled' => false,
        ];

        $option = array_merge($option, $optionParameters);

        /** @var FormBuilder $formMapper */
        $form = $formMapper->create('receta', FormType::class, [
            'label' => false,
            'by_reference' => true,
            'data_class' => AppReceta::class,
        ]);

//        if (isset($option['receta']) && $option['receta'] instanceof AppReceta) {
//            /** @var AppReceta $receta */
//            $receta = $option['receta'];
//            $form
//                ->add('id_receta', HiddenType::class, [
//                    'mapped' => false,
//                    'data' => $receta->getId(),
//                ]);
//        }

        # Datos general de la receta
        $form
            ->add('numero', null, [
                'label' => 'Número',
                'required' => true,
                'disabled' => $option['disabled'],
            ])
            ->add('fecha_refraccion', DateTimePickerType::class, [
                'disabled' => $option['disabled'],
                'required' => false,
                'label' => 'Fecha de Refracción',
                'format' => 'yyyy-MM-dd',
                'dp_default_date' => date('Y-m-d'),
            ])
            ->add('dp', null, [
                'disabled' => $option['disabled'],
                'label' => 'DP'
            ])
            ->add('add', null, [
                'disabled' => $option['disabled'],
            ]);


        # Ojo derecho
        $form = $form
            ->add('cristal_od', ModelType::class, array(
                'model_manager' => $this->modelManager,
                'class' => AppCristal::class,
                'query' => $this->QueryOjo(),
                'disabled' => $option['disabled'],
                'label' => 'Selecciona la graduación del OD',
                'property' => 'getPorUnidad',
                'required' => true,
                'placeholder' => '--Seleccione el Cristal OD--',

            ))
            ->add('eje_od', null, array(
                'disabled' => $option['disabled'],
                'label' => 'Eje'
            ))
            ->add('a_visual_od', null, array(
                'disabled' => $option['disabled'],
                'label' => 'Agudeza Visual'
            ))
            # Ojo izquierdo
            ->add('cristal_oi', ModelType::class, array(
                'model_manager' => $this->modelManager,
                'class' => AppCristal::class,
                'query' => $this->QueryOjo(),
                'disabled' => $option['disabled'],
                'label' => 'Selecciona la graduación del OI',
                'property' => 'getPorUnidad',
                'required' => true,
                'placeholder' => '--Seleccione el Cristal OI--',
            ))
            ->add('eje_oi', null, array(
                'disabled' => $option['disabled'],
                'label' => 'Eje'
            ))
            ->add('a_visual_oi', null, array(
                'disabled' => $option['disabled'],
                'label' => 'Agudeza Visual'
            ))
            # Lista espejuelos
            ->add('lista_espejuelo', ChoiceType::class, [
                'disabled' => $option['disabled'],
                'expanded' => true,
                'label' => 'Tipo de espejuelo',
                'multiple' => true,
                'required' => true,
                'choices' => [
                    'Lejos' => 'lejos',
                    'Cerca' => 'cerca',
                    'Intermedia' => 'intermedia',
                    'Bifocal - $11.50' => 'bifocal',
                    'Progresivos - $31.15' => 'progresivos',
                ]
            ]);


        return $form;
    }


    private function getNuevoNumeroFactura(AppOrdenServicio $object)
    {
        if ($object->getId()) {
            return $object->getNumero();
        }

        /** @var EntityManager $em */
        $em = $this->getConfigurationPool()->getContainer()->get('doctrine');
        $lastRow = $em->getRepository(AppOrdenServicio::class)->getLastRow();

        return (!$lastRow) ? 1 : $lastRow->getNumero() + 1;
    }

    /**
     * Lista las armadura de la unidad
     *
     * @return QueryBuilder
     */
    private function QueryArmadura()
    {
        if (!$this->user && !$this->user->getId()) {
            new Exception("Error al encontrar el usuario");
        }

        $office = $this->user->getOffice()->getId();

        /** @var QueryBuilder $query */
        $query = $this->getModelManager()->createQuery(Alamacen::class, 'a');
        $rootAlias = $query->getRootAliases()[0];
        return $query
            ->join($rootAlias . '.producto', 'p')
            ->join('p.armaduras', 'armaduras')
            ->where('(a.cantidad_existencia - a.cantidad_reservado) > 0')
            ->andWhere("a.office = {$office}");
    }

    /**
     * Lista los accesorios de la unidad
     *
     * @return QueryBuilder
     */
    private function QueryAccesorio()
    {
        if (!$this->user && !$this->user->getId()) {
            new Exception("Error al encontrar el usuario");
        }

        $office = $this->user->getOffice()->getId();

        /** @var QueryBuilder $query */
        $query = $this->getModelManager()->createQuery(Alamacen::class, 'a');
        $rootAlias = $query->getRootAliases()[0];
        return $query
            ->join($rootAlias . '.producto', 'p')
            ->join('p.accesorios', 'accesorios')
            ->where('(a.cantidad_existencia - a.cantidad_reservado) > 0')
            ->andWhere("a.office = {$office}");
    }

    private function QueryOjo()
    {
        if (!$this->user && !$this->user->getId()) {
            new Exception("Error al encontrar el usuario");
        }

        $office = $this->user->getOffice()->getId();

        /** @var QueryBuilder $query */
        $query = $this->getModelManager()->createQuery(AppCristal::class, 'c');
        $rootAlias = $query->getRootAliases()[0];
        return $query
            ->select('c')
            ->join($rootAlias . '.producto', 'p')
            ->leftJoin('p.almacen', 'almacen');
    }

    /**
     * @param AppOrdenServicio $object
     * @return int|string|null
     * @throws NonUniqueResultException
     */
    private function getNuevoNumeroSolicitud(AppOrdenServicio $object)
    {
        if ($object->getId()) {
            return $object->getNumero();
        }

        /** @var EntityManager $em */
        $em = $this->getConfigurationPool()->getContainer()->get('doctrine');
        $lastRow = $em->getRepository(AppSolicitudTallado::class)->getLastRowForOffice($object->getOffice());

        return (!$lastRow) ? 1 : $lastRow->getNumero() + 1;
    }

    private function ReservarProducto(AppOrdenServicio $object)
    {
        /** @var EntityManager $em */
        $em = $this->getConfigurationPool()->getContainer()->get('doctrine');
        /** @var SecurityUser $user */
        $user = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();

        if ($object->getArmadura()) {
            # Reserva de las armaduras
            $armadura = $em->getRepository(Alamacen::class)->getProductoOficina(
                $object->getArmadura()->getProducto(),
                $user->getOffice()
            );
            $armadura->setCantidadReservado($armadura->getCantidadReservado() + 1);
        }

        if ($object->getAccesorios()) {
            # Reserva de los accesorios
            /** @var AppAccesorio $accesorio */
            foreach ($object->getAccesorios() as $accesorio) {
                $accesorioEntity = $em->getRepository(Alamacen::class)->getProductoOficina(
                    $accesorio->getProducto(),
                    $user->getOffice()
                );
                $accesorioEntity->setCantidadReservado($accesorioEntity->getCantidadReservado() + 1);
            }
        }

        if ($object->getReceta()) {
            # Reserva del Cristal OD
            $cristalOD = $em->getRepository(Alamacen::class)->getProductoOficina(
                $object->getReceta()->getCristalOd()->getProducto(),
                $user->getOffice()
            );
            $cristalOD->setCantidadReservado($cristalOD->getCantidadReservado() + 0.5);

            # Reserva del Cristal OI
            $cristalOI = $em->getRepository(Alamacen::class)->getProductoOficina(
                $object->getReceta()->getCristalOi()->getProducto(),
                $user->getOffice()
            );
            $cristalOI->setCantidadReservado($cristalOI->getCantidadReservado() + 0.5);
        }
    }

    private function OrdenServicioReceta(FormMapper $formMapper, $recetaId)
    {
        /** @var EntityManager $em */
        $em = $this->getConfigurationPool()->getContainer()->get('doctrine');

        $recetaEntity = $em->getRepository(AppReceta::class)->find($recetaId);

        /** @var AppOrdenServicio $object */
        $object = $this->getSubject();

        $object->setReceta($recetaEntity);

        $formMapper
            ->with('Datos de la Orden', ['class' => 'col-md-4']);
        $formMapper
            ->add('precio', MoneyType::class, [
                'currency' => 'CUP',
                'attr' => ['readonly' => true]
            ])
            ->add('armadura', ModelType::class, [
                'placeholder' => 'Propia',
                'btn_add' => '',
                'required' => false,
                'query' => $this->QueryArmadura(),
                'property' => 'getArmadura',
            ])
            ->add('accesorios', ModelType::class, [
                'multiple' => true,
                'attr' => ['placeholder' => 'Ningún',],
                'query' => $this->QueryAccesorio(),
                'property' => 'getAccesorio',
            ])
            ->add('observaciones', TextareaType::class, [
                'required' => false,
            ])
            ->end();

        if ($this->formReceta) {
            # Receta
            $formMapper
                ->with('Receta', ['class' => 'col-md-8', 'label' => 'Receta: ' . ($object->getReceta() ? $object->getReceta()->getPaciente() : null)])
                ->add($this->FormReceta($formMapper, [
//                    'disabled' => true,
//                    'readonly' => true,
                    'receta' => $recetaEntity,
                ]))
                ->end();
        }

        return $formMapper;
    }
}