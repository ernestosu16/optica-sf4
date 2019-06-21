<?php

namespace App\Repository;

use App\Entity\DespachoAlmacen\AppDespachoAlmacen;
use App\Entity\SecurityOffice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AppDespachoAlmacen|null find($id, $lockMode = null, $lockVersion = null)
 * @method AppDespachoAlmacen|null findOneBy(array $criteria, array $orderBy = null)
 * @method AppDespachoAlmacen[]    findAll()
 * @method AppDespachoAlmacen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppDespachoAlmacenRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AppDespachoAlmacen::class);
    }

    // /**
    //  * @return AppDespachoAlmacen[] Returns an array of AppDespachoAlmacen objects
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
    public function findOneBySomeField($value): ?AppDespachoAlmacen
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @param SecurityOffice $office
     * @return AppDespachoAlmacen|mixed|null
     * @throws NonUniqueResultException
     */
    public function getOfficeLastRow(SecurityOffice $office)
    {

        return $this->createQueryBuilder('i')
            ->where('i.office = :office')
            ->setParameter('office', $office)
            ->andWhere('i.numero is not null')
            ->orderBy('i.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
