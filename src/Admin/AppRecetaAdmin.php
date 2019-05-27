<?php


namespace App\Admin;


use App\Entity\AppReceta;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\Form\Type\DateTimePickerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class AppRecetaAdmin extends _BaseAdmin_
{
    protected function configureRoutes(RouteCollection $collection)
    {
//        $collection->remove('create');
        $collection->remove('batch');
        $collection->remove('edit');
        $collection->remove('delete');
        $collection->remove('show');
        $collection->remove('batch');
        $collection->remove('export');

        $collection->add('crear_receta_paciente', 'crear_receta/{id}');
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $object = $this->getSubject();

        $formMapper
            ->with('Receta', ['class' => 'col-md-12'])
            # Datos general de la receta
            ->add('numero', null, [
                'disabled' => $object->getId(),
                'label' => 'Número'
            ])
            ->add('fecha', DateTimePickerType::class, [
                'disabled' => $object->getId(),
                'required' => false,
                'label' => 'Fecha de Refracción'
            ])
            ->add('dp', null, [
                'disabled' => $object->getId(),
                'label' => 'DP'
            ])
            ->add('add', null, [
                'disabled' => $object->getId(),
            ])
            ->end()
            ->with('Graduación', ['class' => 'col-md-12'])
            # Ojo derecho
            ->add('cristal_od', null, array(
                'disabled' => $object->getId(),
                'label' => 'OD Cristal'
            ))
            ->add('eje_od', null, array(
                'disabled' => $object->getId(),
                'label' => 'Eje'
            ))
            ->add('a_visual_od', null, array(
                'disabled' => $object->getId(),
                'label' => 'Agudeza Visual'
            ))

//            ->end()
//            ->with('Ojo Izquierdo', ['class' => 'col-md-12'])
            # Ojo izquierdo
            ->add('cristal_oi', null, array(
                'disabled' => $object->getId(),
                'label' => 'OI Cristal'
            ))
            ->add('eje_oi', null, array(
                'disabled' => $object->getId(),
                'label' => 'Eje'
            ))
            ->add('a_visual_oi', null, array(
                'disabled' => $object->getId(),
                'label' => 'Agudeza Visual'
            ))

            ->end();

    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->add('numero')
            ->add('fecha');
    }

}