<?php

namespace App\EventListener;


use Knp\Menu\ItemInterface;
use Sonata\AdminBundle\Event\ConfigureMenuEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MenuBuilderListener
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function addMenuItems(ConfigureMenuEvent $event)
    {
        $menu = $event->getMenu();

        $roles = array();
        if($listRoles = $this->container->get('security.token_storage')->getToken()){
            $roles = $listRoles->getRoles();
        }

        $listMenu = $menu->getChildren();

        $administrationMenu = $listMenu['sonata.admin.group.administration']->getChildren();

        $childChangePassword = $event->getFactory()->createItem('sonata.user.admin.password', [
            'label' => 'app.change_password',
            'route' => 'fos_user_change_password'])
            ->setExtras(['icon' => '<i class="fa fa-angle-double-right"></i>']);
        $administrationMenu = $this->insertValueAtPosition($administrationMenu, $childChangePassword, 1, "app.change_password");

        foreach ($roles as $role) {
            if($role->getRole() === 'ROLE_ESPECIALISTA_SISTEMA' || $role->getRole() === 'ROLE_SUPER_ADMIN'){
                $childBackups = $event->getFactory()->createItem('sonata.user.admin.backup', [
                    'label' => 'app.backup',
                    'route' => 'admin_backups'])
                    ->setExtras(['icon' => '<i class="fa fa-angle-double-right"></i>']);

                $administrationMenu = $this->insertValueAtPosition($administrationMenu, $childBackups, 10, "app.backups_database");
            }
        }


        $listMenu['sonata.admin.group.administration']
            ->setChildren($administrationMenu);

        $menu->setChildren($listMenu);

    }

    /**
     * @param array $arr
     * @param ItemInterface $insertedArray
     * @param int $position
     * @param string $name
     * @return array
     */
    function insertValueAtPosition(array $arr, ItemInterface $insertedArray, int $position, string $name)
    {
        return array_slice($arr, 0, $position, true) +
            array($name => $insertedArray) +
            array_slice($arr, $position, count($arr) - 1, true);
    }
}