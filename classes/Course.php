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
 * @Table(name="course")
 */
class Course extends DomainObject
{

    /**
     * @Column(type="string")
     * @var String
     */
    private $name;

    /**
     * @Column(type="string")
     * @var String
     */
    private $description;

    /**
     * Course constructor.
     * @param String $name
     * @param String $description
     */
    public function __construct($name, $description)
    {
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



}