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
     * @ORM\ManyToOne(targetEntity="App\Entity\AppReceta", inversedBy="receta_componente")
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
     * @ORM\ManyToOne(targetEntity="App\Entity\AppTinteCristal", inversedBy="receta_componentes")
     */
    protected $tinte_cristal;

    /**
     * @var string
     * @ORM\Column(type="float")
     */
    protected $eje;

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

    public function getTinteCristal(): ?AppTinteCristal
    {
        return $this->tinte_cristal;
    }

    public function setTinteCristal(?AppTinteCristal $tinte_cristal): self
    {
        $this->tinte_cristal = $tinte_cristal;

        return $this;
    }

}