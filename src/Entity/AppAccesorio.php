<?php
/**
 * Created by PhpStorm.
 * User: ernestosr
 * Date: 12/02/2019
 * Time: 09:59 PM
 */

namespace App\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=false)
 */
class AppAccesorio extends _Entity_
{
    /**
     * @var
     * @ORM\OneToOne(targetEntity="App\Entity\AppProducto", inversedBy="accesorios", cascade={"persist","remove"})
     */
    protected $producto;

    public function __toString()
    {
        $producto = $this->getProducto();
        if ($producto) {
            return (string)$producto->getCodigo() . ' - ' . $producto->getDescripcion() .
                ' - $' . number_format($this->getProducto()->getPrecio(), 2);
        } else {
            return '';
        }
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