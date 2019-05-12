<?php


namespace App\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=false)
 */
class AppLupa extends _Entity_
{

    /**
     * @var
     * @ORM\OneToOne(targetEntity="App\Entity\AppProducto", inversedBy="armaduras", cascade={"persist","remove"})
     */
    protected $producto;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=20)
     */
    protected $dioptrias;

    public function __toString()
    {
        if ($producto = $this->getProducto()) {
            return (string)$producto->getCodigo() . ' - ' . $producto->getDescripcion() .
                ' - $' . number_format($producto->getPrecio(), 2);
        } else {
            return '';
        }
    }

    public function getDioptrias(): ?string
    {
        return $this->dioptrias;
    }

    public function setDioptrias(string $dioptrias): self
    {
        $this->dioptrias = $dioptrias;

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