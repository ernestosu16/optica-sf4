<?php


namespace App\Admin;


use App\Entity\AppReceta;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\QueryBuilder;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\CollectionType;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\Form\Type\DatePickerType;
use Sonata\Form\Type\DateTimePickerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AppRecetaAdmin extends _BaseAdmin_
{
    protected function configureRoutes(RouteCollection $collection)
    {
//        $collection->remove('create');
        $collection->remove('batch');
//        $collection->remove('edit');
        $collection->remove('delete');
        $collection->remove('show');
        $collection->remove('batch');
        $collection->remove('export');

        $collection->add('crear_receta_paciente', 'crear_receta/{id}');
        $collection->add('lista_receta_paciente', 'lista_receta/{id}');
        $collection->add('lista_receta', 'lista_receta');
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $object = $this->getSubject();

        $formMapper
            ->with('Datos receta', ['class' => 'col-md-5'])
//            ->add('paciente', ModelListType::class)
            # Datos general de la receta
            ->add('numero', null, [
                'disabled' => $object->getId(),
                'required' => true,
                'label' => 'Número',
            ])
            ->add('fecha_refraccion', DatePickerType::class, [
                'disabled' => $object->getId(),
                'required' => false,
                'format' => DateType::HTML5_FORMAT,
                'label' => 'Fecha de Refracción'
            ])
            ->add('dp', null, [
                'disabled' => $object->getId(),
                'label' => 'DP'
            ])
            ->add('add', null, [
                'disabled' => $object->getId(),
            ])
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
            ->end()
            # Ojo derecho
            ->with('Graduación del ojo derecho', ['class' => 'col-md-7'])
            ->add('cristal_od', null, array(
                'disabled' => $object->getId(),
                'label' => 'Cristal',
                'required' => true,
                'choice_label' => 'getPorUnidad',
            ))
            ->add('eje_od', null, array(
                'disabled' => $object->getId(),
                'label' => 'Eje',
            ))
            ->add('a_visual_od', null, array(
                'disabled' => $object->getId(),
                'label' => 'Agudeza Visual',
                'empty_data' => false,
            ))
            ->end()
            # Ojo izquierdo
            ->with('Graduación  del ojo izquierdo', ['class' => 'col-md-7'])
            ->add('cristal_oi', null, array(
                'disabled' => $object->getId(),
                'label' => 'Cristal',
                'required' => true,
                'choice_label' => 'getPorUnidad',
            ))
            ->add('eje_oi', null, array(
                'disabled' => $object->getId(),
                'label' => 'Eje'
            ))
            ->add('a_visual_oi', null, array(
                'disabled' => $object->getId(),
                'label' => 'Agudeza Visual',
            ))
            ->end();

    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('numero');
    }

    protected function configureListFields(ListMapper $list)
    {
        unset($this->listModes['mosaic']);
        $list
            ->add('fecha_refraccion', null, [
                'label' => 'Fecha Refracción',
                'format' => 'Y-m-d',
            ])
            ->add('numero', null, [
                'label' => 'Número',
            ])
            ->add('paciente', null, [
                'label' => 'Paciente',
                'editable' => false,
                'row_align' => 'center',
            ])
            ->add('add', null, ['label' => 'ADD'])
            ->add('dp', null, ['label' => 'DP'])
            ->add('espejuelo', null, [
                'template' => '::Admin\receta\field__espejuelo.html.twig',
                'label' => 'Espejuelo'
            ])
            ->add('espejuelo_tipo', null, [
                'template' => '::Admin\receta\field__espejuelo_tipo.html.twig',
                'label' => 'Tipo',
            ])
            ->add('_action', null, array(
                'label' => '',
                'row_align' => 'right',
                'header_style' => 'width: 70px',
                'actions' => array(
                    'others' => ['template' => '::Admin\receta\buttons__others.html.twig'],
                )
            ));
    }

}