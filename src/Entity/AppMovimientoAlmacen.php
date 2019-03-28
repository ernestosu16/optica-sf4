<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class AppMovimientoAlmacen extends _BaseEntity_
{
    /**
     * @var string
     * @ORM\Column(type="string", length=10)
     */
    protected $numero;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SecurityOffice")
     */
    protected $office;

    /**
     * @var string
     * @ORM\Column(type="string", length=10)
     */
    protected $state;

    /**
     * @var string
     * @ORM\Column(type="string", length=10)
     */
    protected $discriminator;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AppSubmayorProducto", mappedBy="movimiento", cascade={"all"}, orphanRemoval=true)
     */
    protected $sub_mayor;

    public function __construct()
    {
        $this->sub_mayor = new ArrayCollection();
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getDiscriminator(): ?string
    {
        return $this->discriminator;
    }

    public function setDiscriminator(string $discriminator): self
    {
        $this->discriminator = $discriminator;

        return $this;
    }

    /**
     * @return Collection|AppSubmayorProducto[]
     */
    public function getSubMayor(): ?Collection
    {
        return $this->sub_mayor;
    }

    public function addSubMayor(AppSubmayorProducto $subMayor): self
    {
        if (!$this->sub_mayor->contains($subMayor)) {
            $this->sub_mayor[] = $subMayor;
            $subMayor->setMovimiento($this);
        }

        return $this;
    }

    public function removeSubMayor(AppSubmayorProducto $subMayor): self
    {
        if ($this->sub_mayor->contains($subMayor)) {
            $this->sub_mayor->removeElement($subMayor);
            // set the owning side to null (unless already changed)
            if ($subMayor->getMovimiento() === $this) {
                $subMayor->setMovimiento(null);
            }
        }

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

}