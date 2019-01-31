<?php

namespace App\Entity;

use App\Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Product
 *
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class AppProducto extends _BaseEntity_
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=15)
     */
    protected $codigo;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=150)
     */
    protected $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $observaciones;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    protected $precio;

    /**
     * @ORM\ManyToOne(targetEntity="App\Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"})
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="SET NULL")
     */
    protected $imagen;


    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $descriminator;

    /**
     * Product constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(string $observaciones): self
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getDescriminator(): ?string
    {
        return $this->descriminator;
    }

    public function setDescriminator(string $descriminator): self
    {
        $this->descriminator = $descriminator;

        return $this;
    }

    public function getImagen(): ?Media
    {
        return $this->imagen;
    }

    public function setImagen(?Media $imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }


}