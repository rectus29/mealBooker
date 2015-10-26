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
 * @Table(name="config")
 */
class Config extends DomainObject
{

    /**
     * @Column(type="string")
     * @var String
     */
    private $keyCode;

    /**
     * @Column(type="string")
     * @var String
     */
    private $value;

    /**
     * Config constructor.
     * @param String $key
     * @param String $value
     */
    public function __construct($key, $value)
    {
        $this->keyCode = $key;
        $this->value = $value;
    }

    /**
     * @return String
     */
    public function getKey()
    {
        return $this->keyCode;
    }

    /**
     * @param String $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return String
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param String $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }


    

}