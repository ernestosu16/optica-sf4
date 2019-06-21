<?php


namespace App\Repository;


use App\Entity\AppOrdenServicio;
use App\Entity\SecurityOffice;

class OrdenServicioRepository extends _ServiceEntityRepository_
{
    /**
     * @return string
     */
    protected static function getEntity()
    {
        return AppOrdenServicio::class;
    }


    /**
     * @param SecurityOffice $office
     * @return object|null
     */
    public function getLastRowForOffice(SecurityOffice $office)
    {
        return $this->findOneBy(['office' => $office], ['id' => 'desc']);
    }

    public function listaOrdenServicioNoDespacho(SecurityOffice $office)
    {
        return $this
            ->createQueryBuilder('i')
            ->leftJoin('i.despacho_almacen_orden_servicio', 'despacho_almacen_orden_servicio')
            ->where('despacho_almacen_orden_servicio.id is null')
            ->andWhere('i.office = :office')
            ->setParameter('office', $office->getId())
            ->getQuery()->getResult();

    }
}