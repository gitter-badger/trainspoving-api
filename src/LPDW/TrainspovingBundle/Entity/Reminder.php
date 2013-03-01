<?php

namespace LPDW\TrainspovingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Reminder
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $arrivalDate;

    /**
     * Alert offset in seconds (i.e. taking in account travel time)
     * 
     * @ORM\Column(type="integer")
     */
    private $leeway;

    /**
     * @ORM\OneToOne(targetEntity="RFID")
     * @ORM\JoinColumn(name="rfid_id", referencedColumnName="id")
     */
    private $rfid;

    public function __construct()
    {
        $this->leeway = 0;
    }

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
     * Set arrivalDate
     *
     * @param \DateTime $arrivalDate
     * @return Reminder
     */
    public function setArrivalDate($arrivalDate)
    {
        $this->arrivalDate = $arrivalDate;
    
        return $this;
    }

    /**
     * Get arrivalDate
     *
     * @return \DateTime 
     */
    public function getArrivalDate()
    {
        return $this->arrivalDate;
    }

    /**
     * Set leeway
     *
     * @param integer $leeway
     * @return Reminder
     */
    public function setLeeway($leeway)
    {
        $this->leeway = $leeway;
    
        return $this;
    }

    /**
     * Get leeway
     *
     * @return integer 
     */
    public function getLeeway()
    {
        return $this->leeway;
    }

    /**
     * Get computed reminder date
     */
    public function getDate()
    {
        if (null === ($arrival = $this->getArrivalDate())) {
            return null;
        }
        $date = clone $arrival;
        $date->modify(sprintf('-%i seconds', $this->getLeeway()));

        return $date;
    }

    /**
     * Set rfid
     *
     * @param \LPDW\TrainspovingBundle\Entity\RFID $rfid
     * @return Reminder
     */
    public function setRfid(\LPDW\TrainspovingBundle\Entity\RFID $rfid = null)
    {
        $this->rfid = $rfid;
    
        return $this;
    }

    /**
     * Get rfid
     *
     * @return \LPDW\TrainspovingBundle\Entity\RFID 
     */
    public function getRfid()
    {
        return $this->rfid;
    }
}