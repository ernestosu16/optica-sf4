<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class AppSubmayorProducto extends _BaseEntity_
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppProducto")
     */
    protected $producto;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppMovimientoAlmacen", inversedBy="sub_mayor")
     * @ORM\JoinColumn(name="movimiento_id", referencedColumnName="id")
     */
    protected $movimiento;

    /**
     * @var string
     * @ORM\Column(type="float")
     */
    protected $cantidad;

    /**
     * @var string
     * @ORM\Column(type="float", nullable=true)
     */
    protected $saldo_existente;

    /**
     * @var string
     * @ORM\Column(type="float", nullable=true)
     */
    protected $saldo_disponible;

    public function __toString()
    {
        return (string) "{$this->getProducto()->getCodigo()} - {$this->getProducto()->getDescripcion()}  ({$this->getCantidad()})";
    }

    public function getCantidad(): ?float
    {
        return $this->cantidad;
    }

    public function setCantidad(float $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getSaldoExistente(): ?float
    {
        return $this->saldo_existente;
    }

    public function setSaldoExistente(float $saldo_existente): self
    {
        $this->saldo_existente = $saldo_existente;

        return $this;
    }

    public function getSaldoDisponible(): ?float
    {
        return $this->saldo_disponible;
    }

    public function setSaldoDisponible(float $saldo_disponible): self
    {
        $this->saldo_disponible = $saldo_disponible;

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

    public function getMovimiento(): ?AppMovimientoAlmacen
    {
        return $this->movimiento;
    }

    public function setMovimiento(?AppMovimientoAlmacen $movimiento): self
    {
        $this->movimiento = $movimiento;

        return $this;
    }
}