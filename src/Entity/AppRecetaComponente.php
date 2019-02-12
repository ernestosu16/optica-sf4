<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class AppRecetaComponente extends _BaseEntity_
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppReceta")
     */
    protected $receta;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppArmadura")
     */
    protected $armadura;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppCristal")
     */
    protected $cristal;

    /**
     * @ORM\Column(type="integer")
     */
    protected $tinte_id;

    /**
     * @var string
     * @ORM\Column(type="float")
     */
    protected $eje;

    public function getTinteId(): ?int
    {
        return $this->tinte_id;
    }

    public function setTinteId(int $tinte_id): self
    {
        $this->tinte_id = $tinte_id;

        return $this;
    }

    public function getEje(): ?float
    {
        return $this->eje;
    }

    public function setEje(float $eje): self
    {
        $this->eje = $eje;

        return $this;
    }

    public function getReceta(): ?AppReceta
    {
        return $this->receta;
    }

    public function setReceta(?AppReceta $receta): self
    {
        $this->receta = $receta;

        return $this;
    }

    public function getArmadura(): ?AppArmadura
    {
        return $this->armadura;
    }

    public function setArmadura(?AppArmadura $armadura): self
    {
        $this->armadura = $armadura;

        return $this;
    }

    public function getCristal(): ?AppCristal
    {
        return $this->cristal;
    }

    public function setCristal(?AppCristal $cristal): self
    {
        $this->cristal = $cristal;

        return $this;
    }

}