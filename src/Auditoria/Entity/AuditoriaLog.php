<?php
namespace  App\Auditoria\Entity;
/**
 * Created by PhpStorm.
 * User: Carlos
 * Date: 24/02/2017
 * Time: 04:00 PM
 */


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="auditoria_log")
 */

class AuditoriaLog
{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    /**
     * @ORM\Column(length=12)
     */
    private $action;
    /**
     * @ORM\Column(length=128)
     */
    private $tbl;

    /**
     * @ORM\Column(length=128)
     */
    private $ip;

    /**
     * @ORM\OneToOne(targetEntity="App\Auditoria\Entity\Association")
     * @ORM\JoinColumn(nullable=false)
     */
    private $source;
    /**
     * @ORM\OneToOne(targetEntity="App\Auditoria\Entity\Association")
     */
    private $target;
    /**
     * @ORM\OneToOne(targetEntity="App\Auditoria\Entity\Association")
     */
    private $blame;

    /**
     * @ORM\OneToOne(targetEntity="App\Auditoria\Entity\Association")
     */
    private $blame_impersonate;

    
    /**
     *
     */
    /**
     * @ORM\Column(type="json_array", nullable=true)
     */
    private $diff;
    /**
     * @ORM\Column(type="datetime")
     */
    private $loggedAt;
    public function getId()
    {
        return $this->id;
    }
    public function getAction()
    {
        return $this->action;
    }
    public function getTbl()
    {
        return $this->tbl;
    }
    public function getSource()
    {
        return $this->source;
    }
    public function getTarget()
    {
        return $this->target;
    }
    public function getBlame()
    {
        return $this->blame;
    }
    public function getDiff()
    {
        return $this->diff;
    }
    public function getLoggedAt()
    {
        return $this->loggedAt;
    }

    public function __toString()
    {
        $label = ($this->getSource()->getLabel()) ? " : ".$this->getSource()->getLabel() : "";
        return $this->getSource()->getTypLabel()." ".$label;
    }

    /**
     * Set action
     *
     * @param string $action
     *
     * @return AuditoriaLog
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Set tbl
     *
     * @param string $tbl
     *
     * @return AuditoriaLog
     */
    public function setTbl($tbl)
    {
        $this->tbl = $tbl;

        return $this;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return AuditoriaLog
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set diff
     *
     * @param array $diff
     *
     * @return AuditoriaLog
     */
    public function setDiff($diff)
    {
        $this->diff = $diff;

        return $this;
    }

    /**
     * Set loggedAt
     *
     * @param \DateTime $loggedAt
     *
     * @return AuditoriaLog
     */
    public function setLoggedAt($loggedAt)
    {
        $this->loggedAt = $loggedAt;

        return $this;
    }

    /**
     * Set source
     *
     * @param \App\Auditoria\Entity\Association $source
     *
     * @return AuditoriaLog
     */
    public function setSource(\App\Auditoria\Entity\Association $source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Set target
     *
     * @param \App\Auditoria\Entity\Association $target
     *
     * @return AuditoriaLog
     */
    public function setTarget(\App\Auditoria\Entity\Association $target = null)
    {
        $this->target = $target;

        return $this;
    }

    /**
     * Set blame
     *
     * @param \App\Auditoria\Entity\Association $blame
     *
     * @return AuditoriaLog
     */
    public function setBlame(\App\Auditoria\Entity\Association $blame = null)
    {
        $this->blame = $blame;

        return $this;
    }

    /**
     * Set blameImpersonate
     *
     * @param \App\Auditoria\Entity\Association $blameImpersonate
     *
     * @return AuditoriaLog
     */
    public function setBlameImpersonate(\App\Auditoria\Entity\Association $blameImpersonate = null)
    {
        $this->blame_impersonate = $blameImpersonate;

        return $this;
    }

    /**
     * Get blameImpersonate
     *
     * @return \App\Auditoria\Entity\Association
     */
    public function getBlameImpersonate()
    {
        return $this->blame_impersonate;
    }
}
