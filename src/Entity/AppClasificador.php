<?php
/**
 * Created by PhpStorm.
 * User: ernestosr
 * Date: 30/01/2019
 * Time: 04:56 PM
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class AppClasificador
 *
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class AppClasificador extends _BaseEntity_
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=150)
     */
    protected $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=30)
     */
    protected $type;

    /**
     * Constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function __toString()
    {
        return (string) $this->type;
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

}