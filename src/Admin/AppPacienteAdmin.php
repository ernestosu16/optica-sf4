<?php
/**
 * Created by PhpStorm.
 * User: ernestosr
 * Date: 30/01/2019
 * Time: 05:16 PM
 */

namespace App\Admin;


use App\Entity\AppClasificador;
use App\Entity\AppPaciente;
use App\Entity\SecurityOffice;
use Doctrine\ORM\EntityManager;
use Sonata\Form\Validator\ErrorElement;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AppPacienteAdmin extends _BaseAdmin_
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Datos Personales', array('class' => 'col-md-6'))
            ->add('ci')
            ->add('nombre')
            ->add('historia_clinica')
            ->end()
            ->with('Datos de Contacto', array('class' => 'col-md-6'))
            ->add('direccion')
            ->add('telefono_contacto')
            ->add('correo_contacto', EmailType::class, array(
                'required' => false
            ))
            ->end()
            ->end();
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('created_at', null, [
                'label' => 'Creado',
            ])
            ->addIdentifier('ci', TextType::class, [
                'label' => 'app.ci',
            ])
            ->add('nombre', TextType::class, [
                'label' => 'Nombre y Apellidos',
            ])
            ->add('sexo', 'string', [
                'label' => 'Sexo',
                'template' => '::Admin/producto/list/sexo.html.twig',
            ])
            ->add('edad', 'string', [
                'label' => 'Edad',
                'template' => '::Admin/paciente/field__edad.html.twig',
            ])
            ->add('direccion', TextType::class, [
                'label' => 'Dirección',
                'header_style' => 'width: 290px',
            ])
            ->add('update_at', null, [
                'label' => 'Actualizado',
            ])
            ->add('_action', null, array(
                'label' => '',
                'row_align' => 'right',
                'header_style' => 'width: 90px',
                'actions' => array(
                    'edit' => array(),
                    'delete' => array())));;
    }

    /**
     * @param ErrorElement $errorElement
     * @param $object AppPaciente
     */
    public function validate(ErrorElement $errorElement, $object)
    {
//        dump($object);exit;
        /** @var EntityManager $em */
        $em = $this->getConfigurationPool()
            ->getContainer()
            ->get('doctrine.orm.entity_manager');

//        $filters = $em->getFilters();
//        $filters->disable('softdeleteable');

        $paciente = $em->getRepository(AppPaciente::class)->findOneBy(['ci' => $object->getCi()]);

        if ($paciente) {
            $errorElement
                ->with('ci')
                ->addViolation('Ya existe el CI de este paciente')
                ->end();
        }

        if ($object->getHistoriaClinica()) {
            $paciente = $em->getRepository(AppPaciente::class)->findOneBy(
                ['historia_clinica' => $object->getHistoriaClinica()]);

            if ($paciente) {
                $errorElement
                    ->with('historia_clinica')
                    ->addViolation('Ya existe este número de historia clínica')
                    ->end();
            }
        }
        $errorElement
            ->with('ci')
            ->assertLength(['min' => 11, 'max' => 11])
            ->end()
            ->with('nombre')
            ->assertLength(['min' => 11])
            ->end()
            ->with('direccion')
            ->assertLength(['min' => 10])
            ->end()
            ->with('telefono_contacto')
            ->assertLength(['min' => 8, 'max' => 8])
            ->end();

    }

}