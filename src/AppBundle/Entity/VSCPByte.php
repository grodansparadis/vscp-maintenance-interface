<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * VSCPByte
 *
 * @ORM\Table(name="vscpmaint_byte")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VSCPByteRepository")
 * @UniqueEntity(fields={"vscpbyte", "vscpbytetype"}, message="Such byte/type combination already exists.")
 */
class VSCPByte
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
     * @ORM\Column(name="vscpbyte", type="integer")
     * @Assert\NotBlank()
      */
    private $vscpbyte;

    /**
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\VSCPType", cascade={"persist"})
    */
    private $vscpbytetype;

    /**
     * @var int
     *
     * @ORM\Column(name="vscpnbyte", type="integer")
     */
    private $vscpnbyte;

    /**
     * @var string
     *
     * @ORM\Column(name="vscpbyteDescription", type="text")
     */
    private $vscpbyteDescription;


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
     * Set vscpbyte
     *
     * @param integer $vscpbyte
     *
     * @return VSCPByte
     */
    public function setVscpbyte($vscpbyte)
    {
        $this->vscpbyte = $vscpbyte;

        return $this;
    }

    /**
     * Get vscpbyte
     *
     * @return int
     */
    public function getVscpbyte()
    {
        return $this->vscpbyte;
    }

    /**
     * Set vscpnbyte
     *
     * @param integer $vscpnbyte
     *
     * @return VSCPByte
     */
    public function setVscpnbyte($vscpnbyte)
    {
        $this->vscpnbyte = $vscpnbyte;

        return $this;
    }

    /**
     * Get vscpnbyte
     *
     * @return int
     */
    public function getVscpnbyte()
    {
        return $this->vscpnbyte;
    }

    /**
     * Set vscpbyteDescription
     *
     * @param string $vscpbyteDescription
     *
     * @return VSCPByte
     */
    public function setVscpbyteDescription($vscpbyteDescription)
    {
        $this->vscpbyteDescription = $vscpbyteDescription;

        return $this;
    }

    /**
     * Get vscpbyteDescription
     *
     * @return string
     */
    public function getVscpbyteDescription()
    {
        return $this->vscpbyteDescription;
    }

    /**
     * Set vscpbytetype
     *
     * @param \AppBundle\Entity\VSCPType $vscpbytetype
     *
     * @return VSCPByte
     */
    public function setVscpbytetype(\AppBundle\Entity\VSCPType $vscpbytetype = null)
    {
        $this->vscpbytetype = $vscpbytetype;

        return $this;
    }

    /**
     * Get vscpbytetype
     *
     * @return \AppBundle\Entity\VSCPType
     */
    public function getVscpbytetype()
    {
        return $this->vscpbytetype;
    }
}
