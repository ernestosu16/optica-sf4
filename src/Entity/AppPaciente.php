<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class AppPaciente
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class AppPaciente extends _BaseEntity_
{

    /**
     * @var string
     * @ORM\Column(type="string", length=15, unique=true)
     */
    protected $ci;

    /**
     * @var string
     * @ORM\Column(type="string", length=150)
     */
    protected $nombre;

    /**
     * @var string
     * @ORM\Column(type="string", length=15)
     */
    protected $telefono_contacto;

    /**
     * @var string
     * @ORM\Column(type="string", length=50)
     */
    protected $correo_contacto;

    /**
     * @var string
     * @ORM\Column(type="string", length=150)
     */
    protected $direccion;

    /**
     * @var string
     * @ORM\Column(type="string", length=15)
     */
    protected $historia_clinica;

    public function __toString()
    {
        return $this->nombre;
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

}