<?php

namespace App\Entity\Nomenclador;

use Doctrine\ORM\Mapping as ORM;

/**
 * NcArmadura
 *
 * @ORM\Table(name="nomenclador_armadura")
 * @ORM\Entity()
 */
class NomencladorArmadura
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
     * @var string
     *
     * @ORM\Column(name="modelo", type="string", length=255)
     */
    private $modelo;

    /**
     * @var int
     *
     * @ORM\Column(name="aro", type="integer")
     */
    private $aro;

    /**
     * @var int
     *
     * @ORM\Column(name="puente", type="integer")
     */
    private $puente;

    /**
     * @var int
     *
     * @ORM\Column(name="altura", type="integer")
     */
    private $altura;

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

	public function __toString(){
		return $this->getId()?$this->getCodigo().' - '.$this->getModelo().' - '.$this->getDisponible().' disponibles':'';
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
     * @return NomencladorArmadura
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
     * Set modelo
     *
     * @param string $modelo
     *
     * @return NomencladorArmadura
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;

        return $this;
    }

    /**
     * Get modelo
     *
     * @return string
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Set aro
     *
     * @param integer $aro
     *
     * @return NomencladorArmadura
     */
    public function setAro($aro)
    {
        $this->aro = $aro;

        return $this;
    }

    /**
     * Get aro
     *
     * @return int
     */
    public function getAro()
    {
        return $this->aro;
    }

    /**
     * Set puente
     *
     * @param integer $puente
     *
     * @return NomencladorArmadura
     */
    public function setPuente($puente)
    {
        $this->puente = $puente;

        return $this;
    }

    /**
     * Get puente
     *
     * @return int
     */
    public function getPuente()
    {
        return $this->puente;
    }

    /**
     * Set altura
     *
     * @param integer $altura
     *
     * @return NomencladorArmadura
     */
    public function setAltura($altura)
    {
        $this->altura = $altura;

        return $this;
    }

    /**
     * Get altura
     *
     * @return int
     */
    public function getAltura()
    {
        return $this->altura;
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
     * @return NomencladorArmadura
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
     * @return NomencladorArmadura
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
     * @return NomencladorArmadura
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
