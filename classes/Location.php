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

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity
 * @Table(name="app_location")
 */
class Location extends DomainObject
{

    /**
     * @Column(type="string")
     * @var String
     */
    private $name;

    /**
     * @Column(type="decimal", nullable=true)
     * @var Number
     */
    private $lat;


    /**
     * @Column(type="decimal", nullable=true)
     * @var Number
     */
    private $lng;

    function __construct($name = null)
    {
        parent::__construct();
        $this->name = $name;
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
     * @return Number
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param Number $lat
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    /**
     * @return Number
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * @param Number $lng
     */
    public function setLng($lng)
    {
        $this->lng = $lng;
    }

    /**
     * @return string
     */
    function __toString()
    {
        return self::getName();
    }


}