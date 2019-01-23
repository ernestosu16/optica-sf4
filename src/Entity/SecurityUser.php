<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\UserBundle\Entity\BaseUser;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SecurityUserRepository")
 */
class SecurityUser extends BaseUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(name="id", type="guid")
     */
    protected $id;

    public function getId(): ?string
    {
        return $this->id;
    }
}
