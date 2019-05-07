<?php


namespace App\Admin;

use App\Entity\MovimientoAlmacen\InformeRecepcionOptica;
use App\Entity\MovimientoAlmacen\InformeRecepcionOpticaArmadura;
use Doctrine\ORM\EntityManager;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\Form\Type\CollectionType;
use Sonata\Form\Type\DatePickerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class InformeRecepcionOptiaAdmin extends _BaseAdmin_
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $object = $this->getSubject();
        /* @var $object InformeRecepcionOptica */

        /** @var EntityManager $em */
        $em = $this->getConfigurationPool()->getContainer()->get('doctrine');

        $lastRow = $em->getRepository(InformeRecepcionOptica::class)->getLastRow();

        $formMapper
            ->with('Tipo de Factura', array('class' => 'col-md-2'))
            ->add('tipo_factura', ChoiceType::class, [
                'expanded' => true,
                'label' => false,
                'choices' => [
                    'Acccesorios' => 0,
                    'Armaduras' => 1,
                    'Cristales' => 2,
                ]
            ])
            ->end()
            ->with('Datos de la Recepcion', array('class' => 'col-md-4'))
            ->add('fecha', DatePickerType::class, array(
                'format' => 'dd/MM/yyyy',
                'required' => true,
                'disabled' => $object->getId(),
            ))
            ->add('id', null, array(
                'disabled' => true,
                'label' => 'Número de la factura',
                'data' => $lastRow->getId() + 1,
            ))
            ->add('office_destino', null, [
                'label' => 'Oficina destino',
            ])
            ->end()
            ->with('Accesorios Recibidos', array('class' => 'col-md-6'))
            ->add('accesorios', CollectionType::class, array(
                'label' => false,
                'disabled' => $object->getId(),
                "by_reference" => false,
                'btn_add' => $object->getId() ? false : 'link_add',
                'type_options' => array(
                    'delete' => !$object->getId(),
                )
            ), array(
                'edit' => 'inline',
                'inline' => 'table',
            ))
            ->end()
            ->with('Armaduras Recibidas', array('class' => 'col-md-6'))
            ->add('armaduras', CollectionType::class, array(
                'label' => false,
                'disabled' => $object->getId(),
                "by_reference" => false,
                'btn_add' => $object->getId() ? false : 'link_add',
                'type_options' => array(
                    'delete' => !$object->getId(),
                )
            ), array(
                'edit' => 'inline',
                'inline' => 'table',
            ))
            ->end()
            ->with('Cristales Recibidos', array('class' => 'col-md-6'))
            ->add('cristales', CollectionType::class, array(
                'label' => false,
                'disabled' => $object->getId(),
                "by_reference" => false,
                'btn_add' => $object->getId() ? false : 'link_add',
                'type_options' => array(
                    'delete' => !$object->getId(),
                )
            ), array(
                'edit' => 'inline',
                'inline' => 'table',
            ))
            ->end();
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);

        $listMapper
            ->remove('batch')
            ->add('id', null, array(
                'label' => 'No.'
            ))
            ->add('fecha', null, array(
                'format' => 'd/m/Y',
            ))
            ->add('numero_factura')
            ->add('accesorios')
            ->add('armaduras')
            ->add('cristales')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                ),
            ));
    }

    /**
     * @param $object InformeRecepcionOptica
     */
    public function prePersist($object)
    {
        /** @var InformeRecepcionOpticaArmadura[] $armadura */
        $armaduras = $this->getForm()->get('armaduras')->getData();

        /** @var InformeRecepcionOpticaArmadura $item */
        foreach ($armaduras as $item) {
            $item->setInformeRecepcion($this->getSubject());

        }
    }

    /**
     * @param $object InformeRecepcionOptica
     */
    public function Update($object)
    {
        /** @var InformeRecepcionOpticaArmadura[] $armadura */
        $armaduras = $this->getForm()->get('armaduras')->getData();

        /** @var InformeRecepcionOpticaArmadura $item */
        foreach ($armaduras as $item) {
            $item->setInformeRecepcion($this->getSubject());

        }
    }
}