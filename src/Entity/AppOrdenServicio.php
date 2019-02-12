<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class AppOrdenServicio extends _BaseEntity_
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
     * @ORM\ManyToOne(targetEntity="App\Entity\AppTrabajador")
     */
    protected $trabajador;

    /**
     * @var string
     * @ORM\Column(type="string", length=15)
     */
    protected $numero;

    /**
     * @var string
     * @ORM\Column(type="float")
     */
    protected $esfera_od;

    /**
     * @var string
     * @ORM\Column(type="float")
     */
    protected $esfera_oi;

    /**
     * @var string
     * @ORM\Column(type="float")
     */
    protected $cilindro_od;

    /**
     * @var string
     * @ORM\Column(type="float")
     */
    protected $cilindro_oi;

    /**
     * @var string
     * @ORM\Column(type="float")
     */
    protected $eje_od;

    /**
     * @var string
     * @ORM\Column(type="float")
     */
    protected $eje_oi;

    /**
     * @var string
     * @ORM\Column(type="float")
     */
    protected $prima_od;

    /**
     * @var string
     * @ORM\Column(type="float")
     */
    protected $prima_oi;

    /**
     * @var string
     * @ORM\Column(type="float")
     */
    protected $base_od;

    /**
     * @var string
     * @ORM\Column(type="float")
     */
    protected $base_oi;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected $observaciones;

    /**
     * @var string
     * @ORM\Column(type="string", length=20)
     */
    protected $stage;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $fecha_asignacion;

    public function getTinteId(): ?int
    {
        return $this->tinte_id;
    }

    public function setTinteId(int $tinte_id): self
    {
        $this->tinte_id = $tinte_id;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getEsferaOd(): ?float
    {
        return $this->esfera_od;
    }

    public function setEsferaOd(float $esfera_od): self
    {
        $this->esfera_od = $esfera_od;

        return $this;
    }

    public function getEsferaOi(): ?float
    {
        return $this->esfera_oi;
    }

    public function setEsferaOi(float $esfera_oi): self
    {
        $this->esfera_oi = $esfera_oi;

        return $this;
    }

    public function getCilindroOd(): ?float
    {
        return $this->cilindro_od;
    }

    public function setCilindroOd(float $cilindro_od): self
    {
        $this->cilindro_od = $cilindro_od;

        return $this;
    }

    public function getCilindroOi(): ?float
    {
        return $this->cilindro_oi;
    }

    public function setCilindroOi(float $cilindro_oi): self
    {
        $this->cilindro_oi = $cilindro_oi;

        return $this;
    }

    public function getEjeOd(): ?float
    {
        return $this->eje_od;
    }

    public function setEjeOd(float $eje_od): self
    {
        $this->eje_od = $eje_od;

        return $this;
    }

    public function getEjeOi(): ?float
    {
        return $this->eje_oi;
    }

    public function setEjeOi(float $eje_oi): self
    {
        $this->eje_oi = $eje_oi;

        return $this;
    }

    public function getPrimaOd(): ?float
    {
        return $this->prima_od;
    }

    public function setPrimaOd(float $prima_od): self
    {
        $this->prima_od = $prima_od;

        return $this;
    }

    public function getPrimaOi(): ?float
    {
        return $this->prima_oi;
    }

    public function setPrimaOi(float $prima_oi): self
    {
        $this->prima_oi = $prima_oi;

        return $this;
    }

    public function getBaseOd(): ?float
    {
        return $this->base_od;
    }

    public function setBaseOd(float $base_od): self
    {
        $this->base_od = $base_od;

        return $this;
    }

    public function getBaseOi(): ?float
    {
        return $this->base_oi;
    }

    public function setBaseOi(float $base_oi): self
    {
        $this->base_oi = $base_oi;

        return $this;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(string $observaciones): self
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    public function getStage(): ?string
    {
        return $this->stage;
    }

    public function setStage(string $stage): self
    {
        $this->stage = $stage;

        return $this;
    }

    public function getFechaAsignacion(): ?\DateTimeInterface
    {
        return $this->fecha_asignacion;
    }

    public function setFechaAsignacion(\DateTimeInterface $fecha_asignacion): self
    {
        $this->fecha_asignacion = $fecha_asignacion;

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

    public function getTrabajador(): ?AppTrabajador
    {
        return $this->trabajador;
    }

    public function setTrabajador(?AppTrabajador $trabajador): self
    {
        $this->trabajador = $trabajador;

        return $this;
    }

}