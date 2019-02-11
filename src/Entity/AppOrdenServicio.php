<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class AppOrdenServicio extends _BaseEntity_
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppReceta")
     */
    protected $receta;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppArmadura")
     */
    protected $armadura;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppCristal")
     */
    protected $cristal;


    /**
     * @ORM\Column(type="integer")
     */
    protected $tinte_id;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppTrabajador")
     */
    protected $trabajador;

    /**
     * @var string
     * @ORM\Column(type="string", length=15)
     */
    protected $numero;

    /**
     * @var string
     * @ORM\Column(type="float")
     */
    protected $esfera_od;

    /**
     * @var string
     * @ORM\Column(type="float")
     */
    protected $esfera_oi;

    /**
     * @var string
     * @ORM\Column(type="float")
     */
    protected $cilindro_od;

    /**
     * @var string
     * @ORM\Column(type="float")
     */
    protected $cilindro_oi;

    /**
     * @var string
     * @ORM\Column(type="float")
     */
    protected $eje_od;

    /**
     * @var string
     * @ORM\Column(type="float")
     */
    protected $eje_oi;

    /**
     * @var string
     * @ORM\Column(type="float")
     */
    protected $prima_od;

    /**
     * @var string
     * @ORM\Column(type="float")
     */
    protected $prima_oi;

    /**
     * @var string
     * @ORM\Column(type="float")
     */
    protected $base_od;

    /**
     * @var string
     * @ORM\Column(type="float")
     */
    protected $base_oi;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected $observaciones;

    /**
     * @var string
     * @ORM\Column(type="string", length=20)
     */
    protected $stage;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $fecha_asignacion;

}