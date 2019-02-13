<?php

namespace App\Entity;

use App\Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Product
 *
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class AppProducto extends _BaseEntity_
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=15)
     */
    protected $codigo;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=150)
     */
    protected $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $observaciones;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    protected $precio;

    /**
     * @ORM\ManyToOne(targetEntity="App\Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"})
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="SET NULL")
     */
    protected $imagen;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AppArmadura", mappedBy="producto")
     */
    protected $armaduras;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AppAccesorio", mappedBy="producto")
     */
    protected $accesorios;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AppCristal", mappedBy="producto")
     */
    protected $cristales;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AppTinteCristal", mappedBy="producto")
     */
    protected $tinte_cristales;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $descriminator;

    /**
     * Product constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();
        $this->accesorios = new ArrayCollection();
        $this->tinte_cristales = new ArrayCollection();
        $this->cristales = new ArrayCollection();
        $this->armaduras = new ArrayCollection();
    }

    public function __toString()
    {
        return "{$this->codigo} - {$this->descripcion} ";
    }


    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(string $observaciones): self
    {
        $this->observaciones = $observaciones;

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

    public function getDescriminator(): ?string
    {
        return $this->descriminator;
    }

    public function setDescriminator(string $descriminator): self
    {
        $this->descriminator = $descriminator;

        return $this;
    }

    public function getImagen(): ?Media
    {
        return $this->imagen;
    }

    public function setImagen(?Media $imagen): self
    {
        $this->imagen = $imagen;

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
            $accesorio->setProducto($this);
        }

        return $this;
    }

    public function removeAccesorio(AppAccesorio $accesorio): self
    {
        if ($this->accesorios->contains($accesorio)) {
            $this->accesorios->removeElement($accesorio);
            // set the owning side to null (unless already changed)
            if ($accesorio->getProducto() === $this) {
                $accesorio->setProducto(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AppTinteCristal[]
     */
    public function getTinteCristales(): Collection
    {
        return $this->tinte_cristales;
    }

    public function addTinteCristale(AppTinteCristal $tinteCristale): self
    {
        if (!$this->tinte_cristales->contains($tinteCristale)) {
            $this->tinte_cristales[] = $tinteCristale;
            $tinteCristale->setProducto($this);
        }

        return $this;
    }

    public function removeTinteCristale(AppTinteCristal $tinteCristale): self
    {
        if ($this->tinte_cristales->contains($tinteCristale)) {
            $this->tinte_cristales->removeElement($tinteCristale);
            // set the owning side to null (unless already changed)
            if ($tinteCristale->getProducto() === $this) {
                $tinteCristale->setProducto(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AppCristal[]
     */
    public function getCristales(): Collection
    {
        return $this->cristales;
    }

    public function addCristale(AppCristal $cristale): self
    {
        if (!$this->cristales->contains($cristale)) {
            $this->cristales[] = $cristale;
            $cristale->setProducto($this);
        }

        return $this;
    }

    public function removeCristale(AppCristal $cristale): self
    {
        if ($this->cristales->contains($cristale)) {
            $this->cristales->removeElement($cristale);
            // set the owning side to null (unless already changed)
            if ($cristale->getProducto() === $this) {
                $cristale->setProducto(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AppArmadura[]
     */
    public function getArmaduras(): Collection
    {
        return $this->armaduras;
    }

    public function addArmadura(AppArmadura $armadura): self
    {
        if (!$this->armaduras->contains($armadura)) {
            $this->armaduras[] = $armadura;
            $armadura->setProducto($this);
        }

        return $this;
    }

    public function removeArmadura(AppArmadura $armadura): self
    {
        if ($this->armaduras->contains($armadura)) {
            $this->armaduras->removeElement($armadura);
            // set the owning side to null (unless already changed)
            if ($armadura->getProducto() === $this) {
                $armadura->setProducto(null);
            }
        }

        return $this;
    }


}