<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=false)
 */
class AppOrdenServicio extends _BaseEntity_
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SecurityUser")
     */
    protected $usuario_creador;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SecurityOffice")
     */
    protected $office;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\AppReceta", cascade={"persist"}, inversedBy="orden_servicio")
     */
    protected $receta;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppArmadura")
     */
    protected $armadura;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\AppAccesorio")
     */
    protected $accesorios;

    /**
     * @var string
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    protected $numero;

    /**
     * @var float
     * @ORM\Column(type="float")
     */
    protected $precio;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $observaciones;

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
        $this->accesorios = new ArrayCollection();
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(?string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(?string $observaciones): self
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    public function getFechaEntrega(): ?DateTimeInterface
    {
        return $this->fecha_entrega;
    }

    public function setFechaEntrega(?DateTimeInterface $fecha_entrega): self
    {
        $this->fecha_entrega = $fecha_entrega;

        return $this;
    }

    public function getFechaRecogida(): ?DateTimeInterface
    {
        return $this->fecha_recogida;
    }

    public function setFechaRecogida(?DateTimeInterface $fecha_recogida): self
    {
        $this->fecha_recogida = $fecha_recogida;

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

    public function getOffice(): ?SecurityOffice
    {
        return $this->office;
    }

    public function setOffice(?SecurityOffice $office): self
    {
        $this->office = $office;

        return $this;
    }

    public function getReceta(): ?AppReceta
    {
        return $this->receta;
    }

    public function setReceta(?AppReceta $receta): self
    {
        $this->receta = $receta;

        return $this;
    }

    public function getArmadura(): ?AppArmadura
    {
        return $this->armadura;
    }

    public function setArmadura(?AppArmadura $armadura): self
    {
        $this->armadura = $armadura;

        return $this;
    }

    /**
     * @return Collection|AppAccesorio[]
     */
    public function getAccesorios(): Collection
    {
        return $this->accesorios;
    }

    public function addAccesorio(AppAccesorio $accesorio): self
    {
        if (!$this->accesorios->contains($accesorio)) {
            $this->accesorios[] = $accesorio;
        }

        return $this;
    }

    public function removeAccesorio(AppAccesorio $accesorio): self
    {
        if ($this->accesorios->contains($accesorio)) {
            $this->accesorios->removeElement($accesorio);
        }

        return $this;
    }

}