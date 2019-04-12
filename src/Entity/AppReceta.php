<?php
/**
 * Created by PhpStorm.
 * User: ernestosr
 * Date: 11/02/2019
 * Time: 01:01 AM
 */

namespace App\Entity;

use App\Entity\Nomenclador\NcAdd;
use App\Entity\Nomenclador\NcAgudezaVisual;
use App\Entity\Nomenclador\NcDp;
use App\Entity\Nomenclador\NcEje;
use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class AppReceta
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class AppReceta extends _BaseEntity_
{
    /**
     * @var string
     * @ORM\Column(type="string", length=15)
     */
    protected $numero;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Nomenclador\NcAdd")
     */
    protected $add;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Nomenclador\NcDp")
     */
    protected $dp;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppCristal")
     */
    protected $cristal_od;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Nomenclador\NcEje")
     */
    protected $eje_od;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Nomenclador\NcAgudezaVisual")
     */
    protected $a_visual_od;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppCristal")
     */
    protected $cristal_oi;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Nomenclador\NcEje")
     */
    protected $eje_oi;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Nomenclador\NcAgudezaVisual")
     */
    protected $a_visual_oi;

    /**
     * @var DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $fecha_recepcion;

    /**
     * @var DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $fecha_entrega;

    /**
     * @var DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $fecha_recogida;

    public function __construct()
    {
        $this->fecha_recepcion = new DateTime('now');
        $this->receta_componente = new ArrayCollection();
    }

    public function getNumero(): ?string
    {
        return (string)$this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getFechaRecepcion(): ?DateTimeInterface
    {
        return $this->fecha_recepcion;
    }

    public function setFechaRecepcion(DateTimeInterface $fecha_recepcion): self
    {
        $this->fecha_recepcion = $fecha_recepcion;

        return $this;
    }

    public function getFechaEntrega(): ?DateTimeInterface
    {
        return $this->fecha_entrega;
    }

    public function setFechaEntrega(DateTimeInterface $fecha_entrega): self
    {
        $this->fecha_entrega = $fecha_entrega;

        return $this;
    }

    public function getFechaRecogida(): ?DateTimeInterface
    {
        return $this->fecha_recogida;
    }

    public function setFechaRecogida(DateTimeInterface $fecha_recogida): self
    {
        $this->fecha_recogida = $fecha_recogida;

        return $this;
    }


    public function getCristalOd(): ?AppCristal
    {
        return $this->cristal_od;
    }

    public function setCristalOd(?AppCristal $cristal_od): self
    {
        $this->cristal_od = $cristal_od;

        return $this;
    }

    public function getCristalOi(): ?AppCristal
    {
        return $this->cristal_oi;
    }

    public function setCristalOi(?AppCristal $cristal_oi): self
    {
        $this->cristal_oi = $cristal_oi;

        return $this;
    }

    public function getAdd(): ?NcAdd
    {
        return $this->add;
    }

    public function setAdd(?NcAdd $add): self
    {
        $this->add = $add;

        return $this;
    }

    public function getDp(): ?NcDp
    {
        return $this->dp;
    }

    public function setDp(?NcDp $dp): self
    {
        $this->dp = $dp;

        return $this;
    }

    public function getEjeOd(): ?NcEje
    {
        return $this->eje_od;
    }

    public function setEjeOd(?NcEje $eje_od): self
    {
        $this->eje_od = $eje_od;

        return $this;
    }

    public function getAVisualOd(): ?NcAgudezaVisual
    {
        return $this->a_visual_od;
    }

    public function setAVisualOd(?NcAgudezaVisual $a_visual_od): self
    {
        $this->a_visual_od = $a_visual_od;

        return $this;
    }

    public function getEjeOi(): ?NcEje
    {
        return $this->eje_oi;
    }

    public function setEjeOi(?NcEje $eje_oi): self
    {
        $this->eje_oi = $eje_oi;

        return $this;
    }

    public function getAVisualOi(): ?NcAgudezaVisual
    {
        return $this->a_visual_oi;
    }

    public function setAVisualOi(?NcAgudezaVisual $a_visual_oi): self
    {
        $this->a_visual_oi = $a_visual_oi;

        return $this;
    }

}