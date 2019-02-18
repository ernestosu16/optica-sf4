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
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AppPacienteAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('ci')
            ->add('nombre')
            ->add('direccion')
            ->add('telefono_contacto')
            ->add('correo_contacto')
            ->add('historia_clinica')
            ->end();
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('ci', TextType::class, [
                'label' => 'app.ci',
            ])
            ->add('nombre', TextType::class, [
                'label' => 'app.nombre',
            ])
            ->add('telefono_contacto', TextType::class, [
                'label' => 'app.telefono_contacto',
            ])
            ->add('correo_contacto', EmailType::class, [
                'label' => 'app.correo_contacto',
            ])
            ->add('historia_clinica', TextType::class, [
                'label' => 'app.historia_clinica',
            ])
            ->add('_action', null, array(
                'label' => 'Acciones',
                'row_align' => 'right',
                'header_style' => 'width: 190px',
                'actions' => array(
                    'edit' => array(),
                    'delete' => array())));;
    }

}