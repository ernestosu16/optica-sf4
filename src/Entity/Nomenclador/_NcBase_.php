<?php

namespace App\Entity\Nomenclador;

use App\Entity\_BaseEntity_;
use DateTime;
use Doctrine\ORM\Mapping as ORM;


abstract class _NcBase_ extends _BaseEntity_
{
    public function __toString()
    {
        return (string)$this->valor;
    }

    public function __construct()
    {
        $this->created_at = new DateTime();
    }


    /**
     * @var string
     * @ORM\Column(type="string", length=25)
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