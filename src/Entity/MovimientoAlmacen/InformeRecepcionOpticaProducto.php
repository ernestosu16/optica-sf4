<?php


namespace App\Entity\MovimientoAlmacen;


use App\Entity\_BaseEntity_;
use App\Entity\AppProducto;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

class InformeRecepcionOpticaProducto extends _BaseEntity_
{

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    protected $saldo_final = 0;

    public function __construct()
    {
        $this->created_at = new DateTime();
    }

    public function __toString()
    {
        /** @var AppProducto $producto */
        $producto = $this->getProducto();

        if ($producto) {
            return (string)'[' . $producto->getProducto()->getDescripcion() . ': ' . $this->cantidad . '] ';
        } else {
            return '';
        }
    }


    public function getSaldoFinal(): ?int
    {
        return $this->saldo_final;
    }

    public function setSaldoFinal(int $saldo_final): self
    {
        $this->saldo_final = $saldo_final;

        return $this;
    }
}