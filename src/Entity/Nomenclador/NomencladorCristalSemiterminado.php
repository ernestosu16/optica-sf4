<?php

namespace App\Entity\Nomenclador;

use Doctrine\ORM\Mapping as ORM;

/**
 * NcCristalSemiterminado
 *
 * @ORM\Table(name="nomenclador_cristal_semiterminado")
 * @ORM\Entity()
 */
class NomencladorCristalSemiterminado
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
     * @var float
     *
     * @ORM\Column(name="base", type="float")
     */
    private $base;

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

    //-----------------------------------------------------------------------------

    /**
     * @ORM\ManyToOne(targetEntity="NomencladorAdd")
     * @ORM\JoinColumn(name="id_add", referencedColumnName="id", nullable=false)
     */
    private $add;

    /**
     * @ORM\ManyToOne(targetEntity="NomencladorCristalSemiterminadoTipo")
     * @ORM\JoinColumn(name="id_cst_tipo", referencedColumnName="id", nullable=false)
     */
    private $tipo;

    //-----------------------------------------------------------------------------

    function __toString()
    {
        return $this->getId() ? $this->getTipo().' - ('.$this->getAdd().' / '.$this->getBase().') - ('.$this->getDisponible().' disponibles)':'';
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
     * Set base
     *
     * @param float $base
     *
     * @return NomencladorCristalSemiterminado
     */
    public function setBase($base)
    {
        $this->base = $base;

        return $this;
    }

    /**
     * Get base
     *
     * @return float
     */
    public function getBase()
    {
        return $this->base;
    }

    /**
     * Set precioCosto
     *
     * @param float $precioCosto
     *
     * @return NomencladorCristalSemiterminado
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
     * @return NomencladorCristalSemiterminado
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
     * @return NomencladorCristalSemiterminado
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
     * @return NomencladorCristalSemiterminado
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
     * @return NomencladorCristalSemiterminado
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

    /**
     * Set add
     *
     * @param \AppBundle\Entity\NcAdd $add
     *
     * @return NomencladorCristalSemiterminado
     */
    public function setAdd(\AppBundle\Entity\NcAdd $add)
    {
        $this->add = $add;

        return $this;
    }

    /**
     * Get add
     *
     * @return \AppBundle\Entity\NcAdd
     */
    public function getAdd()
    {
        return $this->add;
    }

    /**
     * Set tipo
     *
     * @param \AppBundle\Entity\NcCristalSemiterminadoTipo $tipo
     *
     * @return NomencladorCristalSemiterminado
     */
    public function setTipo(\AppBundle\Entity\NcCristalSemiterminadoTipo $tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return \AppBundle\Entity\NcCristalSemiterminadoTipo
     */
    public function getTipo()
    {
        return $this->tipo;
    }
}
