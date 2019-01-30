<?php

namespace App\Admin;

use Sonata\AdminBundle\Object\Metadata;
use Sonata\AdminBundle\Object\MetadataInterface;
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Provider\MediaProviderInterface;

class MediaAdmin extends \Sonata\MediaBundle\Admin\ORM\MediaAdmin
{


    /**
     * @param $object MediaInterface
     * @return MetadataInterface
     */
    public function getObjectMetadata($object)
    {
        $provider = $this->pool->getProvider($object->getProviderName());

        $url = $provider->generatePublicUrl(
            $object,
            $provider->getFormatName($object, MediaProviderInterface::FORMAT_ADMIN)
        );

        return new Metadata($object->getName(), $object->getDescription(), $url);
    }
}