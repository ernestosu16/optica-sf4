<?php

namespace App\Repository;

use App\Entity\SecurityGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SecurityGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method SecurityGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method SecurityGroup[]    findAll()
 * @method SecurityGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SecurityGroupRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SecurityGroup::class);
    }

    // /**
    //  * @return SecurityGroup[] Returns an array of SecurityGroup objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SecurityGroup
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
