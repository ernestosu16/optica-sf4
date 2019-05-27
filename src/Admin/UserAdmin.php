<?php
declare(strict_types=1);

namespace App\Admin;


use App\Entity\SecurityOffice;
use App\Entity\SecurityUser;
use Doctrine\ORM\EntityManager;
use Exception;
use FOS\UserBundle\Model\UserManagerInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Validator\ErrorElement;
use Sonata\MediaBundle\Form\Type\MediaType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormTypeInterface;


class UserAdmin extends AbstractAdmin
{
    /**
     * @var UserManagerInterface
     */
    protected $userManager;

    /**
     * {@inheritdoc}
     */
    public function getExportFields()
    {
        // avoid security field to be exported
        return array_filter(parent::getExportFields(), function ($v) {
            return !in_array($v, ['password', 'salt']);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($user): void
    {
        $this->getUserManager()->updateCanonicalFields($user);
        $this->getUserManager()->updatePassword($user);
    }

    /**
     * @param UserManagerInterface $userManager
     */
    public function setUserManager(UserManagerInterface $userManager): void
    {
        $this->userManager = $userManager;
    }

    /**
     * @return UserManagerInterface
     */
    public function getUserManager()
    {
        return $this->userManager;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->addIdentifier('username')
            ->add('firstname')
            ->add('lastname')
            ->add('groups')
            ->add('office')
            ->add('enabled', null, ['editable' => true])
            ->add('createdAt', null, [
                'format' => 'Y-m-d H:i:s',
            ])
            ->add('_action', null, array(
                'label' => 'Acciones',
                'row_align' => 'right',
                'header_style' => 'width: 190px',
                'actions' => array(
                    'edit' => array(),
                    'delete' => array())));;

//        if ($this->isGranted('ROLE_ALLOWED_TO_SWITCH')) {
//            $listMapper
//                ->add('impersonating', 'string', ['template' => '@SonataUser/Admin/Field/impersonating.html.twig']);
//        }
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper): void
    {
        $filterMapper
            ->add('username')
            ->add('groups');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->with('General')
            ->add('username')
            ->end()
            ->with('Groups')
            ->add('groups')
            ->end()
            ->with('Profile')
            ->add('firstname')
            ->add('lastname')
            ->add('gender')
            ->end();
    }

    /**
     * {@inheritdoc}
     * @throws Exception
     */
    protected function configureFormFields(FormMapper $formMapper): void
    {
        // define group zoning
        $formMapper
            ->tab('User')
            ->with('label.image', ['class' => 'col-md-4'])
            ->add('media', MediaType::class, array(
                'provider' => 'sonata.media.provider.image',
                'context' => 'users',
                'required' => false,
            ))
            ->end()
            ->with('Profile', ['class' => 'col-md-4'])->end()
            ->with('General', ['class' => 'col-md-4'])->end()
            ->end()
            ->tab('Security')
            ->with('Groups', ['class' => 'col-md-12'])->end()
            ->end();


        $genderOptions = [
            'choices' => call_user_func([$this->getUserManager()->getClass(), 'getGenderList']),
            'required' => true,
            'translation_domain' => $this->getTranslationDomain(),
        ];

        // NEXT_MAJOR: Remove this when dropping support for SF 2.8
        if (method_exists(FormTypeInterface::class, 'setDefaultOptions')) {
            $genderOptions['choices_as_values'] = true;
        }

        $formMapper
            ->tab('User')
            ->with('General')
            ->add('username')
            ->add('plainPassword', RepeatedType::class, array(
                    'type' => PasswordType::class,
                    'options' => array(
                        'translation_domain' => 'FOSUserBundle',
                        'attr' => [
                            'title' => 'Mayúscula, minúscula, numero y 8 o más caracteres',
                            'pattern' => '^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$',
                        ]
                    ),
                    'first_options' => array('label' => 'form.password'),
                    'second_options' => array('label' => 'form.password_confirmation'),
                    'invalid_message' => 'fos_user.password.mismatch',
                    'required' => false,
                    'attr' => ['title' => "Please enter at least 5 characters"],
                )
            )
            ->add('enabled', null, ['required' => false])
            ->end()
            ->with('Profile')
            ->add('ci', null, [
                'required' => true,
                'attr' => ['title' => 'Carnet de identidad es incorrecto']
            ])
            ->add('firstname', null, [
                'required' => true,
                'attr' => [
                    'title' => 'El campo solo puedo contener letras',
                    'pattern' => '^[a-zA-Z áéíóú]*$',
                ]
            ])
            ->add('lastname', null, [
                'required' => true,
                'attr' => [
                    'title' => 'El campo solo puedo contener letras',
                    'pattern' => '^[a-zA-Z áéíóú]*$',
                ]])
            ->add('office', ModelType::class, [
                'class' => SecurityOffice::class,
                'placeholder' => '',
                'label' => 'office',
                'required' => true
            ])
            ->end()
            ->end()
            ->tab('Security')
            ->with('Groups')
            ->add('groups', ModelType::class, [
                'required' => false,
                'expanded' => true,
                'multiple' => true,
            ])
            ->end()
            ->end();
    }

    /**
     * @param SecurityUser $object
     */
    public function preValidate($object)
    {
        $object->setEmail($object->getUsername() . '@local.local');
    }

    /**
     * @param ErrorElement $errorElement
     * @param $object SecurityUser
     */
    public function validate(ErrorElement $errorElement, $object)
    {
        if ($object->getId() === null) {
//            $errorElement->with('password')
//                ->addViolation('Debe introducir una "Contraseña" por primera vez')
//                ->end();

            /** @var EntityManager $em */
            $em = $this->getConfigurationPool()->getContainer()->get('doctrine');

            $ci = $em->getRepository(SecurityUser::class)->findOneBy(
                ['ci' => $object->getCi()]
            );

            if ($ci) {
                $errorElement
                    ->with('ci')
                    ->addViolation('Ya existe el CI de este usuario')
                    ->end();
            }

            $username = $em->getRepository(SecurityUser::class)->findOneBy(
                ['username' => $object->getUsername()]
            );

            if ($username) {
                $errorElement
                    ->with('username')
                    ->addViolation('Ya existe este usuario')
                    ->end();
            }
        }


    }
}