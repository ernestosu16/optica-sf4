<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\UserBundle\Entity\BaseUser;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass="App\Repository\SecurityUserRepository")
 *
 * @Vich\Uploadable
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

    public function getId(): ?string
    {
        return $this->id;
    }

    //---------------------------------------------------------

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="security_user_image", fileNameProperty="image.name", size="image.size", mimeType="image.mimeType", originalName="image.originalName", dimensions="image.dimensions")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Embedded(class="Vich\UploaderBundle\Entity\File")
     *
     * @var EmbeddedFile
     */
    private $image;

    public function __construct()
    {
        parent::__construct();
        $this->image = new EmbeddedFile();
        $this->enabled = true;
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


    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|UploadedFile $imageFile
     * @throws \Exception
     */
    public function setImageFile(?File $imageFile = null)
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImage(EmbeddedFile $image)
    {
        $this->image = $image;
    }

    public function getImage(): ?EmbeddedFile
    {
        return $this->image;
    }
}

