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
}