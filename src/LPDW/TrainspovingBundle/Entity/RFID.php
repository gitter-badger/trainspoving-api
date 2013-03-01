<?php

namespace LPDW\TrainspovingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @UniqueEntity("id")
 */
class RFID
{
    const TYPE_NONE     = null;
    const TYPE_FLAT     = 'flat';
    const TYPE_NANOZTAG = 'nanoztag';
    const TYPE_ZTAMPS   = 'ztamps';

    const COLOR_NONE      = null;
    const COLOR_RED       = 'red';
    const COLOR_BLUE      = 'blue';
    const COLOR_GREEN     = 'green';
    const COLOR_YELLOW    = 'yellow';
    const COLOR_PINK      = 'pink';
    const COLOR_BLACK     = 'black';
    const COLOR_GREY      = 'grey';
    const COLOR_ORANGE    = 'orange';
    const COLOR_PURPLE    = 'purple';
    const COLOR_WHITE     = 'white';
    const COLOR_DARK_RED  = 'dark_red';
    const COLOR_DARK_BLUE = 'dark_blue';

    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=16)
     * @Assert\NotBlank
     */
    private $id;

    /**
     * @ORM\Column(nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(nullable=true)
     */
    private $color;

    /**
     * Set id
     *
     * @param string $id
     * @return RFID
     */
    public function setId($id)
    {
        $this->id = $id;
    
        return $this;
    }

    /**
     * Get id
     *
     * @return string 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return RFID
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set color
     *
     * @param string $color
     * @return RFID
     */
    public function setColor($color)
    {
        $this->color = $color;
    
        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }
}