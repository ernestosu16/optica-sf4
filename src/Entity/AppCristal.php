<?php

namespace App\Entity;

use App\Entity\MovimientoAlmacen\Alamacen;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=false)
 */
class AppCristal extends _Entity_
{
    /**
     * @var
     * @ORM\OneToOne(targetEntity="App\Entity\AppProducto", inversedBy="cristales", cascade={"persist","remove"})
     */
    protected $producto;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $grosor;

    /**
     * @var float
     *
     * @ORM\Column(name="esfera", type="float")
     */
    private $esfera;

    /**
     * @var float
     *
     * @ORM\Column(name="cilindro", type="float")
     */
    private $cilindro;

    public function __toString()
    {
        if ($producto = $this->getProducto()) {
            return (string)$producto->getCodigo() . ' - ' . $producto->getDescripcion() .
                ' (' . ($this->esfera > 0 ? '+' : '') .
                $this->esfera . ',' . ($this->cilindro > 0 ? '+' : '') .
                $this->cilindro . ') - $' . number_format($producto->getPrecio(), 2);
        }

        return '';
    }

    public function getGrosor(): ?float
    {
        return $this->grosor;
    }

    public function setGrosor(float $grosor): self
    {
        $this->grosor = $grosor;

        return $this;
    }

    public function getEsfera(): ?float
    {
        return $this->esfera;
    }

    public function setEsfera(float $esfera): self
    {
        $this->esfera = $esfera;

        return $this;
    }

    public function getCilindro(): ?float
    {
        return $this->cilindro;
    }

    public function setCilindro(float $cilindro): self
    {
        $this->cilindro = $cilindro;

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

    /**
     * @return string
     */
    public function getPorUnidad()
    {
        /** @var Alamacen $almacen */
        $almacen = $this->getProducto()->getAlmacen()->first();
        $cantidad = ($almacen) ? $almacen->getCantidad() : 0;
        if ($producto = $this->getProducto()) {
            return (string)$producto->getCodigo() . ' - ' . $producto->getDescripcion() .
                ' (' . ($this->esfera > 0 ? '+' : '') .
                $this->esfera . ',' . ($this->cilindro > 0 ? '+' : '') .
                $this->cilindro . ') - $' . number_format(($producto->getPrecio() / 2), 3) .
                " ({$cantidad})";
        }

        return '';
    }
}