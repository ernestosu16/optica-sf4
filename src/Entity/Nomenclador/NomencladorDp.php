<?php

namespace App\Entity\Nomenclador;

use Doctrine\ORM\Mapping as ORM;

/**
 * NcDp
 *
 * @ORM\Table(name="nomenclador_dp")
 * @ORM\Entity()
 */
class NomencladorDp
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
     * @ORM\Column(name="cerca", type="integer")
     */
    private $cerca;

    /**
     * @var int
     *
     * @ORM\Column(name="lejos", type="integer")
     */
    private $lejos;

    public function __toString()
    {
        return $this->getId() ? $this->getLejos() . ' / ' . $this->getCerca() : '';
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
     * Set cerca
     *
     * @param integer $cerca
     *
     * @return NomencladorDp
     */
    public function setCerca($cerca)
    {
        $this->cerca = $cerca;

        return $this;
    }

    /**
     * Get cerca
     *
     * @return int
     */
    public function getCerca()
    {
        return $this->cerca;
    }

    /**
     * Set lejos
     *
     * @param integer $lejos
     *
     * @return NomencladorDp
     */
    public function setLejos($lejos)
    {
        $this->lejos = $lejos;

        return $this;
    }

    /**
     * Get lejos
     *
     * @return int
     */
    public function getLejos()
    {
        return $this->lejos;
    }
}
