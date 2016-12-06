<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * VSCPUnit
 *
 * @ORM\Table(name="vscpmaint_unit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VSCPUnitRepository")
 * @UniqueEntity(fields={"vscpunit", "vscpunittype"}, message="Such unit/type combination already exists.")
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
     * @ORM\Column(name="vscpunit", type="integer")
     * @Assert\NotBlank()
     */
    private $vscpunit;

    /**
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\VSCPType", cascade={"persist"})
    */
    private $vscpunittype;

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

