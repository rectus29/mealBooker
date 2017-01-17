<?php
namespace MealBooker\model;
    /*-----------------------------------------------------*/
    /*      _____           _               ___   ___      */
    /*     |  __ \         | |             |__ \ / _ \     */
    /*     | |__) |___  ___| |_ _   _ ___     ) | (_) |    */
    /*     |  _  // _ \/ __| __| | | / __|   / / \__, |    */
    /*     | | \ \  __/ (__| |_| |_| \__ \  / /_   / /     */
    /*     |_|  \_\___|\___|\__|\__,_|___/ |____| /_/      */
    /*                                                     */
    /*                Date: 06/10/2015 11:50               */
    /*                 All right reserved                  */
/*-----------------------------------------------------*/

use DateTime;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity
 * @Table(name="app_course")
 */
class Course extends DomainObject
{

    /**
     * @Column(type="string")
     * @var String
     */
    private $name;

    /**
     * @Column(type="string", length=255, nullable=false)
     * @var String
     */
    private $shortDescription;

    /**
     * @Column(type="string", length=65536, nullable=true)
     * @var String
     */
    private $description;

    /**
     * @Column(type="string", nullable=true)
     * @var String
     */
    private $img;

    /**
     * @Column(type="integer")
     * @var Integer
     */
    private $nbPerDay = 99;

    /**
     * @Column(type="float")
     * @var Float
     */
    private $priceTaxFree;

    /**
     * Course constructor.
     * @param String $name
     * @param String $description
     * @param String $shortDescription
     */
    public function __construct($name = null, $description = null, $shortDescription = null)
    {
        parent::__construct();
        $this->name = $name;
        $this->description = $description;
        $this->shortDescription = $shortDescription;
    }


    /**
     * @return String
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param String $name
     */
    public function setName($name)
    {
        $this->setUpdated(new DateTime());
        $this->name = $name;
    }

    /**
     * @return String
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param String $description
     */
    public function setDescription($description)
    {
        $this->setUpdated(new DateTime());
        $this->description = $description;
    }

    /**
     * @return String
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param String $img
     */
    public function setImg($img)
    {
        $this->img = $img;
    }



    /**
     * @return String
     */
    function __toString()
    {
        return $this->getName();
    }

    /**
     * @return int
     */
    public function getNbPerDay()
    {
        return $this->nbPerDay;
    }

    /**
     * @param int $nbPerDay
     */
    public function setNbPerDay($nbPerDay)
    {
        $this->nbPerDay = $nbPerDay;
    }

    /**
     * @return String
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * @param String $shortDescription
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;
    }

    /**
     * @return float
     */
    public function getPriceTaxFree()
    {
        return $this->priceTaxFree;
    }

    /**
     * @param float $priceTaxFree
     */
    public function setPriceTaxFree($priceTaxFree)
    {
        $this->priceTaxFree = $priceTaxFree;
    }

}