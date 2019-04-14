<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Auditoria\Annotation as Auditar;
use Sonata\UserBundle\Entity\BaseGroup;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SecurityGroupRepository")
 * @Auditar\Auditar()
 */
class SecurityGroup extends BaseGroup
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
