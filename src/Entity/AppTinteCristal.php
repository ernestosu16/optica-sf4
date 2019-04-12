<?php
/**
 * Created by PhpStorm.
 * User: ernestosr
 * Date: 12/02/2019
 * Time: 09:59 PM
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class AppTinteCristal extends _Entity_
{
    /**
     * @var
     * @ORM\OneToOne(targetEntity="App\Entity\AppProducto", inversedBy="tinte_cristales", cascade={"persist","remove"})
     */
    protected $producto;


    public function __toString()
    {
        return (string)$this->producto ? $this->getProducto()->getCodigo() : '';
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