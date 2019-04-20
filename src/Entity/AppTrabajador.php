<?php
/**
 * Created by PhpStorm.
 * User: ernestosr
 * Date: 30/01/2019
 * Time: 04:54 PM
 */

namespace App\Entity;

use App\Auditoria\Annotation as Auditar;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class AppTrabajador
 *
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 * @Auditar\Auditar()
 */
class AppTrabajador extends _BaseEntity_
{
    /**
     * @var AppClasificador
     * @ORM\ManyToOne(targetEntity="App\Entity\AppClasificador")
     */
    protected $cargo;

    /**
     * @var string
     * @Assert\Regex(
     *     "/^\d{2}(0?[1-9]|1[012])(0?[1-9]|[12][0-9]|3[01])(\d{5})$/",
     *     message="El número del carnet de identidad no es correcto"
     * )
     * @ORM\Column(type="string", length=15, unique=true)
     */
    protected $ci;

    /**
     * @var string
     * @ORM\Column(type="string", length=150)
     */
    protected $nombre_apellidos;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="App\Entity\SecurityOffice")
     */
    protected $oficina;

    public function getCi(): ?string
    {
        return $this->ci;
    }

    public function setCi(string $ci): self
    {
        $this->ci = $ci;

        return $this;
    }

    public function getNombreApellidos(): ?string
    {
        return $this->nombre_apellidos;
    }

    public function setNombreApellidos(string $nombre_apellidos): self
    {
        $this->nombre_apellidos = $nombre_apellidos;

        return $this;
    }

    public function getCargo(): ?AppClasificador
    {
        return $this->cargo;
    }

    public function setCargo(?AppClasificador $cargo): self
    {
        $this->cargo = $cargo;

        return $this;
    }

    public function getOficina(): ?SecurityOffice
    {
        return $this->oficina;
    }

    public function setOficina(?SecurityOffice $oficina): self
    {
        $this->oficina = $oficina;

        return $this;
    }

}