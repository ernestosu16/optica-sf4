<?php

namespace App\Admin;


use App\Entity\AppOrdenServicio;
use App\Entity\AppProducto;
use App\Entity\AppReceta;
use App\Entity\AppRecetaLugar;
use App\Entity\SecurityUser;
use Doctrine\ORM\EntityManager;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\Form\Type\DateTimePickerType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilder;

class AppOrdenServicioAdmin extends _BaseAdmin_
{
    public $formPaciente = false;
    public $formReceta = true;

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
            'context'  => $this->getRequest()->get('context', 'nueva_receta'),
        ];
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $context = $this->getRequest()->get('context');

        if($context === 'cambio_armadura'){
            $this->formReceta = false;
            $this->formPaciente = true;
        }

        /** @var AppOrdenServicio $object */
        $object = $this->getSubject();

        if ($this->isCurrentRoute('create')) {
            $this->formPaciente = true;
        }

        $query_armadura = $this->modelManager
            ->getEntityManager(AppProducto::class)
            ->createQueryBuilder()
            ->add('select', 'p')
            ->add('from', '\App\Entity\AppProducto p')
            ->innerJoin('p.accesorios', 'a')
            ->add('orderBy', 'p.descripcion ASC');

        $formMapper
            ->with('Datos de la Orden', ['class' => 'col-md-4']);
        if ($this->formPaciente) {
            $formMapper->add('paciente', ModelListType::class);
        }
        $formMapper->add('precio', MoneyType::class, [
            'currency' => 'CUP',
            'attr' => ['readonly' => true]
        ])
            ->add('armadura', ModelType::class, [
//                'disabled' => $object->getId(),
                'placeholder' => 'Propia',
                'btn_add' => '',
                'required' => false,
//                'query_builder' => $query_armadura,
            ])
            ->add('accesorios', null, [
//                'disabled' => $object->getId(),
                'attr' => ['placeholder' => 'Ningún',],
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
                'label' => 'No.'
            ))
            ->add('precio')
            ->add('observaciones')
            ->add('paciente')
            ->add('fecha_entrega')/*->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                ),
            ))*/
        ;
    }

    /**
     * @param $object AppOrdenServicio
     */
    public function prePersist($object)
    {
        /** @var SecurityUser $user */
        $user = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();

        $object->setNumero($this->getNuevoNumeroFactura($object));
        $object->setUsuarioCreador($user);
        $object->setOffice($user->getOffice());
    }

    private function FormReceta($formMapper)
    {
        /** @var FormBuilder $form */
        $form = $formMapper->create('receta', FormType::class, array(
            'label' => false, 'by_reference' => true, 'data_class' => AppReceta::class));

//        if ($this->formPaciente) {
//            $form
//                ->add('paciente', ModelListType::class, [
//                    'model_manager' => $this->modelManager,
//
//                ])
//                ->add('paciente_lista', ButtonType::class, [
//                    'label' => 'Lista',
//                    'attr' => ['style' => 'margin-top:25px', 'class' => 'btn btn-info btn-sm sonata-ba-action'],
//
//                ])
//                ->add('paciente_agregar', ButtonType::class, [
//                    'label' => 'Nuevo',
//                    'attr' => ['style' => 'margin-top:25px', 'class' => 'btn btn-success btn-sm sonata-ba-action'],
//
//                ]);
//        }

        # Datos general de la receta
        $form->add('numero', null, [
        ])
            ->add('fecha_refraccion', DateTimePickerType::class, [
                //'disabled' => true,
                'required' => false,
                'label' => 'Fecha de Refracción',
                'format' => 'yyyy-MM-dd'
            ])
            ->add('dp', null, [
                //'disabled' => true,
                'label' => 'DP'
            ])
            ->add('add', null, []);


        # Ojo derecho
        $form = $form->add('cristal_od', null, array(
            //'disabled' => true,
            'label' => 'OD Cristal',
            'choice_label' => 'getPorUnidad',
            'required' => true,
            'placeholder' => '--Seleccione el Cristal OD--',

        ))
            ->add('eje_od', null, array(
                //'disabled' => true,
                'label' => 'Eje'
            ))
            ->add('a_visual_od', null, array(
                //'disabled' => true,
                'label' => 'Agudeza Visual'
            ))
            # Ojo izquierdo
            ->add('cristal_oi', null, array(
                //'disabled' => true,
                'label' => 'OI Cristal',
                'choice_label' => 'getPorUnidad',
                'required' => true,
                'placeholder' => '--Seleccione el Cristal OI--',
            ))
            ->add('eje_oi', null, array(
                //'disabled' => true,
                'label' => 'Eje'
            ))
            ->add('a_visual_oi', null, array(
                //'disabled' => true,
                'label' => 'Agudeza Visual'
            ))
            ->add('lista_espejuelo', ChoiceType::class, [
                'expanded' => true,
                'label' => 'Tipo de espejuelo',
                'multiple' => true,
                'required' => true,
                'choices' => [
                    'Lejos' => 'lejos',
                    'Cerca' => 'cerca',
                    'Intermedia' => 'intermedia',
                    'Bifocal' => 'bifocal',
                    'Progresivos' => 'progresivos',
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
}