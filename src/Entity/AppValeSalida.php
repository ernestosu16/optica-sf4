<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class AppValeSalida extends _BaseEntity_
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppMovimientoAlmacen")
     */
    protected $movimiento;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppOrdenServicio")
     */
    protected $orden_servicio;

    public function getMovimiento(): ?AppMovimientoAlmacen
    {
        return $this->movimiento;
    }

    public function setMovimiento(?AppMovimientoAlmacen $movimiento): self
    {
        $this->movimiento = $movimiento;

        return $this;
    }

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