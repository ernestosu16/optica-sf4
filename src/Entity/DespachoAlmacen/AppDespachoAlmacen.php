<?php


namespace App\Entity\DespachoAlmacen;


use App\Entity\SecurityOffice;
use App\Entity\SecurityUser;
use App\Entity\_BaseEntity_;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class AppDespachoAlmacen extends _BaseEntity_
{


    /**
     * @var DateTime("Y-m-d")
     * @ORM\Column(type="date", nullable=false)
     */
    protected $fecha;

    /**
     * @var string
     * @ORM\Column(type="string", length=15, nullable=false)
     */
    protected $numero;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SecurityUser")
     */
    protected $usuario_creador;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SecurityOffice")
     */
    protected $office;

    public function __construct()
    {
        $this->created_at = new DateTime();
    }

    public function __toString()
    {
        return (string)$this->numero;
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

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getUsuarioCreador(): ?SecurityUser
    {
        return $this->usuario_creador;
    }

    public function setUsuarioCreador(?SecurityUser $usuario_creador): self
    {
        $this->usuario_creador = $usuario_creador;

        return $this;
    }

    public function getOffice(): ?SecurityOffice
    {
        return $this->office;
    }

    public function setOffice(?SecurityOffice $office): self
    {
        $this->office = $office;

        return $this;
    }
}