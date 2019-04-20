<?php
/**
 * Created by PhpStorm.
 * User: ernestosr
 * Date: 22/01/2019
 * Time: 02:55 PM
 */

namespace App\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\UserBundle\Admin\Model\GroupAdmin as BaseGroupAdmin;
use Sonata\UserBundle\Form\Type\SecurityRolesType;

class GroupAdmin extends BaseGroupAdmin
{
    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->tab('Group')
            ->with('General', ['class' => 'col-md-6'])
            ->add('name', null, [
                'required' => true,
                'attr' => [
                    'title' => 'El campo solo puedo contener letras y máximo 50 caracteres',
                    'pattern' => '^[a-zA-Z áéíóú]{1,50}$',
                ]
            ])
            ->end()
            ->end()
            ->tab('Security')
            ->with('Roles', ['class' => 'col-md-12'])
            ->add('roles', SecurityRolesType::class, [
                'expanded' => true,
                'multiple' => true,
                'required' => false,
            ])
            ->end()
            ->end();
    }
}