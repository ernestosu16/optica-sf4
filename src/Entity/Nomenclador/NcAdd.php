<?php

namespace App\Entity\Nomenclador;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=false)
 */
class NcAdd extends _NcBase_
{
    public function __toString()
    {
        return (string)"+ " . $this->valor;
    }

    public function getValor(): ?string
    {
        return (double)$this->valor;
    }

    public function setValor(string $valor): _NcBase_
    {
        return parent::setValor((double)$valor);
    }

}