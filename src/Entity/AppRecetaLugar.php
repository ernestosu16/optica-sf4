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
class AppRecetaLugar extends _BaseEntity_
{
    /**
     * @var string
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $nombre;

    public function __toString()
    {
        return (string)$this->nombre;
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
}