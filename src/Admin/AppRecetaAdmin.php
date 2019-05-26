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
            ->with('Datos receta', ['class' => 'col-md-12'])
            # Datos general de la receta
            ->add('numero', null, [
                'disabled' => $object->getId(),
                'required' => true,
            ])
            ->add('fecha_refraccion', DateTimePickerType::class, [
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
            # Ojo derecho
            ->with('Graduación del ojo derecho', ['class' => 'col-md-12'])
            ->add('cristal_od', null, array(
                'disabled' => $object->getId(),
                'label' => 'Cristal'
            ))
            ->add('eje_od', null, array(
                'disabled' => $object->getId(),
                'label' => 'Eje',
            ))
            ->add('a_visual_od', null, array(
                'disabled' => $object->getId(),
                'label' => 'Agudeza Visual'
            ))
            ->end()
            # Ojo izquierdo
            ->with('Graduación  del ojo izquierdo', ['class' => 'col-md-12'])
            ->add('cristal_oi', null, array(
                'disabled' => $object->getId(),
                'label' => 'Cristal'
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