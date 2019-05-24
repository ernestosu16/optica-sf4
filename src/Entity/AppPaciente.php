<?php

namespace App\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class AppPaciente
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=false)
 */
class AppPaciente extends _BaseEntity_
{

    /**
     * @var string
     * @ORM\Column(type="string", length=15)
     */
    protected $ci;

    /**
     * @var string
     * @ORM\Column(type="string", length=150)
     */
    protected $nombre;

    /**
     * @var string
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    protected $telefono_contacto;

    /**
     * @var string
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $correo_contacto;

    /**
     * @var string
     * @ORM\Column(type="string", length=150)
     */
    protected $direccion;

    /**
     * @var string
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    protected $historia_clinica;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SecurityUser")
     * @ORM\JoinColumn(name="usuario_creador_id", referencedColumnName="id", nullable=true)
     */
    protected $usuario_creador;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SecurityOffice")
     * @ORM\JoinColumn(name="office", referencedColumnName="id")
     */
    protected $office;

    public function __toString()
    {
        return (string)$this->nombre;
    }

    public function getCi(): ?string
    {
        return $this->ci;
    }

    public function setCi(string $ci): self
    {
        $this->ci = $ci;

        return $this;
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

    public function getTelefonoContacto(): ?string
    {
        return $this->telefono_contacto;
    }

    public function setTelefonoContacto(string $telefono_contacto): self
    {
        $this->telefono_contacto = $telefono_contacto;

        return $this;
    }

    public function getCorreoContacto(): ?string
    {
        return $this->correo_contacto;
    }

    public function setCorreoContacto(string $correo_contacto): self
    {
        $this->correo_contacto = $correo_contacto;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getHistoriaClinica(): ?string
    {
        return $this->historia_clinica;
    }

    public function setHistoriaClinica(string $historia_clinica): self
    {
        $this->historia_clinica = $historia_clinica;

        return $this;
    }

    public function getUsuarioCreador(): ?SecurityUser
    {
        return $this->usuario_creador;
    }

    public function setUsuarioCreador(?SecurityUser $usuario_creador): ?self
    {
        $this->usuario_creador = $usuario_creador;

        return $this;
    }

    public function getOffice(): ?SecurityOffice
    {
        return $this->office;
    }

    public function setOffice(?SecurityOffice $office): ?self
    {
        $this->office = $office;

        return $this;
    }

}