<?php

namespace App\Entity;

use App\Application\Sonata\MediaBundle\Entity\Media;
use App\Auditoria\Annotation as Auditar;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Doctrine\ORM\Mapping as ORM;
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\UserBundle\Entity\BaseUser;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\SecurityUserRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=false)
 * @Auditar\Auditar()
 */
class SecurityUser extends BaseUser
{
    use SoftDeleteableEntity;

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

    /**
     * @var string
     * @Assert\Regex(
     *     "/^\d{2}(0?[1-9]|1[012])(0?[1-9]|[12][0-9]|3[01])(\d{5})$/",
     *     message="El número del carnet de identidad no es correcto"
     * )
     * @ORM\Column(type="string", length=11)
     */
    protected $ci;

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

    public function getCi(): ?string
    {
        return $this->ci;
    }

    public function setCi(string $ci): self
    {
        $this->ci = $ci;

        return $this;
    }

}

