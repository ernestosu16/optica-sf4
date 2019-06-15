<?php

namespace App\Repository;

use App\Entity\AppSolicitudTallado;
use App\Entity\SecurityOffice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AppSolicitudTallado|null find($id, $lockMode = null, $lockVersion = null)
 * @method AppSolicitudTallado|null findOneBy(array $criteria, array $orderBy = null)
 * @method AppSolicitudTallado[]    findAll()
 * @method AppSolicitudTallado[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SolicitudTalladoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AppSolicitudTallado::class);
    }

    // /**
    //  * @return AppSolicitudTallado[] Returns an array of AppSolicitudTallado objects
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
    public function findOneBySomeField($value): ?AppSolicitudTallado
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
     * @return mixed
     * @throws NonUniqueResultException
     */
    public function getLastRowForOffice(SecurityOffice $office)
    {
        return $this->createQueryBuilder('a')
            ->join('a.orden_servicio', 'orden_servicio')
            ->andWhere('orden_servicio.office = :office')
            ->setParameter('office', $office)
            ->orderBy('a.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
