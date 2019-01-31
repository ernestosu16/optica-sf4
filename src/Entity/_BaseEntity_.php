<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


abstract class _BaseEntity_
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $created_at;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $update_at;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $delete_at;

    /**
     * _BaseEntity_ constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->update_at = new \DateTime('now');
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    /**
     * @param \DateTime $created_at
     * @return _BaseEntity_
     */
    public function setCreatedAt(\DateTime $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdateAt(): \DateTime
    {
        return $this->update_at;
    }

    /**
     * @param \DateTime $update_at
     * @return _BaseEntity_
     */
    public function setUpdateAt(\DateTime $update_at): self
    {
        $this->update_at = $update_at;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDeleteAt(): \DateTime
    {
        return $this->delete_at;
    }

    /**
     * @param \DateTime $delete_at
     * @return _BaseEntity_
     */
    public function setDeleteAt(\DateTime $delete_at): self
    {
        $this->delete_at = $delete_at;

        return $this;
    }

    /**
     * @ORM\PrePersist()
     * @throws \Exception
     */
    public function prePersist()
    {
        $this->created_at = new \DateTime();
    }
    /**
     * @ORM\PreUpdate()
     * @throws \Exception
     */
    public function postUpdate()
    {
        $this->update_at = new \DateTime('now');
    }


}