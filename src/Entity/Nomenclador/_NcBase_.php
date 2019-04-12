<?php

namespace App\Entity\Nomenclador;

use App\Entity\_BaseEntity_;
use Doctrine\ORM\Mapping as ORM;


abstract class _NcBase_ extends _BaseEntity_
{
    /**
     * @var string
     * @ORM\Column(type="string", length=15)
     */
    protected $valor;

    public function getValor(): ?string
    {
        return $this->valor;
    }

    public function setValor(string $valor): self
    {
        $this->valor = $valor;

        return $this;
    }
}