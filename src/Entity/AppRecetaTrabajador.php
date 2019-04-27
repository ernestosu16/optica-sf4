<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Class AppReceta
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class AppRecetaTrabajador extends _BaseEntity_
{
    /**
     * @var string
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $nombre;

    /**
     * @var string
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $apellido;

    public function __toString()
    {
        return (string)$this->nombre . ' ' . $this->apellido;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(?string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }


}