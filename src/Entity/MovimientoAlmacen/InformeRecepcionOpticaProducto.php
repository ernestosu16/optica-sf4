<?php


namespace App\Entity\MovimientoAlmacen;


use App\Entity\_BaseEntity_;
use App\Entity\AppProducto;
use DateTime;

class InformeRecepcionOpticaProducto extends _BaseEntity_
{
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
}