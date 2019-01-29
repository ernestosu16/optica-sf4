<?php

namespace App\Entity\Nomenclador;

use Doctrine\ORM\Mapping as ORM;

/**
 * NcCristal
 *
 * @ORM\Table(name="nomenclador_cristal")
 * @ORM\Entity()
 */
class NomencladorCristal
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=255)
     */
    private $codigo;

    /**
     * @var float
     *
     * @ORM\Column(name="esfera", type="float")
     */
    private $esfera;

    /**
     * @var float
     *
     * @ORM\Column(name="cilindro", type="float")
     */
    private $cilindro;

    /**
     * @var float
     *
     * @ORM\Column(name="precio_costo", type="float")
     */
    private $precioCosto;

    /**
     * @var float
     *
     * @ORM\Column(name="precio_venta", type="float")
     */
    private $precioVenta;

    /**
     * @var int
     *
     * @ORM\Column(name="existencia", type="integer")
     */
    private $existencia;

    /**
     * @var int
     *
     * @ORM\Column(name="reservado", type="integer")
     */
    private $reservado;

    /**
     * @var int
     *
     * @ORM\Column(name="disponible", type="integer")
     */
    private $disponible;

    public function __toString()
    {
        return $this->getId() ? '(' . ($this->getEsfera() > 0 ? '+' : '') . $this->getEsfera() . ',' . ($this->getCilindro() > 0 ? '+' : '') . $this->getCilindro() . ')' . ' - ' . $this->getDisponible() . ' disponibles' : '';
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     *
     * @return NomencladorCristal
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set esfera
     *
     * @param float $esfera
     *
     * @return NomencladorCristal
     */
    public function setEsfera($esfera)
    {
        $this->esfera = $esfera;

        return $this;
    }

    /**
     * Get esfera
     *
     * @return float
     */
    public function getEsfera()
    {
        return $this->esfera;
    }

    /**
     * Set cilindro
     *
     * @param float $cilindro
     *
     * @return NomencladorCristal
     */
    public function setCilindro($cilindro)
    {
        $this->cilindro = $cilindro;

        return $this;
    }

    /**
     * Get cilindro
     *
     * @return float
     */
    public function getCilindro()
    {
        return $this->cilindro;
    }

    /**
     * Set precioCosto
     *
     * @param float $precioCosto
     *
     * @return NomencladorCristal
     */
    public function setPrecioCosto($precioCosto)
    {
        $this->precioCosto = $precioCosto;

        return $this;
    }

    /**
     * Get precioCosto
     *
     * @return float
     */
    public function getPrecioCosto()
    {
        return $this->precioCosto;
    }

    /**
     * Set precioVenta
     *
     * @param float $precioVenta
     *
     * @return NomencladorCristal
     */
    public function setPrecioVenta($precioVenta)
    {
        $this->precioVenta = $precioVenta;

        return $this;
    }

    /**
     * Get precioVenta
     *
     * @return float
     */
    public function getPrecioVenta()
    {
        return $this->precioVenta;
    }

    /**
     * Set existencia
     *
     * @param integer $existencia
     *
     * @return NomencladorCristal
     */
    public function setExistencia($existencia)
    {
        $this->existencia = $existencia;

        return $this;
    }

    /**
     * Get existencia
     *
     * @return int
     */
    public function getExistencia()
    {
        return $this->existencia;
    }

    /**
     * Set reservado
     *
     * @param integer $reservado
     *
     * @return NomencladorCristal
     */
    public function setReservado($reservado)
    {
        $this->reservado = $reservado;

        return $this;
    }

    /**
     * Get reservado
     *
     * @return int
     */
    public function getReservado()
    {
        return $this->reservado;
    }

    /**
     * Set disponible
     *
     * @param integer $disponible
     *
     * @return NomencladorCristal
     */
    public function setDisponible($disponible)
    {
        $this->disponible = $disponible;

        return $this;
    }

    /**
     * Get disponible
     *
     * @return int
     */
    public function getDisponible()
    {
        return $this->disponible;
    }
}
