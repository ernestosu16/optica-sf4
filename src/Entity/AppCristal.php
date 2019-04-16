<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
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
        return (string)'(' . ($this->esfera > 0 ? '+' : '') .
            $this->esfera . ',' . ($this->cilindro > 0 ? '+' : '') .
            $this->cilindro . ') - $' . number_format($this->getProducto()->getPrecio(), 2);
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
}