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
}