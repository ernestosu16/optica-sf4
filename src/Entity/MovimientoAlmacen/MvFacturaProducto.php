<?php


namespace App\Entity\MovimientoAlmacen;


use App\Entity\AppProducto;
use App\Entity\_Entity_;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class MvFacturaProducto extends _Entity_
{
    /**
     * @ORM\ManyToOne(targetEntity="MvFactura", inversedBy="factura_producto", cascade={"persist"})
     */
    protected $factura;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppProducto")
     * @ORM\JoinColumn(name="producto_id", referencedColumnName="id", nullable=false)
     */
    protected $producto;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    protected $cantidad;

    public function __toString()
    {
        return (string)'[ ' . $this->producto . ' (' . $this->cantidad . ') ]';
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getFactura(): ?MvFactura
    {
        return $this->factura;
    }

    public function setFactura(?MvFactura $factura): self
    {
        $this->factura = $factura;

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


}