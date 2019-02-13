<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class AppMovimientoAlmacen extends _BaseEntity_
{
    /**
     * @var string
     * @ORM\Column(type="string", length=10)
     */
    protected $numero;

    /**
     * @var string
     * @ORM\Column(type="string", length=10)
     */
    protected $state;

    /**
     * @var string
     * @ORM\Column(type="string", length=10)
     */
    protected $discriminator;

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getDiscriminator(): ?string
    {
        return $this->discriminator;
    }

    public function setDiscriminator(string $discriminator): self
    {
        $this->discriminator = $discriminator;

        return $this;
    }
}