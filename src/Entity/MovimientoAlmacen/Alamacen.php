<?php


namespace App\Entity\MovimientoAlmacen;

use App\Entity\AppProducto;
use App\Entity\SecurityOffice;
use App\Entity\_BaseEntity_;
use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AlamacenRepository")
 */
class Alamacen extends _BaseEntity_
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SecurityOffice")
     * @ORM\JoinColumn(name="office", referencedColumnName="id")
     */
    protected $office;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    protected $cantidad_existencia;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    protected $cantidad_pendiente;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    protected $cantidad_reservado;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="App\Entity\AppProducto", inversedBy="almacen")
     */
    protected $producto;

    public function __construct()
    {
        $this->created_at = new DateTime();
        $this->cantidad_reservado = 0;
        $this->cantidad_existencia = 0;
    }


    public function getCantidadExistencia(): ?int
    {
        return $this->cantidad_existencia;
    }

    public function setCantidadExistencia(int $cantidad_existencia): self
    {
        $this->cantidad_existencia = $cantidad_existencia;

        return $this;
    }

    public function getCantidadReservado(): ?int
    {
        return $this->cantidad_reservado;
    }

    public function setCantidadReservado(int $cantidad_reservado): self
    {
        $this->cantidad_reservado = $cantidad_reservado;

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

    public function getProducto(): ?AppProducto
    {
        return $this->producto;
    }

    public function setProducto(?AppProducto $producto): self
    {
        $this->producto = $producto;

        return $this;
    }

    public function getCantidadPendiente(): ?int
    {
        return $this->cantidad_pendiente;
    }

    public function setCantidadPendiente(int $cantidad_pendiente): self
    {
        $this->cantidad_pendiente = $cantidad_pendiente;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCantidad(): ?int
    {

        return (int)$this->cantidad_existencia - $this->cantidad_reservado;
    }

    /**
     * @return string
     */
    public function getArmadura(): string
    {
        $cantidad = $this->getCantidad();
        return (string)$this->getProducto()->getArmadura() . " ({$cantidad})";
    }

    /**
     * @return string
     */
    public function getAccesorio(): string
    {
        $cantidad = $this->getCantidad();
        return (string)$this->getProducto()->getAccesorio() . " ({$cantidad})";
    }


}