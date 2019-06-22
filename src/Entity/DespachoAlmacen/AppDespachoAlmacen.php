<?php


namespace App\Entity\DespachoAlmacen;


use App\Entity\SecurityOffice;
use App\Entity\SecurityUser;
use App\Entity\_BaseEntity_;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="App\Repository\AppDespachoAlmacenRepository")
 */
class AppDespachoAlmacen extends _BaseEntity_
{


    /**
     * @var DateTime("Y-m-d")
     * @ORM\Column(type="date", nullable=false)
     */
    protected $fecha;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SecurityUser")
     */
    protected $usuario_creador;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SecurityOffice")
     */
    protected $office;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="App\Entity\DespachoAlmacen\AppDespachoAlmacenOrdenServicio", mappedBy="despacho_almacen",cascade={"persist"})
     */
    protected $despacho_almacen_orden_servicio;

    public function __construct()
    {
        $this->created_at = new DateTime();
        $this->despacho_almacen_orden_servicio = new ArrayCollection();
    }

    public function __toString()
    {
        return (string)$this->fecha;
    }



    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

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

    /**
     * @return Collection|AppDespachoAlmacenOrdenServicio[]
     */
    public function getDespachoAlmacenOrdenServicio(): Collection
    {
        return $this->despacho_almacen_orden_servicio;
    }

    public function addDespachoAlmacenOrdenServicio(AppDespachoAlmacenOrdenServicio $despachoAlmacenOrdenServicio): self
    {
        if (!$this->despacho_almacen_orden_servicio->contains($despachoAlmacenOrdenServicio)) {
            $this->despacho_almacen_orden_servicio[] = $despachoAlmacenOrdenServicio;
            $despachoAlmacenOrdenServicio->setDespachoAlmacen($this);
        }

        return $this;
    }

    public function removeDespachoAlmacenOrdenServicio(AppDespachoAlmacenOrdenServicio $despachoAlmacenOrdenServicio): self
    {
        if ($this->despacho_almacen_orden_servicio->contains($despachoAlmacenOrdenServicio)) {
            $this->despacho_almacen_orden_servicio->removeElement($despachoAlmacenOrdenServicio);
            // set the owning side to null (unless already changed)
            if ($despachoAlmacenOrdenServicio->getDespachoAlmacen() === $this) {
                $despachoAlmacenOrdenServicio->setDespachoAlmacen(null);
            }
        }

        return $this;
    }
}