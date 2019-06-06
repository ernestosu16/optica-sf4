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
use Doctrine\Common\Collections\ArrayCollection;
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
     * @var DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $fecha_refraccion;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppPaciente")
     */
    protected $paciente;

    /**
     * @var string
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    protected $numero;

    /**
     * @var array
     * @ORM\Column(type="json")
     */
    protected $lista_espejuelo;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\SecurityUser")
     * @ORM\JoinColumn(name="usuario_creador_id", referencedColumnName="id", nullable=true)
     */
    protected $usuario_creador;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SecurityOffice")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    protected $office_creacion;

    /**
     * @var
     * @ORM\OneToOne(targetEntity="App\Entity\AppOrdenServicio", mappedBy="receta")
     */
    protected $orden_servicio;

    public function __construct()
    {
        $this->fecha_refraccion = new DateTime('now');
        $this->lista_espejuelo = array();
    }

    public function __toString()
    {
        return (string)$this->numero;
    }

    public function getNumero(): ?string
    {
        return (string)$this->numero;
    }

    public function setNumero(?string $numero): self
    {
        $this->numero = $numero;

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

    public function getFechaRefraccion(): ?\DateTimeInterface
    {
        return $this->fecha_refraccion;
    }

    public function setFechaRefraccion(?\DateTimeInterface $fecha_refraccion): self
    {
        $this->fecha_refraccion = $fecha_refraccion;

        return $this;
    }

    public function getUsuarioCreador(): ?SecurityUser
    {
        return $this->usuario_creador;
    }

    public function setUsuarioCreador(?SecurityUser $usuario_creador): self
    {
        $this->usuario_creador = $usuario_creador;

        return $this;
    }

    public function getOfficeCreacion(): ?SecurityOffice
    {
        return $this->office_creacion;
    }

    public function setOfficeCreacion(?SecurityOffice $office_creacion): self
    {
        $this->office_creacion = $office_creacion;

        return $this;
    }

    public function getPaciente(): ?AppPaciente
    {
        return $this->paciente;
    }

    public function setPaciente(?AppPaciente $paciente): self
    {
        $this->paciente = $paciente;

        return $this;
    }

    public function getListaEspejuelo()
    {
        return $this->lista_espejuelo;
    }

    public function setListaEspejuelo($lista_espejuelo): self
    {
        $this->lista_espejuelo = $lista_espejuelo;

        return $this;
    }

    public function getOrdenServicio(): ?AppOrdenServicio
    {
        return $this->orden_servicio;
    }

    public function setOrdenServicio(?AppOrdenServicio $orden_servicio): self
    {
        $this->orden_servicio = $orden_servicio;

        // set (or unset) the owning side of the relation if necessary
        $newReceta = $orden_servicio === null ? null : $this;
        if ($newReceta !== $orden_servicio->getReceta()) {
            $orden_servicio->setReceta($newReceta);
        }

        return $this;
    }
}