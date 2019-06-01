<?php

namespace App\Admin;


use App\Entity\AppAccesorio;
use App\Entity\AppOrdenServicio;
use App\Entity\AppProducto;
use App\Entity\AppReceta;
use App\Entity\AppRecetaLugar;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\Form\Type\DateTimePickerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AppOrdenServicioAdmin extends _BaseAdmin_
{
    public function configureActionButtons($action, $object = null)
    {
        $list['button__lista_receta']['template'] = '::Admin\OrdenServicio\button__lista_receta.html.twig';
//        $list['button__crear_receta']['template'] = '::Admin\OrdenServicio\button__crear_receta.html.twig';

        return $list;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(array('list', 'create'));

        $collection->add('orden_servicio_receta', 'orden_servicio_receta/{receta_id}');
        $collection->add('datos_orden_servicio', 'datos_orden_servicio/{id}');
        # Ruta para comprobar la existencia de los productos
        $collection->add('comprobar_exitencia', 'comprobar_exitencia/{receta_id}');

        return $collection;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        /** @var AppOrdenServicio $object */
        $object = $this->getSubject();

//        $entity = new AppProducto();
//        $query = $this->modelManager->getEntityManager($entity)->createQuery('SELECT s FROM MyCompany\MyProjectBundle\Entity\Seria s ORDER BY s.nameASC');

        $query_armadura = $this->modelManager
            ->getEntityManager(AppProducto::class)
            ->createQueryBuilder()
            ->add('select', 'p')
            ->add('from', '\App\Entity\AppProducto p')
            ->innerJoin('p.accesorios','a')
            ->add('orderBy', 'p.descripcion ASC');

//        $formMapper->add('title', null, array('required' => true))
//            ->add('user', null, array('required' => true, 'query_builder' => $query_user));

        $formMapper
            ->with('Datos de la Orden', ['class' => 'col-md-4'])
            ->add('precio', MoneyType::class, [
                'currency' => 'CUP',
                'attr' => ['readonly' => true]
            ])
            ->add('armadura', null, [
                'disabled' => $object->getId(),
                'placeholder' => 'Propia',
//                'query_builder' => $query_armadura,
            ])
            ->add('accesorios', null, [
                'disabled' => $object->getId(),
                'attr' => ['placeholder' => 'Ningún',],
            ])
            ->add('observaciones', TextareaType::class, [
                'required' => false,
            ])
            ->end();

        # Receta
        $formMapper
            ->with('Receta', ['class' => 'col-md-8', 'label' => 'Receta: ' . $object->getReceta()->getPaciente()])
            ->add(
                $formMapper->create('receta', FormType::class, array(
                    'label' => false, 'by_reference' => true, 'data_class' => AppReceta::class))
                    # Datos general de la receta
                    ->add('numero', null, [
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
                    ->add('add', null, [
                    ])
                    # Ojo derecho
                    ->add('cristal_od', null, array(
                        //'disabled' => true,
                        'label' => 'OD Cristal'
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
                        'label' => 'OI Cristal'
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
                    ])
            )
            ->end();
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);

        $listMapper
            ->remove('batch')
            ->add('id', null, array(
                'label' => 'No.'
            ))
            ->add('created_at', null, ['label' => 'Fecha'])
            ->add('numero')
            ->add('precio')
            ->add('paciente')
            ->add('fecha_entrega')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                ),
            ));
    }

    /**
     * @param $object AppOrdenServicio
     */
    public function prePersist($object)
    {
    }
}