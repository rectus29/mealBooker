<?php
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
namespace MealBooker\model;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity
 * @Table(name="app_dessert")
 */
class Dessert extends DomainObject
{

    /**
     * @Column(type="string")
     * @var String
     */
    private $name;

    /**
     * @Column(type="string", length=65536, nullable=true)
     * @var String
     */
    private $description;

    /**
     * @Column(type="integer")
     * @var Integer
     */
    private $nbPerDay = 99;

    function __construct($name = null, $description = null)
    {
        parent::__construct();
        $this->name = $name;
        $this->description = $description;
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
        $this->description = $description;
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
}