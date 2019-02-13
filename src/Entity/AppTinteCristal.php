<?php
/**
 * Created by PhpStorm.
 * User: ernestosr
 * Date: 12/02/2019
 * Time: 09:59 PM
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class AppTinteCristal extends _BaseEntity_
{
    /**
     * @var
     * @ORM\ManyToOne(targetEntity="App\Entity\AppProducto", inversedBy="tinte_cristales")
     */
    protected $producto;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AppRecetaComponente", mappedBy="tinte_cristal")
     */
    protected $receta_componentes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AppOrdenServicio", mappedBy="tinte_cristal")
     */
    protected $orden_servicios;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    protected $nombre;

    public function __construct()
    {
        parent::__construct();
        $this->receta_componentes = new ArrayCollection();
        $this->orden_servicios = new ArrayCollection();
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getProducto(): ?AppProducto
    {
        return $this->producto;
    }

    public function setProducto(?AppProducto $producto): self
    {
        $this->producto = $producto;

        return $this;
    }

    /**
     * @return Collection|AppRecetaComponente[]
     */
    public function getRecetaComponentes(): Collection
    {
        return $this->receta_componentes;
    }

    public function addRecetaComponente(AppRecetaComponente $recetaComponente): self
    {
        if (!$this->receta_componentes->contains($recetaComponente)) {
            $this->receta_componentes[] = $recetaComponente;
            $recetaComponente->setTinteCristal($this);
        }

        return $this;
    }

    public function removeRecetaComponente(AppRecetaComponente $recetaComponente): self
    {
        if ($this->receta_componentes->contains($recetaComponente)) {
            $this->receta_componentes->removeElement($recetaComponente);
            // set the owning side to null (unless already changed)
            if ($recetaComponente->getTinteCristal() === $this) {
                $recetaComponente->setTinteCristal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AppOrdenServicio[]
     */
    public function getOrdenServicios(): Collection
    {
        return $this->orden_servicios;
    }

    public function addOrdenServicio(AppOrdenServicio $ordenServicio): self
    {
        if (!$this->orden_servicios->contains($ordenServicio)) {
            $this->orden_servicios[] = $ordenServicio;
            $ordenServicio->setTinteCristal($this);
        }

        return $this;
    }

    public function removeOrdenServicio(AppOrdenServicio $ordenServicio): self
    {
        if ($this->orden_servicios->contains($ordenServicio)) {
            $this->orden_servicios->removeElement($ordenServicio);
            // set the owning side to null (unless already changed)
            if ($ordenServicio->getTinteCristal() === $this) {
                $ordenServicio->setTinteCristal(null);
            }
        }

        return $this;
    }

}