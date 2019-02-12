<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class AppCristal
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $grosor;

    /**
     * @var float
     *
     * @ORM\Column(name="esfera", type="float")
     */
    private $esfera;

    /**
     * @var float
     *
     * @ORM\Column(name="cilindro", type="float")
     */
    private $cilindro;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGrosor(): ?float
    {
        return $this->grosor;
    }

    public function setGrosor(float $grosor): self
    {
        $this->grosor = $grosor;

        return $this;
    }

    public function getEsfera(): ?float
    {
        return $this->esfera;
    }

    public function setEsfera(float $esfera): self
    {
        $this->esfera = $esfera;

        return $this;
    }

    public function getCilindro(): ?float
    {
        return $this->cilindro;
    }

    public function setCilindro(float $cilindro): self
    {
        $this->cilindro = $cilindro;

        return $this;
    }
}