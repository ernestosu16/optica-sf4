<?php

namespace App\Admin;


use App\Entity\AppOrdenServicio;
use App\Entity\AppReceta;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\Form\Type\DateTimePickerType;
use Symfony\Component\Form\Extension\Core\Type\FormType;

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
        $object = $this->getSubject();

        $formMapper
            ->with('Datos de la Orden', array('class' => 'col-md-12'))
            ->add('numero')
            ->add('precio')
            ->add('paciente', $object->getId() ? null : ModelListType::class, array(
                'required' => true,
                'disabled' => $object->getId(),
            ))
            ->end()
            ->with('Datos de la Receta', array('class' => 'col-md-7'))
            ->add($formMapper->create('receta', FormType::class, array(
                'label' => 'Graduación', 'by_reference' => true, 'data_class' => AppReceta::class))
                # Datos general de la receta
                ->add('numero')
                ->add('fecha_entrega', DateTimePickerType::class)
                ->add('dp')
                ->add('add')
                # Ojo derecho
                ->add('eje_od', null, array(
                    'label' => 'Eje Derecho'
                ))
                ->add('a_visual_od', null, array(
                    'label' => 'Eje Derecho'
                ))
                ->add('cristal_od', null, array(
                    'label' => 'Cristal Derecho'
                ))
                # Ojo izquierdo
                ->add('eje_oi', null, array(
                    'label' => 'Eje Izquierdo'
                ))
                ->add('a_visual_oi', null, array(
                    'label' => 'Eje Derecho'
                ))
                ->add('cristal_oi', null, array(
                    'label' => 'Cristal Izquierdo'
                ))
            )
            ->end()
            ->with('Armadura', array('class' => 'col-md-5'))
            ->add('armadura')
            ->end()
            ->with('Accesorios Extras', array('class' => 'col-md-5'))
//            ->add('sub_mayor', CollectionType::class, array(
//                'label' => false,
//                'disabled' => $object->getId(),
//                'by_reference' => false,
//                'btn_add' => $object->getId() ? false : 'link_add',
//                'type_options' => array(
//                    'delete' => !$object->getId(),
//                )
//            ), array(
//                'edit' => 'inline',
//                'sortable' => 'pos',
//                'inline' => 'table',
//            ))
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
            ->add('create_at')
            ->add('paciente')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                ),
            ));
    }
}