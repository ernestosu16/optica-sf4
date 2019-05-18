<?php


namespace App\Entity\MovimientoAlmacen;

use App\Entity\SecurityOffice;
use App\Entity\SecurityUser;
use App\Entity\_BaseEntity_;
use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InformeRecepcionOpticaRepository")
 */
class InformeRecepcionOptica extends _BaseEntity_
{
    /**
     * @var DateTime
     *
     * @ORM\Column(name="fecha", type="date")
     */
    protected $fecha;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SecurityUser")
     * @ORM\JoinColumn(name="usuario_creador_id", referencedColumnName="id", nullable=true)
     */
    protected $usuario_creador;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SecurityUser")
     * @ORM\JoinColumn(name="usuario_confirmado_id", referencedColumnName="id", nullable=true)
     */
    protected $usuario_confirmado;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SecurityOffice")
     * @ORM\JoinColumn(name="office_origen_id", referencedColumnName="id", nullable=true)
     */
    protected $office_origen;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SecurityOffice")
     * @ORM\JoinColumn(name="office_destino_id", referencedColumnName="id")
     */
    protected $office_destino;

    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    protected $confirmado;

    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    protected $pendiente;

    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    protected $devuelto;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $devuelto_descripcion;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MovimientoAlmacen\InformeRecepcionOpticaAccesorio", mappedBy="informe_recepcion", cascade={"all"}, orphanRemoval=true)
     */
    protected $accesorios;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MovimientoAlmacen\InformeRecepcionOpticaArmadura", mappedBy="informe_recepcion", cascade={"all"}, orphanRemoval=true)
     */
    public $armaduras;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MovimientoAlmacen\InformeRecepcionOpticaCristal", mappedBy="informe_recepcion", cascade={"all"}, orphanRemoval=true)
     */
    protected $cristales;

    /**
     * @ORM\OneToMany(targetEntity="InformeRecepcionOpticaLupa", mappedBy="informe_recepcion", cascade={"all"}, orphanRemoval=true)
     */
    protected $lupas;

    /**
     * @ORM\OneToMany(targetEntity="InformeRecepcionOpticaTinteCrital", mappedBy="informe_recepcion", cascade={"all"}, orphanRemoval=true)
     */
    protected $tinte_cristales;

    public $tipo_factura;

    public function __toString()
    {
        return (string)$this->getId();
    }


    public function __construct()
    {
        $this->created_at = new DateTime();
        $this->fecha = new DateTime();
        $this->devuelto = false;
        $this->pendiente = false;
        $this->confirmado = false;
        $this->accesorios = new ArrayCollection();
        $this->armaduras = new ArrayCollection();
        $this->cristales = new ArrayCollection();
        $this->lupas = new ArrayCollection();
        $this->tinte_cristales = new ArrayCollection();
    }

    public function getFecha(): ?DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

//    public function getNumeroFactura(): ?string
//    {
//        return $this->numero_factura;
//    }
//
//    public function setNumeroFactura(string $numero_factura): self
//    {
//        $this->numero_factura = $numero_factura;
//
//        return $this;
//    }

    public function getDevuelto(): ?bool
    {
        return $this->devuelto;
    }

    public function setDevuelto(bool $devuelto): self
    {
        $this->devuelto = $devuelto;

        return $this;
    }

    public function getDevueltoDescripcion(): ?string
    {
        return $this->devuelto_descripcion;
    }

    public function setDevueltoDescripcion(?string $devuelto_descripcion): self
    {
        $this->devuelto_descripcion = $devuelto_descripcion;

        return $this;
    }

    public function getConfirmado(): ?bool
    {
        return $this->confirmado;
    }

    public function setConfirmado(bool $confirmado): self
    {
        $this->confirmado = $confirmado;

        return $this;
    }
//
//    public function getOfficeOrigen(): ?SecurityOffice
//    {
//        return $this->office_origen;
//    }
//
//    public function setOfficeOrigen(?SecurityOffice $office_origen): self
//    {
//        $this->office_origen = $office_origen;
//
//        return $this;
//    }

    public function getOfficeDestino(): ?SecurityOffice
    {
        return $this->office_destino;
    }

    public function setOfficeDestino(?SecurityOffice $office_destino): self
    {
        $this->office_destino = $office_destino;

        return $this;
    }

    /**
     * @return Collection|InformeRecepcionOpticaAccesorio[]
     */
    public function getAccesorios(): Collection
    {
        return $this->accesorios;
    }

