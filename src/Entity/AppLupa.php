<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
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