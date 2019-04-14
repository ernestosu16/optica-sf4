<?php
/**
 * Created by PhpStorm.
 * User: Carlos
 * Date: 24/02/2017
 * Time: 04:03 PM
 */

namespace  App\Auditoria\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="auditoria_association")
 */
class Association
{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    /**
     * @ORM\Column(length=128)
     */
    private $typ;
    /**
     * @ORM\Column(length=128)
     */
    private $tbl;
    /**
     * @ORM\Column(nullable=true)
     */
    private $label;
    /**
     * @ORM\Column
     */
    private $fk;
    /**
     * @ORM\Column
     */
    private $class;
    public function getId()
    {
        return $this->id;
    }
    public function getTyp()
    {
        return $this->typ;
    }
    public function getTypLabel()
    {
        $words = explode('.', $this->getTyp());
        return implode(' ', array_map('ucfirst', explode('_', end($words))));
    }
    public function getTbl()
    {
        return $this->tbl;
    }
    public function getLabel()
    {
        return $this->label;
    }
    public function getFk()
    {
        return $this->fk;
    }
    public function getClass()
    {
        return $this->class;
    }

    public function setTyp(string $typ): self
    {
        $this->typ = $typ;

        return $this;
    }

    public function setTbl(string $tbl): self
    {
        $this->tbl = $tbl;

        return $this;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function setFk(string $fk): self
    {
        $this->fk = $fk;

        return $this;
    }

    public function setClass(string $class): self
    {
        $this->class = $class;

        return $this;
    }
}