<?php

namespace App\Admin;

use App\Entity\SecurityOffice;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\MediaBundle\Form\Type\MediaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class OfficeAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        /** @var SecurityOffice $entity */
        $entity = $formMapper->getAdmin()->getSubject();

        $formMapper
            ->with('label.image',['class' => 'col-md-4'])
            ->add('media', MediaType::class, array(
                'provider' => 'sonata.media.provider.image',
                'context' => 'office'
            ))
            ->end()
            ->with('General',['class' => 'col-md-8'])
            ->add('number', TextType::class, [
                'label' => 'office.number',
            ])
            ->add('name', TextType::class, [
                'label' => 'office.name',
            ])
            ->add('description', TextType::class, [
                'label' => 'office.description',
                'required' => false,
            ])
            ->end();
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name', null, ['label' => 'office.name'])
            ->add('number', null, ['label' => 'office.number'])
            ->add('description', null, ['label' => 'office.description'])
            ->add('_action', null, array(
                'label' => 'Acciones',
                'row_align' => 'right',
                'header_style' => 'width: 190px',
                'actions' => array(
                    'edit' => array(),
                    'delete' => array())));;
    }

    /**
     * @param string $context
     * @return \Doctrine\ORM\QueryBuilder
     */

    public function createQuery($context = 'list')
    {
        /** @var \Doctrine\ORM\QueryBuilder $query */
        $query = parent::createQuery($context);

        $query->addOrderBy($query->getRootAliases()[0] . '.name');

        return $query;
    }

}