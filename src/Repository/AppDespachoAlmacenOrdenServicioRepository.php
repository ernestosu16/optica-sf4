<?php

namespace App\Repository;

use App\Entity\DespachoAlmacen\AppDespachoAlmacenOrdenServicio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AppDespachoAlmacenOrdenServicio|null find($id, $lockMode = null, $lockVersion = null)
 * @method AppDespachoAlmacenOrdenServicio|null findOneBy(array $criteria, array $orderBy = null)
 * @method AppDespachoAlmacenOrdenServicio[]    findAll()
 * @method AppDespachoAlmacenOrdenServicio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppDespachoAlmacenOrdenServicioRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AppDespachoAlmacenOrdenServicio::class);
    }

    // /**
    //  * @return AppDespachoAlmacenOrdenServicio[] Returns an array of AppDespachoAlmacenOrdenServicio objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AppDespachoAlmacenOrdenServicio
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


}
