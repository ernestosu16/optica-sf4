<?php
/**
 * Created by PhpStorm.
 * User: ernestosr
 * Date: 11/02/2019
 * Time: 01:01 AM
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class AppReceta
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class AppReceta extends _BaseEntity_
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppPaciente")
     */
    protected $paciente;

    /**
     * @var string
     * @ORM\Column(type="string", length=15)
     */
    protected $numero;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $fecha_recepcion;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $fecha_entrega;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $fecha_recogida;

    /**
     * @var string
     * @ORM\Column(type="string", length=30)
     */
    protected $estado;
}