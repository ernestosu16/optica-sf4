<?php

namespace App\Entity;

use App\Application\Sonata\MediaBundle\Entity\Media;
use App\Auditoria\Annotation as Auditar;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Sonata\MediaBundle\Model\MediaInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SecurityOfficeRepository")
 * @Auditar\Auditar()
 */
class SecurityOffice
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"})
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="SET NULL")
     */
    protected $media;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=4, unique=true)
     */
    protected $number;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=8, nullable=true)
     */
    protected $telefono;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $direccion;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $position;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $lft;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $rgt;


    /**
     * SecurityOffice constructor.
     */
    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    public function __toString()
    {
        return (string) !is_null($this->name) ? $this->name : 'null';
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param MediaInterface $media
     * @return SecurityOffice
     */
    public function setMedia(MediaInterface $media): SecurityOffice
    {
        $this->media = $media;

        return $this;
    }

    /**
     * @return MediaInterface
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return SecurityOffice|null
     */
    public function setName(string $name): SecurityOffice
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getPosition(): ?int
    {
        return $this->position;
    }

    /**
     * @param int $position
     * @return SecurityOffice
     */
    public function setPosition($position): SecurityOffice
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return int
     */
    public function getLft(): ?int
    {
        return $this->lft;
    }

    /**
     * @param mixed $lft
     * @return SecurityOffice
     */
    public function setLft($lft): SecurityOffice
    {
        $this->lft = $lft;

        return $this;
    }

    /**
     * @return int
     */
    public function getRgt(): ?int
    {
        return $this->rgt;
    }

    /**
     * @param mixed $rgt
     * @return SecurityOffice
     */
    public function setRgt($rgt): SecurityOffice
    {
        $this->rgt = $rgt;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(?string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }


}
