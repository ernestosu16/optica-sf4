<?php

namespace App\Entity\Nomenclador;

use Doctrine\ORM\Mapping as ORM;

/**
 * NcAdd
 *
 * @ORM\Table(name="nomenclador_add")
 * @ORM\Entity()
 */
class NomencladorAdd
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
     * @ORM\Column(name="valor", type="float")
     */
    private $valor;


    function __toString()
    {
        return $this->getId() ? '' . $this->getValor() : '';
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set valor
     *
     * @param float $valor
     *
     * @return NomencladorAdd
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return float
     */
    public function getValor()
    {
        return $this->valor;
    }
}
