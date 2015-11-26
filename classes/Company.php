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
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use MealBooker\manager\SecurityManager;

/**
 * @Entity
 * @Table(name="app_company")
 */
class Company extends DomainObject
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
    private $validationCode;

    /**
     * @OneToMany(targetEntity="User", mappedBy="company")
     * @var User[]
     */
    private $Users;

    /**
     * Company constructor.
     * @param String $name
     * @param String $validationCode
     * @param User[] $Users
     */
    public function __construct($name = null, $validationCode = null, array $Users = null)
    {
        parent::__construct();
        $this->name = $name;
        $this->validationCode = ($validationCode = null )? SecurityManager::get()->generateStringCode() :$validationCode;
        $this->Users = ($Users == null) ? array() : $Users;
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
    public function getValidationCode()
    {
        return $this->validationCode;
    }

    /**
     * @param String $validationCode
     */
    public function setValidationCode($validationCode)
    {
        $this->validationCode = $validationCode;
    }

    /**
     * @return User[]
     */
    public function getUsers()
    {
        return $this->Users;
    }

    /**
     * @param User[] $Users
     */
    public function setUsers($Users)
    {
        $this->Users = $Users;
    }


}