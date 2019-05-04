<?php


namespace App\Entity\MovimientoAlmacen;

use App\Entity\AppArmadura;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class InformeRecepcionOpticaArmadura extends InformeRecepcionOpticaProducto
{
    /**
     * @var int
     *
     * @ORM\Column(name="cantidad", type="integer")
     */
    protected $cantidad;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppArmadura")
     */
    protected $producto;

    /**
     * @ORM\ManyToOne(targetEntity="InformeRecepcionOptica", inversedBy="armaduras")
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

    public function getProducto(): ?AppArmadura
    {
        return $this->producto;
    }

    public function setProducto(?AppArmadura $producto): self
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