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
use App\Entity\SecurityUser;
use Doctrine\ORM\EntityManager;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\Form\Validator\ErrorElement;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AppPacienteAdmin extends _BaseAdmin_
{
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('export');
        $collection->remove('delete');
//        $collection->remove('create');
//        $collection->remove('edit');
        $collection->remove('show');

        $collection->add('crear_receta', $this->getRouterIdParameter() . '/receta');
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Datos Personales', array('class' => 'col-md-6'))
            ->add('ci')
            ->add('nombre')
            ->add('historia_clinica')
            ->end()
            ->with('Datos del Contacto', array('class' => 'col-md-6'))
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
        unset($this->listModes['mosaic']);
        $listMapper
            ->addIdentifier('ci', TextType::class, [
                'label' => 'app.ci',
            ])
            ->add('nombre', TextType::class, [
                'label' => 'Nombre y Apellidos',
            ])
          /**  ->add('sexo', 'string', [
                'label' => 'Sexo',
                'template' => '::Admin/producto/list/sexo.html.twig',
            ])
            ->add('edad', 'string', [
                'label' => 'Edad',
                'template' => '::Admin/paciente/field__edad.html.twig',
            ])*/
            ->add('direccion', TextType::class, [
                'label' => 'Dirección',
                'header_style' => 'width: 290px',
            ])
            ->add('telefono_contacto', 'string', [
                'label' => 'Contacto',
            ])
            ->add('created_at', null, [
                'label' => 'Creado',
            ])
            ->add('update_at', null, [
                'label' => 'Actualizado',
            ])
            ->add('_action', null, array(
                'label' => '',
                'actions' => array(
                    'edit' => ['label' => ''],
                    'others' => ['template' => '::Admin\paciente\buttons__others.html.twig'],
                )
            ));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('ci')
            ->add('nombre')
            ->add('telefono_contacto');
    }

    /**
     * @param ErrorElement $errorElement
     * @param $object AppPaciente
     */
    public function validate(ErrorElement $errorElement, $object)
    {
//        dump($object);exit;
        /** @var SecurityUser $user */
        $user = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();
        /** @var EntityManager $em */
        $em = $this->getConfigurationPool()
            ->getContainer()
            ->get('doctrine');

//        $filters = $em->getFilters();
//        $filters->disable('softdeleteable');

        $paciente = $em->getRepository(AppPaciente::class)->findOneBy(
            ['ci' => $object->getCi(), 'office' => $user->getOffice()]
        );

        if ($paciente && $paciente->getCi() === $object->getCi() && $paciente != $object) {
            $errorElement
                ->with('ci')
                ->addViolation('Ya existe el CI de este paciente')
                ->end();
        }

        $paciente = $em->getRepository(AppPaciente::class)->findOneBy(
            ['historia_clinica' => $object->getHistoriaClinica(), 'office' => $user->getOffice()]
        );
        if ($paciente && $paciente->getHistoriaClinica() === $object->getHistoriaClinica() && $paciente != $object) {
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
            ->assertLength(['min' => 5])
            ->end()
            ->with('telefono_contacto')
            ->assertLength(['min' => 8, 'max' => 8])
            ->end();

    }

    /**
     * @param $object AppPaciente
     */
    public function prePersist($object)
    {
        /** @var SecurityUser $user */
        $user = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();

        $object->setUsuarioCreador($user);
        $object->setOffice($user->getOffice());
    }

//    /**
//     * @param $object AppPaciente
//     */
//    public function Update($object)
//    {
//        $object->setOffice(false);
//
//        parent::Update($object);
//    }

}