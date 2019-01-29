<?php

namespace App\Entity\Nomenclador;

use Doctrine\ORM\Mapping as ORM;

/**
 * NcAccesorio
 *
 * @ORM\Table(name="nomenclador_accesorio")
 * @ORM\Entity()
 */
class NomencladorAccesorio
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

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
		return $this->getNombre()?$this->getNombre().' - '.$this->getDisponible().' disponibles':'';
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
     * @return NomencladorAccesorio
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return NomencladorAccesorio
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set precioCosto
     *
     * @param float $precioCosto
     *
     * @return NomencladorAccesorio
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
     * @return NomencladorAccesorio
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
     * @return NomencladorAccesorio
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
     * @return NomencladorAccesorio
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
     * @return NomencladorAccesorio
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
