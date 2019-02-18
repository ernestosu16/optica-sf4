<?php
/**
 * Created by PhpStorm.
 * User: ernestosr
 * Date: 11/02/2019
 * Time: 01:01 AM
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class AppReceta
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class AppReceta extends _BaseEntity_
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppPaciente")
     */
    protected $paciente;

    /**
     * @var string
     * @ORM\Column(type="string", length=15)
     */
    protected $numero;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $fecha_recepcion;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $fecha_entrega;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $fecha_recogida;

    /**
     * @var string
     * @ORM\Column(type="string", length=30)
     */
    protected $estado;

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getFechaRecepcion(): ?\DateTimeInterface
    {
        return $this->fecha_recepcion;
    }

    public function setFechaRecepcion(\DateTimeInterface $fecha_recepcion): self
    {
        $this->fecha_recepcion = $fecha_recepcion;

        return $this;
    }

    public function getFechaEntrega(): ?\DateTimeInterface
    {
        return $this->fecha_entrega;
    }

    public function setFechaEntrega(\DateTimeInterface $fecha_entrega): self
    {
        $this->fecha_entrega = $fecha_entrega;

        return $this;
    }

    public function getFechaRecogida(): ?\DateTimeInterface
    {
        return $this->fecha_recogida;
    }

    public function setFechaRecogida(\DateTimeInterface $fecha_recogida): self
    {
        $this->fecha_recogida = $fecha_recogida;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

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
}