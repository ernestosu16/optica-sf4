<?php
/**
 * Created by PhpStorm.
 * User: ernestosr
 * Date: 11/02/2019
 * Time: 01:01 AM
 */

namespace App\Entity;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\AppPaciente")
     */
    protected $paciente;

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
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $fecha_recepcion;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $fecha_entrega;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $fecha_recogida;

    public function __construct()
    {
        $this->receta_componente = new ArrayCollection();
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

    public function getFechaRecepcion(): ?\DateTimeInterface
    {
        return $this->fecha_recepcion;
    }

    public function setFechaRecepcion(\DateTimeInterface $fecha_recepcion): self
    {
        $this->fecha_recepcion = $fecha_recepcion;

        return $this;
    }

    public function getFechaEntrega(): ?\DateTimeInterface
    {
        return $this->fecha_entrega;
    }

    public function setFechaEntrega(\DateTimeInterface $fecha_entrega): self
    {
        $this->fecha_entrega = $fecha_entrega;

        return $this;
    }

    public function getFechaRecogida(): ?\DateTimeInterface
    {
        return $this->fecha_recogida;
    }

    public function setFechaRecogida(\DateTimeInterface $fecha_recogida): self
    {
        $this->fecha_recogida = $fecha_recogida;

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
}