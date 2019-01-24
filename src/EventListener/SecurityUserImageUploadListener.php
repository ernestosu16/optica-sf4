<?php
/**
 * Created by PhpStorm.
 * User: franklin
 * Date: 15/01/2019
 * Time: 15:19
 */

namespace App\EventListener;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use App\Entity\SecurityUser;
use App\Service\FileUploader;


class SecurityUserImageUploadListener
{
    private $uploader;

    public const SECURITY_USER_IMAGE_FOLDER = 'images/security_user/';

    public function __construct(FileUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof SecurityUser) {
            return;
        }

        $fileName = $entity->getImage();

        if ($fileName && file_exists($this->uploader->getTargetDirectory() . $this::SECURITY_USER_IMAGE_FOLDER . $fileName)) {
            $entity->setImage(new File($this->uploader->getTargetDirectory() . $this::SECURITY_USER_IMAGE_FOLDER . $fileName));
        }
    }

    private function uploadFile($entity)
    {
        // upload only works for SecurityUser entities
        if (!$entity instanceof SecurityUser) {
            return;
        }

        $file = $entity->getImage();

        // only upload new files
        if ($file instanceof UploadedFile) {
            $fileName = $this->uploader->upload($file, $this::SECURITY_USER_IMAGE_FOLDER);
            $entity->setImage($fileName);
        } elseif ($file instanceof File) {
            // prevents the full file path being saved on updates
            // as the path is set on the postLoad listener
            $entity->setImage($file->getFilename());
        }
    }


}