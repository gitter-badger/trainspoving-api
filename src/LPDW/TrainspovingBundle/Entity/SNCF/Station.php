<?php

namespace LPDW\TrainspovingBundle\Entity\SNCF;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Station
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    private $externalCode;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;


    /**
     * Set externalCode
     *
     * @param string $id
     * @return Station
     */
    public function setExternalCode($externalCode)
    {
        $this->externalCode = $externalCode;
    
        return $this;
    }

    /**
     * Get externalCode
     *
     * @return string 
     */
    public function getExternalCode()
    {
        return $this->externalCode;
    }


    /**
     * Set name
     *
     * @param string $name
     * @return Station
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

}