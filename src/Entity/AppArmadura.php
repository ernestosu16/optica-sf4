<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class AppArmadura
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
     * @var int
     *
     * @ORM\Column(name="aro", type="integer")
     */
    private $aro;

    /**
     * @var int
     *
     * @ORM\Column(name="puente", type="integer")
     */
    private $puente;

    /**
     * @var int
     *
     * @ORM\Column(name="altura", type="integer")
     */
    private $altura;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAro(): ?int
    {
        return $this->aro;
    }

    public function setAro(int $aro): self
    {
        $this->aro = $aro;

        return $this;
    }

    public function getPuente(): ?int
    {
        return $this->puente;
    }

    public function setPuente(int $puente): self
    {
        $this->puente = $puente;

        return $this;
    }

    public function getAltura(): ?int
    {
        return $this->altura;
    }

    public function setAltura(int $altura): self
    {
        $this->altura = $altura;

        return $this;
    }
}