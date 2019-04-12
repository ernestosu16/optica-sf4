<?php
/**
 * Created by PhpStorm.
 * User: ernestosr
 * Date: 11/02/2019
 * Time: 01:01 AM
 */

namespace App\Entity;

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
     * @ORM\OneToMany(targetEntity="App\Entity\AppRecetaComponente", mappedBy="receta")
     */
    protected $receta_componente;

    /**
     * @var string
     * @ORM\Column(type="string", length=15)
     */
    protected $numero;

    /**
     * @ORM\Column(type="string", length=15)
     */
    protected $add;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppCristal")
     */
    protected $cristal_od;

    /**
     * @ORM\Column(type="string", length=15)
     */
    protected $eje_od;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppCristal")
     */
    protected $cristal_oi;

    /**
     * @ORM\Column(type="string", length=15)
     */
    protected $eje_oi;

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

    /**
     * @return Collection|AppRecetaComponente[]
     */
    public function getRecetaComponente(): Collection
    {
        return $this->receta_componente;
    }

    public function addRecetaComponente(AppRecetaComponente $recetaComponente): self
    {
        if (!$this->receta_componente->contains($recetaComponente)) {
            $this->receta_componente[] = $recetaComponente;
            $recetaComponente->setReceta($this);
        }

        return $this;
    }

    public function removeRecetaComponente(AppRecetaComponente $recetaComponente): self
    {
        if ($this->receta_componente->contains($recetaComponente)) {
            $this->receta_componente->removeElement($recetaComponente);
            // set the owning side to null (unless already changed)
            if ($recetaComponente->getReceta() === $this) {
                $recetaComponente->setReceta(null);
            }
        }

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

    public function getEjeOd(): ?string
    {
        return (string)$this->eje_od;
    }

    public function setEjeOd(string $eje_od): self
    {
        $this->eje_od = $eje_od;

        return $this;
    }

    public function getEjeOi(): ?string
    {
        return (string)$this->eje_oi;
    }

    public function setEjeOi(string $eje_oi): self
    {
        $this->eje_oi = $eje_oi;

        return $this;
    }

    public function getAdd(): ?string
    {
        return $this->add;
    }

    public function setAdd(string $add): self
    {
        $this->add = $add;

        return $this;
    }
}