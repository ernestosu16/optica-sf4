<?php

namespace App\Repository;

use App\Entity\SecurityOffice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SecurityOffice|null find($id, $lockMode = null, $lockVersion = null)
 * @method SecurityOffice|null findOneBy(array $criteria, array $orderBy = null)
 * @method SecurityOffice[]    findAll()
 * @method SecurityOffice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SecurityOfficeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SecurityOffice::class);
    }

    // /**
    //  * @return Oficina[] Returns an array of Oficina objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Oficina
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
