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
}