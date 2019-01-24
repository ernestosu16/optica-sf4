<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SecurityOfficeRepository")
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
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $description;

    /**
     * @ORM\Column(type="integer")
     */
    protected $position;

    /**
     * @ORM\Column(type="integer")
     */
    protected $lft;

    /**
     * @ORM\Column(type="integer")
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
        return !is_null($this->name) ? $this->name : 'null';
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
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
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return SecurityOffice
     */
    public function setDescription(string $description): SecurityOffice
    {
        $this->description = $description;

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


}
