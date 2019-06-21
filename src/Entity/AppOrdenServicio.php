<?php

namespace App\Entity;

use App\Entity\DespachoAlmacen\AppDespachoAlmacenOrdenServicio;
use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use App\Auditoria\Annotation as Auditar;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrdenServicioRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=false)
 * @Auditar\Auditar()
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
     * @ORM\ManyToOne(targetEntity="App\Entity\AppPaciente")
     */
    protected $paciente;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\AppTinteCristal")
     */
    protected $tinte_cristal;

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

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\AppSolicitudTallado", cascade={"persist"}, mappedBy="orden_servicio")
     */

    protected $solicitud_tallado;
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\DespachoAlmacen\AppDespachoAlmacenOrdenServicio", cascade={"persist"}, mappedBy="orden_servicio")
     */
    protected $despacho_almacen_orden_servicio;

    public function __construct()
    {
        $this->accesorios = new ArrayCollection();
    }

    public function __toString()
    {
        return (string) $this->numero;
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

    public function getPaciente(): ?AppPaciente
    {
        return $this->paciente;
    }

    public function setPaciente(?AppPaciente $paciente): self
    {
        $this->paciente = $paciente;

        return $this;
    }

    public function getSolicitudTallado(): ?AppSolicitudTallado
    {
        return $this->solicitud_tallado;
    }

    public function setSolicitudTallado(?AppSolicitudTallado $solicitud_tallado): self
    {
        $this->solicitud_tallado = $solicitud_tallado;

        // set (or unset) the owning side of the relation if necessary
        $newOrden_servicio = $solicitud_tallado === null ? null : $this;
        if ($newOrden_servicio !== $solicitud_tallado->getOrdenServicio()) {
            $solicitud_tallado->setOrdenServicio($newOrden_servicio);
        }

        return $this;
    }

    public function getTinteCristal(): ?AppTinteCristal
    {
        return $this->tinte_cristal;
    }

    public function setTinteCristal(?AppTinteCristal $tinte_cristal): self
    {
        $this->tinte_cristal = $tinte_cristal;

        return $this;
    }

    public function getDespachoAlmacenOrdenServicio(): ?AppDespachoAlmacenOrdenServicio
    {
        return $this->despacho_almacen_orden_servicio;
    }

    public function setDespachoAlmacenOrdenServicio(?AppDespachoAlmacenOrdenServicio $despacho_almacen_orden_servicio): self
    {
        $this->despacho_almacen_orden_servicio = $despacho_almacen_orden_servicio;

        // set (or unset) the owning side of the relation if necessary
        $newOrden_servicio = $despacho_almacen_orden_servicio === null ? null : $this;
        if ($newOrden_servicio !== $despacho_almacen_orden_servicio->getOrdenServicio()) {
            $despacho_almacen_orden_servicio->setOrdenServicio($newOrden_servicio);
        }

        return $this;
    }

}