    public function addAccesorio(InformeRecepcionOpticaAccesorio $accesorio): self
    {
        if (!$this->accesorios->contains($accesorio)) {
            $this->accesorios[] = $accesorio;
            $accesorio->setInformeRecepcion($this);
        }

        return $this;
    }

    public function removeAccesorio(InformeRecepcionOpticaAccesorio $accesorio): self
    {
        if ($this->accesorios->contains($accesorio)) {
            $this->accesorios->removeElement($accesorio);
            // set the owning side to null (unless already changed)
            if ($accesorio->getInformeRecepcion() === $this) {
                $accesorio->setInformeRecepcion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|InformeRecepcionOpticaArmadura[]
     */
    public function getArmaduras(): Collection
    {
        return $this->armaduras;
    }

    public function addArmadura(InformeRecepcionOpticaArmadura $armadura): self
    {
        if (!$this->armaduras->contains($armadura)) {
            $this->armaduras[] = $armadura;
            $armadura->setInformeRecepcion($this);
        }

        return $this;
    }

    public function removeArmadura(InformeRecepcionOpticaArmadura $armadura): self
    {
        if ($this->armaduras->contains($armadura)) {
            $this->armaduras->removeElement($armadura);
            // set the owning side to null (unless already changed)
            if ($armadura->getInformeRecepcion() === $this) {
                $armadura->setInformeRecepcion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|InformeRecepcionOpticaCristal[]
     */
    public function getCristales(): Collection
    {
        return $this->cristales;
    }

    public function addCristale(InformeRecepcionOpticaCristal $cristale): self
    {
        if (!$this->cristales->contains($cristale)) {
            $this->cristales[] = $cristale;
            $cristale->setInformeRecepcion($this);
        }

        return $this;
    }

    public function removeCristale(InformeRecepcionOpticaCristal $cristale): self
    {
        if ($this->cristales->contains($cristale)) {
            $this->cristales->removeElement($cristale);
            // set the owning side to null (unless already changed)
            if ($cristale->getInformeRecepcion() === $this) {
                $cristale->setInformeRecepcion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|InformeRecepcionOpticaLupa[]
     */
    public function getLupas(): Collection
    {
        return $this->lupas;
    }

    public function addLupa(InformeRecepcionOpticaLupa $lupa): self
    {
        if (!$this->lupas->contains($lupa)) {
            $this->lupas[] = $lupa;
            $lupa->setInformeRecepcion($this);
        }

        return $this;
    }

    public function removeLupa(InformeRecepcionOpticaLupa $lupa): self
    {
        if ($this->lupas->contains($lupa)) {
            $this->lupas->removeElement($lupa);
            // set the owning side to null (unless already changed)
            if ($lupa->getInformeRecepcion() === $this) {
                $lupa->setInformeRecepcion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|InformeRecepcionOpticaTinteCrital[]
     */
    public function getTinteCristales(): Collection
    {
        return $this->tinte_cristales;
    }

    public function addTinteCristale(InformeRecepcionOpticaTinteCrital $tinteCristale): self
    {
        if (!$this->tinte_cristales->contains($tinteCristale)) {
            $this->tinte_cristales[] = $tinteCristale;
            $tinteCristale->setInformeRecepcion($this);
        }

        return $this;
    }

    public function removeTinteCristale(InformeRecepcionOpticaTinteCrital $tinteCristale): self
    {
        if ($this->tinte_cristales->contains($tinteCristale)) {
            $this->tinte_cristales->removeElement($tinteCristale);
            // set the owning side to null (unless already changed)
            if ($tinteCristale->getInformeRecepcion() === $this) {
                $tinteCristale->setInformeRecepcion(null);
            }
        }

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

    public function getOfficeOrigen(): ?SecurityOffice
    {
        return $this->office_origen;
    }

    public function setOfficeOrigen(?SecurityOffice $office_origen): self
    {
        $this->office_origen = $office_origen;

        return $this;
    }

    public function getUsuarioConfirmado(): ?SecurityUser
    {
        return $this->usuario_confirmado;
    }

    public function setUsuarioConfirmado(?SecurityUser $usuario_confirmado): self
    {
        $this->usuario_confirmado = $usuario_confirmado;

        return $this;
    }

    public function getPendiente(): ?bool
    {
        return $this->pendiente;
    }

    public function setPendiente(bool $pendiente): self
    {
        $this->pendiente = $pendiente;

        return $this;
    }

}