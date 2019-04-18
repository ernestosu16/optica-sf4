<?php

namespace App\DataFixtures;

use App\Entity\SecurityGroup;
use App\Entity\SecurityUser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AppFixtures extends Fixture implements FixtureInterface, ContainerAwareInterface
{
    /** @var ContainerInterface */
    private $container;

    public function __construct()
    {
        $this->setContainer();
    }

    /**
     * Sets the container.
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $group_list = [
            'Administador' => ['ROLE_SUPER_ADMIN'],
            'Especialista de sistema' => [],
            'Dependiente de Almacén.' => [],
            'Dependiente del área de venta' => [],
            'Dependiente del área de entrega' => [],
            'Optometrista' => [],
        ];

        foreach ($group_list as $key => $group) {
            $groupAdmin = new SecurityGroup($key, $group);
            $manager->persist($groupAdmin);
        }

        $userAdmin = new SecurityUser();
        $userAdmin->setUsername('superadmin');
        $userAdmin->setEmail('superadmin@optica.cu');

        $userAdmin->setPassword($this->container
            ->get('security.password_encoder')
            ->encodePassword($userAdmin, 'superadmin'));
        $userAdmin->setRoles(['ROLE_SUPER_ADMIN']);
        $userAdmin->setEnabled(true);

        $manager->persist($userAdmin);
        $manager->flush();
    }
}
