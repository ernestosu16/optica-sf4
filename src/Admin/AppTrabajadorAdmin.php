<?php
/**
 * Created by PhpStorm.
 * User: ernestosr
 * Date: 30/01/2019
 * Time: 05:16 PM
 */

namespace App\Admin;


use App\Entity\AppClasificador;
use App\Entity\SecurityOffice;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AppTrabajadorAdmin extends _BaseAdmin_
{
    protected $baseRoutePattern = 'apptrabajador';
    protected $baseRouteName = 'apptrabajador';

    protected function configureRoutes(RouteCollection $collection)
    {
        return $collection->clearExcept(array('list'));
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
//        $formMapper
//            ->with('General', ['class' => 'col-md-6'])
//            ->add('cargo', EntityType::class, [
//                'class' => AppClasificador::class,
//                'label' => 'app.cargo',
//                'placeholder' => '',
//            ])
//            ->add('oficina', EntityType::class, [
//                'class' => SecurityOffice::class,
//                'label' => 'app.oficina',
//                'placeholder' => '',
//            ])
//            ->end()
//            ->with('Trabajador', ['class' => 'col-md-6'])
//            ->add('ci', null, [
//                'label' => 'app.ci',
//                'attr' => ['title' => 'Carnet de identidad es incorrecto']
//            ])
//            ->add('nombreApellidos', TextType::class, [
//                'label' => 'app.nombre_apellidos',
//                'attr' => [
//                    'title' => 'El campo solo puedo contener letras',
//                    'pattern' => '^[a-zA-Z áéíóú]*$',
//                ]
//            ])
//            ->end();
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);
        $listMapper
            ->add('ci', TextType::class, [
                'label' => 'app.ci',
            ])
            ->addIdentifier('firstname', TextType::class, [
                'label' => 'app.nombre',
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Apellidos',
            ])
            ->add('office', TextType::class, [
                'label' => 'Oficina',
            ])
//            ->add('oficina', EntityType::class, [
//                'label' => 'app.oficina',
//            ])
//            ->add('cargo', EntityType::class, [
//                'label' => 'app.cargo',
//            ])
        ;
    }

}