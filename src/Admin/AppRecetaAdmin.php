<?php


namespace App\Admin;


use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\Form\Type\DateTimePickerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class AppRecetaAdmin extends _BaseAdmin_
{
    protected function configureFormFields(FormMapper $formMapper)
    {
//        $object = $this->getSubject();
        $formMapper
            ->with('Receta', array('class' => 'col-md-12'))
            ->add('numero')
            ->add('fecha_entrega', DateTimePickerType::class)
//            ->add('paciente', $object->getId() ? null : ModelListType::class, array(
//                'required' => true,
//                'disabled' => $object->getId(),
//            ))
            ->end()
            ;

    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->add('numero')
            ->add('fecha_recepcion')
            ->add('fecha_entrega')
            ->add('fecha_recogida')
        ;
    }

}