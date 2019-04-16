<?php

namespace App\Admin;


use App\Entity\AppOrdenServicio;
use App\Entity\AppReceta;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\Form\Type\DateTimePickerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class AppOrdenServicioAdmin extends _BaseAdmin_
{
//    protected function configureBatchActions($actions)
//    {
//        if (
//            $this->hasRoute('edit') && $this->hasAccess('edit') &&
//            $this->hasRoute('delete') && $this->hasAccess('delete')
//        ) {
//            $actions['merge'] = [
//                'ask_confirmation' => true
//            ];
//        }
//
//        return $actions;
//    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        /** @var AppOrdenServicio $object */
        $object = $this->getSubject();

        $formMapper
            ->tab('General')
            ->with('Datos de la Orden', ['class' => 'col-md-4'])
            ->add('numero', null, ['label' => 'Número'])
            ->add('precio', MoneyType::class, [
                'currency' => 'USD',
                'attr' => [
                    'readonly' => true
                ]
            ])
            ->add('paciente', $object->getId() ? null : ModelListType::class, array(
                'required' => true,
                'disabled' => $object->getId(),
            ))
            ->end();

        # Receta
        $formMapper
            ->with('Receta', ['class' => 'col-md-8'])
            ->add(
                $formMapper->create('receta', FormType::class, array(
                    'label' => false, 'by_reference' => true, 'data_class' => AppReceta::class))
                    # Datos general de la receta
                    ->add('numero', null, [
                        'disabled' => $object->getId(),
                    ])
                    ->add('fecha', DateTimePickerType::class, [
                        'disabled' => $object->getId(),
                        'required' => false
                    ])
                    ->add('dp', null, [
                        'disabled' => $object->getId(),
                        'label' => 'DP'
                    ])
                    ->add('add', null, [
                        'disabled' => $object->getId(),
                    ])
                    # Ojo derecho
                    ->add('eje_od', null, array(
                        'disabled' => $object->getId(),
                        'label' => 'Eje Derecho'
                    ))
                    ->add('a_visual_od', null, array(
                        'disabled' => $object->getId(),
                        'label' => 'Eje Derecho'
                    ))
                    ->add('cristal_od', null, array(
                        'disabled' => $object->getId(),
                        'label' => 'Cristal Derecho'
                    ))
                    # Ojo izquierdo
                    ->add('eje_oi', null, array(
                        'disabled' => $object->getId(),
                        'label' => 'Eje Izquierdo'
                    ))
                    ->add('a_visual_oi', null, array(
                        'disabled' => $object->getId(),
                        'label' => 'Eje Derecho'
                    ))
                    ->add('cristal_oi', null, array(
                        'disabled' => $object->getId(),
                        'label' => 'Cristal Izquierdo'
                    ))
            )
            ->end()
            ->end();

        # Armadura y Accesorios
        $formMapper
            ->tab('Armadura y Accesorios', array('class' => 'col-md-5'))
            ->with('Armadura', ['class' => 'col-md-6'])
            ->add('armadura', null, [
                'disabled' => $object->getId(),
            ])
            ->end();

        # Accesorios
        $formMapper
            ->with('Accesorios', ['class' => 'col-md-6'])
            ->end()
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
}