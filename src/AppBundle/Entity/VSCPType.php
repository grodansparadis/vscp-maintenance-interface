<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VSCPType
 *
 * @ORM\Table(name="vscpmaint_type")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VSCPTypeRepository")
 */
class VSCPType
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
     * @ORM\Column(name="vscptype", type="integer", unique=true)
     */
    private $vscptype;

    /**
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\VSCPClass", cascade={"persist"})
    */
    private $vscpclass;

    /**
     * @var string
     *
     * @ORM\Column(name="vscptype_description", type="text")
     */
    private $vscptypeDescription;


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
     * Set vscptype
     *
     * @param integer $vscptype
     *
     * @return VSCPType
     */
    public function setVscptype($vscptype)
    {
        $this->vscptype = $vscptype;

        return $this;
    }

    /**
     * Get vscptype
     *
     * @return int
     */
    public function getVscptype()
    {
        return $this->vscptype;
    }

    /**
     * Set vscpclass
     *
     * @param integer $vscpclass
     *
     * @return VSCPType
     */
    public function setVscpclass($vscpclass)
    {
        $this->vscpclass = $vscpclass;

        return $this;
    }

    /**
     * Get vscpclass
     *
     * @return int
     */
    public function getVscpclass()
    {
        return $this->vscpclass;
    }

    /**
     * Set vscptypeDescription
     *
     * @param string $vscptypeDescription
     *
     * @return VSCPType
     */
    public function setVscptypeDescription($vscptypeDescription)
    {
        $this->vscptypeDescription = $vscptypeDescription;

        return $this;
    }

    /**
     * Get vscptypeDescription
     *
     * @return string
     */
    public function getVscptypeDescription()
    {
        return $this->vscptypeDescription;
    }
}

