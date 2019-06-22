<?php


namespace App\Entity\DespachoAlmacen;

use App\Entity\AppOrdenServicio;
use App\Entity\_Entity_;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AppDespachoAlmacenOrdenServicioRepository")
 */
class AppDespachoAlmacenOrdenServicio extends _Entity_
{
    /**
     * @var
     * @ORM\ManyToOne(targetEntity="App\Entity\DespachoAlmacen\AppDespachoAlmacen", inversedBy="despacho_almacen_orden_servicio")
     */
    protected $despacho_almacen;

    /**
     * @var
     * @ORM\OneToOne(targetEntity="App\Entity\AppOrdenServicio", inversedBy="despacho_almacen_orden_servicio")
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

    public function getDespachoAlmacen(): ?AppDespachoAlmacen
    {
        return $this->despacho_almacen;
    }

    public function setDespachoAlmacen(?AppDespachoAlmacen $despacho_almacen): self
    {
        $this->despacho_almacen = $despacho_almacen;

        return $this;
    }
}