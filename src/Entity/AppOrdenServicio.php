<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class AppOrdenServicio extends _BaseEntity_
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppReceta", cascade={"persist"})
     */
    protected $receta;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppPaciente")
     */
    protected $paciente;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppTrabajador")
     */
    protected $trabajador;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppArmadura")
     */
    protected $armadura;

    /**
     * @var string
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    protected $numero;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $observaciones;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $fecha_asignacion;

    /**
     * @return AppReceta|null
     */
    public function getReceta(): ?AppReceta
    {
        return $this->receta;
    }

    /**
     * @param AppReceta|null $receta
     * @return AppOrdenServicio
     */
    public function setReceta(?AppReceta $receta): self
    {
        $this->receta = $receta;

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

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(string $observaciones): self
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    public function getFechaAsignacion(): ?DateTimeInterface
    {
        return $this->fecha_asignacion;
    }

    public function setFechaAsignacion(DateTimeInterface $fecha_asignacion): self
    {
        $this->fecha_asignacion = $fecha_asignacion;

        return $this;
    }

    public function getPaciente(): ?AppPaciente
    {
        return $this->paciente;
    }

    public function setPaciente(?AppPaciente $paciente): self
    {
        $this->paciente = $paciente;

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

    public function getArmadura(): ?AppArmadura
    {
        return $this->armadura;
    }

    public function setArmadura(?AppArmadura $armadura): self
    {
        $this->armadura = $armadura;

        return $this;
    }

}