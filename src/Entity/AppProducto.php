<?php

namespace App\Entity;

use App\Application\Sonata\MediaBundle\Entity\Media;
use App\Entity\MovimientoAlmacen\Alamacen;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Product
 *
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=false)
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $observaciones;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    protected $precio;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    protected $precio_costo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"})
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="SET NULL")
     */
    protected $imagen;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\AppArmadura", mappedBy="producto", cascade={"persist","remove"}, orphanRemoval=true)
     */
    protected $armaduras;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\AppAccesorio", mappedBy="producto", cascade={"persist","remove"}, orphanRemoval=true)
     */
    protected $accesorios;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\AppCristal", mappedBy="producto", cascade={"persist","remove"}, orphanRemoval=true)
     */
    protected $cristales;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\AppTinteCristal", mappedBy="producto")
     */
    protected $tinte_cristales;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $descriminator;

    /**
     * @var Alamacen
     * @ORM\OneToMany(targetEntity="App\Entity\MovimientoAlmacen\Alamacen", mappedBy="producto")
     */
    protected $almacen;

    /**
     * Product constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->almacen = new ArrayCollection();
    }

    public function __toString()
    {
        return (string)"{$this->codigo} - {$this->descripcion} ";
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
     * @return AppAccesorio
     */
    public function getAccesorio(): AppAccesorio
    {
        return $this->accesorios;
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
     * @return AppTinteCristal
     */
    public function getTinteCristal(): AppTinteCristal
    {
        return $this->tinte_cristales;
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

    /**
     * @return AppArmadura
     */
    public function getArmadura(): AppArmadura
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

    public function setAccesorios(?AppAccesorio $accesorios): self
    {
        $this->accesorios = $accesorios;

        // set (or unset) the owning side of the relation if necessary
        $newProducto = $accesorios === null ? null : $this;
        if ($newProducto !== $accesorios->getProducto()) {
            $accesorios->setProducto($newProducto);
        }

        return $this;
    }

    public function setArmaduras(?AppArmadura $armaduras): self
    {
        $this->armaduras = $armaduras;

        // set (or unset) the owning side of the relation if necessary
        $newProducto = $armaduras === null ? null : $this;
        if ($newProducto !== $armaduras->getProducto()) {
            $armaduras->setProducto($newProducto);
        }

        return $this;
    }

    public function setCristales(?AppCristal $cristales): self
    {
        $this->cristales = $cristales;

        // set (or unset) the owning side of the relation if necessary
        $newProducto = $cristales === null ? null : $this;
        if ($newProducto !== $cristales->getProducto()) {
            $cristales->setProducto($newProducto);
        }

        return $this;
    }

    public function setTinteCristales(?AppTinteCristal $tinte_cristales): self
    {
        $this->tinte_cristales = $tinte_cristales;

        // set (or unset) the owning side of the relation if necessary
        $newProducto = $tinte_cristales === null ? null : $this;
        if ($newProducto !== $tinte_cristales->getProducto()) {
            $tinte_cristales->setProducto($newProducto);
        }

        return $this;
    }

    public function getPrecioCosto(): ?float
    {
        return $this->precio_costo;
    }

    public function setPrecioCosto(float $precio_costo): self
    {
        $this->precio_costo = $precio_costo;

        return $this;
    }

    /**
     * @return Collection|Alamacen[]
     */
    public function getAlmacen(): Collection
    {
        return $this->almacen;
    }

    public function addAlmacen(Alamacen $almacen): self
    {
        if (!$this->almacen->contains($almacen)) {
            $this->almacen[] = $almacen;
            $almacen->setProducto($this);
        }

        return $this;
    }

    public function removeAlmacen(Alamacen $almacen): self
    {
        if ($this->almacen->contains($almacen)) {
            $this->almacen->removeElement($almacen);
            // set the owning side to null (unless already changed)
            if ($almacen->getProducto() === $this) {
                $almacen->setProducto(null);
            }
        }

        return $this;
    }


}