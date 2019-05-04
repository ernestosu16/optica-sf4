<?php


namespace App\Admin;

use App\Entity\MovimientoAlmacen\InformeRecepcionOptica;
use App\Entity\MovimientoAlmacen\InformeRecepcionOpticaArmadura;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\Form\Type\CollectionType;
use Sonata\Form\Type\DatePickerType;

class InformeRecepcionOptiaAdmin extends _BaseAdmin_
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $object = $this->getSubject();
        /* @var $object InformeRecepcionOptica */


        $formMapper
            ->with('Datos de la Recepcion', array('class' => 'col-md-6'))
            ->add('fecha', DatePickerType::class, array(
                'format' => 'dd/MM/yyyy',
                'required' => true,
                'disabled' => $object->getId(),
            ))
            ->add('numero_factura', null, array(
                'disabled' => $object->getId(),
                'label' => 'Número de la factura',
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