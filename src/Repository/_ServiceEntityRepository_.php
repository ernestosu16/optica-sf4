<?php


namespace App\Repository;


use App\Entity\SecurityOffice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Cache\Simple\FilesystemCache;


abstract class _ServiceEntityRepository_ extends ServiceEntityRepository
{
    /**
     * @var FilesystemCache
     */
    protected $cache;
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @inheritDoc
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, static::getEntity());
        $this->cache = new FilesystemCache();
        $this->em = $this->getEntityManager();
    }

    /**
     * @return string
     */
    abstract protected static function getEntity();

    /**
     * @return object|null
     */
    public function getLastRow()
    {
        return $this->findOneBy([], ['id' => 'desc']);
    }
}