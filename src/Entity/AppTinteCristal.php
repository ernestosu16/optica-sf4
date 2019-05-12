<?php
/**
 * Created by PhpStorm.
 * User: ernestosr
 * Date: 12/02/2019
 * Time: 09:59 PM
 */

namespace App\Entity;

use App\Entity\Nomenclador\NcColor;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=false)
 */
class AppTinteCristal extends _BaseEntity_
{
    /**
     * @var
     * @ORM\OneToOne(targetEntity="App\Entity\AppProducto", inversedBy="tinte_cristales", cascade={"persist","remove"})
     */
    protected $producto;

    /**
     * @var NcColor
     * @ORM\ManyToOne(targetEntity="App\Entity\Nomenclador\NcColor")
     */
    protected $color;

    public function __toString()
    {
        if ($producto = $this->getProducto()) {
            return (string)$producto->getCodigo() . ' - ' . $producto->getDescripcion() . ' ' . $this->color .
                ' - $' . number_format($producto->getPrecio(), 2);
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

    public function getColor(): ?NcColor
    {
        return $this->color;
    }

    public function setColor(?NcColor $color): self
    {
        $this->color = $color;

        return $this;
    }
}