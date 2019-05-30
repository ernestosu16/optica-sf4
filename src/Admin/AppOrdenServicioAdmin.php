<?php

namespace App\Admin;


use App\Entity\AppOrdenServicio;
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

        return $collection;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        /** @var AppOrdenServicio $object */
        $object = $this->getSubject();

        $formMapper
            ->tab('Orden de Servicio')
            ->with('Datos de la Orden', ['class' => 'col-md-4'])
//            ->add('numero', null, ['label' => 'Número', 'required' => true])
            ->add('precio', MoneyType::class, [
                'currency' => 'CUP',
                'attr' => ['readonly' => true]
            ])
            ->add('armadura', null, [
                'disabled' => $object->getId(),
            ])
            ->add('accesorios', null, [
                'disabled' => $object->getId(),
            ])
            ->end();

        # Receta
        $formMapper
            ->with('Receta', ['class' => 'col-md-8'])
            ->add(
                $formMapper->create('receta', FormType::class, array(
                    'label' => false, 'by_reference' => true, 'data_class' => AppReceta::class))
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
                        'label' => 'Cristal'
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
                        'label' => 'Cristal'
                    ))
                    ->add('eje_oi', null, array(
                        //'disabled' => true,
                        'label' => 'Eje'
                    ))
                    ->add('a_visual_oi', null, array(
                        //'disabled' => true,
                        'label' => 'Agudeza Visual'
                    ))
            )
            ->end()
            ->end();

//        # Armadura y Accesorios
//        $formMapper
//            ->tab('Armadura y Accesorios', array('class' => 'col-md-5'))
//            ->with('Armadura', ['class' => 'col-md-6'])
//            ->add('armadura', null, [
//                'disabled' => $object->getId(),
//            ])
//            ->end();
//
//        # Accesorios
//        $formMapper
//            ->with('Accesorios', ['class' => 'col-md-6'])
//            ->end()
//            ->end();
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