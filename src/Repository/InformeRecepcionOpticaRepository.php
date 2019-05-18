<?php

namespace App\Repository;

use App\Entity\MovimientoAlmacen\InformeRecepcionOptica;
use App\Entity\SecurityOffice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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
        return $this->findBy(['pendiente' => true, 'devuelto' => false]);
    }

    public function getLastRow()
    {
        return $this->findOneBy([], ['id' => 'desc']);

    }
}
