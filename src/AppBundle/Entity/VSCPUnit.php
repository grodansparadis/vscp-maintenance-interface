<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VSCPUnit
 *
 * @ORM\Table(name="vscpmaint_unit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VSCPUnitRepository")
 */
class VSCPUnit
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="vscpunit", type="integer", unique=true)
     */
    private $vscpunit;

    /**
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\VSCPType", cascade={"persist"})
    */
    private $vscpunittype;

    /**
     * @var int
     *
     * @ORM\Column(name="vscpnunit", type="integer")
     */
    private $vscpnunit;

    /**
     * @var string
     *
     * @ORM\Column(name="vscpunitDescription", type="text")
     */
    private $vscpunitDescription;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set vscpunit
     *
     * @param integer $vscpunit
     *
     * @return VSCPUnit
     */
    public function setVscpunit($vscpunit)
    {
        $this->vscpunit = $vscpunit;

        return $this;
    }

    /**
     * Get vscpunit
     *
     * @return int
     */
    public function getVscpunit()
    {
        return $this->vscpunit;
    }

    /**
     * Set vscpunittype
     *
     * @param string $vscpunittype
     *
     * @return VSCPUnit
     */
    public function setVscpunittype($vscpunittype)
    {
        $this->vscpunittype = $vscpunittype;

        return $this;
    }

    /**
     * Get vscpunittype
     *
     * @return string
     */
    public function getVscpunittype()
    {
        return $this->vscpunittype;
    }

    /**
     * Set vscpnunit
     *
     * @param integer $vscpnunit
     *
     * @return VSCPUnit
     */
    public function setVscpnunit($vscpnunit)
    {
        $this->vscpnunit = $vscpnunit;

        return $this;
    }

    /**
     * Get vscpnunit
     *
     * @return int
     */
    public function getVscpnunit()
    {
        return $this->vscpnunit;
    }

    /**
     * Set vscpunitDescription
     *
     * @param string $vscpunitDescription
     *
     * @return VSCPUnit
     */
    public function setVscpunitDescription($vscpunitDescription)
    {
        $this->vscpunitDescription = $vscpunitDescription;

        return $this;
    }

    /**
     * Get vscpunitDescription
     *
     * @return string
     */
    public function getVscpunitDescription()
    {
        return $this->vscpunitDescription;
    }
}

