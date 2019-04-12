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
     * @ORM\Column(nullable=true)
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
     * @var string
     * @ORM\Column(type="string", length=15)
     */
    protected $numero;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected $observaciones;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $fecha_asignacion;

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getReceta(): ?string
    {
        return $this->receta;
    }

    public function setReceta(?string $receta): self
    {
        $this->receta = $receta;

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

    public function getFechaAsignacion(): ?\DateTimeInterface
    {
        return $this->fecha_asignacion;
    }

    public function setFechaAsignacion(\DateTimeInterface $fecha_asignacion): self
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
}