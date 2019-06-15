<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class AppSolicitudTallado extends _BaseEntity_
{
    /**
     * @var string
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    protected $numero;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SecurityOffice")
     */
    protected $office;

    /**
     * @var
     * @ORM\OneToOne(targetEntity="App\Entity\AppOrdenServicio", inversedBy="solicitud_tallado")
     */
    protected $orden_servicio;
}