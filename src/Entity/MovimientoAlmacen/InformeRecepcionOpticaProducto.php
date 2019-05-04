<?php


namespace App\Entity\MovimientoAlmacen;


use App\Entity\_BaseEntity_;
use App\Entity\AppProducto;

class InformeRecepcionOpticaProducto extends _BaseEntity_
{
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