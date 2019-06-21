<?php


namespace App\Entity\DespachoAlmacen;

use App\Entity\AppOrdenServicio;
use App\Entity\_Entity_;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class AppDespachoAlmacenOrdenServicio extends _Entity_
{
    /**
     * @var
     * @ORM\OneToOne(targetEntity="App\Entity\AppOrdenServicio", inversedBy="despacho_almacen")
     */
    protected $orden_servicio;

    public function getOrdenServicio(): ?AppOrdenServicio
    {
        return $this->orden_servicio;
    }

    public function setOrdenServicio(?AppOrdenServicio $orden_servicio): self
    {
        $this->orden_servicio = $orden_servicio;

        return $this;
    }
}