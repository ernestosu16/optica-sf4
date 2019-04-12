<?php

namespace App\Admin;


use App\Entity\AppReceta;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\Form\Type\DateTimePickerType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

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
            ->with('Datos de la Receta', array('class' => 'col-md-8'))
            ->add($formMapper->create('receta', FormType::class, array(
                'label' => 'Graduación',
                'by_reference' => true,
                'data_class' => AppReceta::class))
                ->add('numero')
                ->add('fecha_entrega', DateTimePickerType::class)
                ->add('cristal_od', null, array(
                    'label' => 'Cristal Ojo Derecho'
                ))
                ->add('eje_od', IntegerType::class, array(
                    'label' => 'Eje Ojo Derecho'
                ))
                ->add('cristal_oi', null, array(
                    'label' => 'Cristal Ojo Izquierdo'
                ))
                ->add('eje_oi', IntegerType::class, array(
                    'label' => 'Eje Ojo Izquierdo'
                ))
            )
            ->end();
    }
}