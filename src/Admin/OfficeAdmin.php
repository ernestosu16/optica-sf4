<?php

namespace App\Admin;

use App\Entity\SecurityOffice;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class OfficeAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        /** @var SecurityOffice $entity */
        $entity = $formMapper->getAdmin()->getSubject();

        $formMapper
            ->add('name', TextType::class, [
                'label' => 'office.name',
            ])
            ->add('description', TextType::class, [
                'label' => 'office.description',
                'required' => false,
            ]);
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name', null, ['label' => 'office.name'])
            ->addIdentifier('description', null, ['label' => 'office.description']);
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