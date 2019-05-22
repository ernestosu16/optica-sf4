<?php

namespace App\Repository;

use App\Entity\MovimientoAlmacen\InformeRecepcionOptica;
use App\Entity\SecurityOffice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method InformeRecepcionOptica|null find($id, $lockMode = null, $lockVersion = null)
 * @method InformeRecepcionOptica|null findOneBy(array $criteria, array $orderBy = null)
 * @method InformeRecepcionOptica[]    findAll()
 * @method InformeRecepcionOptica[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InformeRecepcionOpticaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InformeRecepcionOptica::class);
    }

    // /**
    //  * @return InformeRecepcionOptica[] Returns an array of InformeRecepcionOptica objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InformeRecepcionOptica
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    /**
     * @param SecurityOffice $office
     * @return InformeRecepcionOptica[]
     */
    public function obtenerFacturaAsignadaOficina(SecurityOffice $office)
    {
        return $this->findBy(['office_destino' => $office, 'confirmado' => false, 'pendiente' => false, 'devuelto' => false]);
    }

    /**
     * @return InformeRecepcionOptica[]
     */
    public function obtenerFacturaPendienteEconomico()
    {
        return $this->findAll();
    }

    public function getLastRow()
    {
        return $this->findOneBy([], ['id' => 'desc']);

    }

    /**
     * @param SecurityOffice $office
     * @return InformeRecepcionOptica|mixed|null
     * @throws NonUniqueResultException
     */
    public function getOfficeLastRow(SecurityOffice $office)
    {

        return $this->createQueryBuilder('i')
            ->where('i.office_destino = :office')
            ->andWhere('i.numero_informe_recepcion is not null')
            ->setParameter('office', $office)
            ->orderBy('i.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
