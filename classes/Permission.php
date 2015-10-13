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
/*                Date: 28/09/2015 17:01               */
/*                 All right reserved                  */
/*-----------------------------------------------------*/

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity
 * @Table(name="permission")
 */
class Permission extends DomainObject
{
    /**
     * @Column(type="string")
     * @var String
     */
    private $codeString;

    /**
     * @Column(type="string")
     * @var String
     */
    private $description;

    /**
     * Permission constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return String
     */
    public function getCodeString()
    {
        return $this->codeString;
    }

    /**
     * @param String $codeString
     */
    public function setCodeString($codeString)
    {
        $this->codeString = $codeString;
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