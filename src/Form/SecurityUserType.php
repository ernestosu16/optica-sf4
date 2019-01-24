<?php

namespace App\Form;

use App\Entity\SecurityUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyPath;
use Symfony\Component\Routing\RouterInterface;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class SecurityUserType extends AbstractType
{
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $router = $this->router;

        $builder
            ->add('username')
            ->add('email')
            ->add('enabled')
            //->add('password')
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'download_label' => '...',
                'download_uri' => true,
                'image_uri' => true,
            ])
            //->add('lastLogin')
            //->add('confirmationToken')
            //->add('passwordRequestedAt')
            //->add('roles')
            //->add('createdAt')
            //->add('updatedAt')
            //->add('dateOfBirth')
            //->add('firstname')
            //->add('lastname')
            //->add('website')
            //->add('biography')
            //->add('gender')
            //->add('locale')
            //->add('timezone')
            //->add('phone')
            //->add('facebookUid')
            //->add('facebookName')
            //->add('facebookData')
            //->add('twitterUid')
            //->add('twitterName')
            //->add('twitterData')
            //->add('gplusUid')
            //->add('gplusName')
            //->add('gplusData')
            //->add('token')
            //->add('twoStepVerificationCode')
            //->add('groups')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SecurityUser::class,
        ]);
    }
}
