<?php

namespace App\Entity\Nomenclador;

use App\Entity\_BaseEntity_;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=false)
 */
class NcDp extends _BaseEntity_
{
    public function __toString()
    {
        return (string)$this->cerca . '/' . $this->lejos;
    }

    /**
     * @var string
     * @ORM\Column(type="string", length=15)
     */
    protected $cerca;

    /**
     * @var string
     * @ORM\Column(type="string", length=15)
     */
    protected $lejos;

    public function getCerca(): ?string
    {
        return $this->cerca;
    }

    public function setCerca(string $cerca): self
    {
        $this->cerca = $cerca;

        return $this;
    }

    public function getLejos(): ?string
    {
        return $this->lejos;
    }

    public function setLejos(string $lejos): self
    {
        $this->lejos = $lejos;

        return $this;
    }

}