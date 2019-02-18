<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class AppInformeRecepcion extends _BaseEntity_
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppMovimientoAlmacen")
     */
    protected $movimiento;

    /**
     * @var string
     * @ORM\Column(type="string", length=150)
     */
    protected $numero;

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getMovimiento(): ?AppMovimientoAlmacen
    {
        return $this->movimiento;
    }

    public function setMovimiento(?AppMovimientoAlmacen $movimiento): self
    {
        $this->movimiento = $movimiento;

        return $this;
    }
}