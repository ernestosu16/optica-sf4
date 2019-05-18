<?php

namespace App\Repository;

use App\Entity\AppProducto;
use App\Entity\MovimientoAlmacen\Alamacen;
use App\Entity\SecurityOffice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Alamacen|null find($id, $lockMode = null, $lockVersion = null)
 * @method Alamacen|null findOneBy(array $criteria, array $orderBy = null)
 * @method Alamacen[]    findAll()
 * @method Alamacen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlamacenRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Alamacen::class);
    }

    /**
     * @param AppProducto $producto
     * @param SecurityOffice $office
     * @return Alamacen|null
     */
    public function getProductoOficina(AppProducto $producto, SecurityOffice $office)
    {
        return $this->findOneBy(['producto' => $producto, 'office' => $office]);
    }

    public static function addProductoOficina(int $cantidad, AppProducto $producto, SecurityOffice $office)
    {
        $c = new Alamacen();
        $c->setCantidadExistencia($cantidad);
        $c->setProducto($producto);
        $c->setOffice($office);
        return $c;
    }

    public static function addProductoOficinaPendiente(int $cantidad, AppProducto $producto, SecurityOffice $office)
    {
        $c = new Alamacen();
        $c->setCantidadPendiente($cantidad);
        $c->setProducto($producto);
        $c->setOffice($office);
        return $c;
    }

    // /**
    //  * @return Alamacen[] Returns an array of Alamacen objects
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
    public function findOneBySomeField($value): ?Alamacen
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
