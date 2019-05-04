<?php


namespace App\Entity\MovimientoAlmacen;

use App\Entity\AppCristal;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class InformeRecepcionOpticaCristal extends InformeRecepcionOpticaProducto
{
    /**
     * @var int
     *
     * @ORM\Column(name="cantidad", type="integer")
     */
    protected $cantidad;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppCristal")
     */
    protected $producto;

    /**
     * @ORM\ManyToOne(targetEntity="InformeRecepcionOptica", inversedBy="cristales")
     * @ORM\JoinColumn(name="id_informe_recepcion", referencedColumnName="id", nullable=false)
     */
    protected $informe_recepcion;


    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getProducto(): ?AppCristal
    {
        return $this->producto;
    }

    public function setProducto(?AppCristal $producto): self
    {
        $this->producto = $producto;

        return $this;
    }

    public function getInformeRecepcion(): ?InformeRecepcionOptica
    {
        return $this->informe_recepcion;
    }

    public function setInformeRecepcion(?InformeRecepcionOptica $informe_recepcion): self
    {
        $this->informe_recepcion = $informe_recepcion;

        return $this;
    }

}