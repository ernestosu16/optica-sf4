<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SolicitudTalladoRepository")
 */
class AppSolicitudTallado extends _BaseEntity_
{
    /**
     * @var string
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    protected $numero;

    /**
     * @var
     * @ORM\OneToOne(targetEntity="App\Entity\AppOrdenServicio", inversedBy="solicitud_tallado")
     */
    protected $orden_servicio;

    public function __construct()
    {
        $this->created_at = new \DateTime();
    }


    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(?string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getOrdenServicio(): ?AppOrdenServicio
    {
        return $this->orden_servicio;
    }

    public function setOrdenServicio(?AppOrdenServicio $orden_servicio): self
    {
        $this->orden_servicio = $orden_servicio;

        return $this;
    }
}