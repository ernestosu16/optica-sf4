<?php

namespace App\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=false)
 */
class AppArmadura extends _Entity_
{
    /**
     * @var
     * @ORM\OneToOne(targetEntity="App\Entity\AppProducto", inversedBy="armaduras", cascade={"persist","remove"})
     */
    protected $producto;

    /**
     * @var int
     *
     * @ORM\Column(name="aro", type="integer")
     */
    private $aro;

    /**
     * @var int
     *
     * @ORM\Column(name="puente", type="integer")
     */
    private $puente;

    public function __toString()
    {
        $producto = $this->getProducto();
        if ($producto) {
            return (string)$producto->getCodigo() .
                ' - ' . $producto->getDescripcion() .
                " [{$this->aro}, {$this->puente}, {$this->altura}]" .
                ' - $' . number_format($this->getProducto()->getPrecio(), 2);
        } else {
            return '';
        }
    }


    /**
     * @var int
     *
     * @ORM\Column(name="altura", type="integer")
     */
    private $altura;

    public function getAro(): ?int
    {
        return $this->aro;
    }

    public function setAro(int $aro): self
    {
        $this->aro = $aro;

        return $this;
    }

    public function getPuente(): ?int
    {
        return $this->puente;
    }

    public function setPuente(int $puente): self
    {
        $this->puente = $puente;

        return $this;
    }

    public function getAltura(): ?int
    {
        return $this->altura;
    }

    public function setAltura(int $altura): self
    {
        $this->altura = $altura;

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

    public function getArmadura()
    {
        $cantidad = $this->getProducto()->getAlmacen()->first()->getCantidad();
        return (string)$this->__toString() . " ({$cantidad})";
    }
}