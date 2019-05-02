<?php

namespace App\Entity\MovimientoAlmacen;

use App\Entity\SecurityOffice;
use App\Entity\_BaseEntity_;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class MvFactura extends _BaseEntity_
{
    /**
     * @var string
     * @ORM\Column(length=15))
     */
    protected $numero_factura;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="MvFacturaProducto", mappedBy="factura", cascade={"persist"})
     */
    protected $factura_producto;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SecurityOffice")
     * @ORM\JoinColumn(name="office_origen_id", referencedColumnName="id")
     */
    protected $office_origen;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SecurityOffice")
     * @ORM\JoinColumn(name="office_destino_id", referencedColumnName="id")
     */
    protected $office_destino;

    public function __construct()
    {
        $this->factura_producto = new ArrayCollection();
    }

    public function __toString()
    {
        return (string)$this->numero_factura;
    }


    public function getNumeroFactura(): ?string
    {
        return $this->numero_factura;
    }

    public function setNumeroFactura(string $numero_factura): self
    {
        $this->numero_factura = $numero_factura;

        return $this;
    }

    /**
     * @return Collection|MvFacturaProducto[]
     */
    public function getFacturaProducto(): Collection
    {
        return $this->factura_producto;
    }

    public function addFacturaProducto(MvFacturaProducto $facturaProducto): self
    {
        if (!$this->factura_producto->contains($facturaProducto)) {
            $this->factura_producto[] = $facturaProducto;
            $facturaProducto->setFactura($this);
        }

        return $this;
    }

    public function removeFacturaProducto(MvFacturaProducto $facturaProducto): self
    {
        if ($this->factura_producto->contains($facturaProducto)) {
            $this->factura_producto->removeElement($facturaProducto);
            // set the owning side to null (unless already changed)
            if ($facturaProducto->getFactura() === $this) {
                $facturaProducto->setFactura(null);
            }
        }

        return $this;
    }

    public function getOfficeOrigen(): ?SecurityOffice
    {
        return $this->office_origen;
    }

    public function setOfficeOrigen(?SecurityOffice $office_origen): self
    {
        $this->office_origen = $office_origen;

        return $this;
    }

    public function getOfficeDestino(): ?SecurityOffice
    {
        return $this->office_destino;
    }

    public function setOfficeDestino(?SecurityOffice $office_destino): self
    {
        $this->office_destino = $office_destino;

        return $this;
    }

}