<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VSCPClass
 *
 * @ORM\Table(name="vscpmaint_class")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VSCPClassRepository")
 */
class VSCPClass
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
     * @ORM\Column(name="vscpclass", type="integer", unique=true)
     */
    private $vscpclass;

    /**
     * @var string
     *
     * @ORM\Column(name="vscpclass_name", type="string", length=255)
     */
    private $vscpclassName;

    /**
     * @var string
     *
     * @ORM\Column(name="vscpclass_token", type="string", length=255, unique=true)
     */
    private $vscpclassToken;

    /**
     * @var string
     *
     * @ORM\Column(name="vscpclass_description", type="text")
     */
    private $vscpclassDescription;




    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set vscpclass
     *
     * @param integer $vscpclass
     *
     * @return VSCPClass
     */
    public function setVscpclass($vscpclass)
    {
        $this->vscpclass = $vscpclass;

        return $this;
    }

    /**
     * Get vscpclass
     *
     * @return integer
     */
    public function getVscpclass()
    {
        return $this->vscpclass;
    }

    /**
     * Set vscpclassName
     *
     * @param string $vscpclassName
     *
     * @return VSCPClass
     */
    public function setVscpclassName($vscpclassName)
    {
        $this->vscpclassName = $vscpclassName;

        return $this;
    }

    /**
     * Get vscpclassName
     *
     * @return string
     */
    public function getVscpclassName()
    {
        return $this->vscpclassName;
    }

    /**
     * Set vscpclassToken
     *
     * @param string $vscpclassToken
     *
     * @return VSCPClass
     */
    public function setVscpclassToken($vscpclassToken)
    {
        $this->vscpclassToken = $vscpclassToken;

        return $this;
    }

    /**
     * Get vscpclassToken
     *
     * @return string
     */
    public function getVscpclassToken()
    {
        return $this->vscpclassToken;
    }

    /**
     * Set vscpclassDescription
     *
     * @param string $vscpclassDescription
     *
     * @return VSCPClass
     */
    public function setVscpclassDescription($vscpclassDescription)
    {
        $this->vscpclassDescription = $vscpclassDescription;

        return $this;
    }

    /**
     * Get vscpclassDescription
     *
     * @return string
     */
    public function getVscpclassDescription()
    {
        return $this->vscpclassDescription;
    }
}
