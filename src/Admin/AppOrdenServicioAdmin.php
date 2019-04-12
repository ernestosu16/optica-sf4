<?php

namespace App\Admin;


use App\Entity\AppReceta;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\Form\Type\CollectionType;
use Sonata\Form\Type\DateTimePickerType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AppOrdenServicioAdmin extends _BaseAdmin_
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $object = $this->getSubject();

        $formMapper
            ->with('Datos de la Orden', array('class' => 'col-md-12'))
            ->add('paciente', $object->getId() ? null : ModelListType::class, array(
                'required' => true,
                'disabled' => $object->getId(),
            ))
            ->end()
            ->with('Datos de la Receta', array('class' => 'col-md-7'))
            ->add($formMapper->create('receta', FormType::class, array(
                'label' => 'Graduación',
                'by_reference' => true,
                'data_class' => AppReceta::class))
                ->add('numero')
                ->add('fecha_entrega', DateTimePickerType::class)
                ->add('add')
                ->add('eje_od', IntegerType::class, array(
                    'label' => 'Eje Derecho'
                ))
                ->add('cristal_od', null, array(
                    'label' => 'Cristal Derecho'
                ))
                ->add('eje_oi', IntegerType::class, array(
                    'label' => 'Eje Izquierdo'
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
}