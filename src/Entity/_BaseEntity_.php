<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;

/**
 * Class _BaseEntity_
 * @package App\Entity
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=false)
 */
abstract class _BaseEntity_ extends _Entity_
{
    use SoftDeleteableEntity;

    /**
     * @var DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $created_at;

    /**
     * @var DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $update_at;

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    /**
     * @param DateTime $created_at
     * @return _BaseEntity_
     */
    public function setCreatedAt(DateTime $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdateAt(): ?DateTime
    {
        return $this->update_at;
    }

    /**
     * @param DateTime $update_at
     * @return _BaseEntity_
     */
    public function setUpdateAt(DateTime $update_at): self
    {
        $this->update_at = $update_at;

        return $this;
    }

    /**
     * @ORM\PrePersist()
     * @throws Exception
     */
    public function prePersist()
    {
        $this->created_at = new DateTime();
    }
    /**
     * @ORM\PreUpdate()
     * @throws Exception
     */
    public function postUpdate()
    {
        $this->update_at = new DateTime('now');
    }


}