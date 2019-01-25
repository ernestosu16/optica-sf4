<?php

namespace App\Entity;

use App\Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\ORM\Mapping as ORM;
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\UserBundle\Entity\BaseUser;


/**
 * @ORM\Entity(repositoryClass="App\Repository\SecurityUserRepository")
 */
class SecurityUser extends BaseUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(name="id", type="guid")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="SecurityOffice")
     * @ORM\JoinColumn(name="office_id", referencedColumnName="id")
     */
    protected $office;

    /**
     * @ORM\ManyToOne(targetEntity="App\Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"})
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="SET NULL")
     */
    protected $media;

    public function __construct()
    {
        parent::__construct();
        $this->enabled = true;
    }

    public function getId(): ?string
    {
        return $this->id;
    }


    /**
     * @param MediaInterface $media
     */
    public function setMedia(MediaInterface $media)
    {
        $this->media = $media;
    }

    /**
     * @return MediaInterface
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @return SecurityOffice
     */
    public function getOffice(): ?SecurityOffice
    {
        return $this->office;
    }

    /**
     * @param SecurityOffice $office
     * @return SecurityUser
     */
    public function setOffice(SecurityOffice $office): SecurityUser
    {
        $this->office = $office;

        return $this;
    }

}

