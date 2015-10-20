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
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity
 * @Table(name="role")
 */
class Role extends DomainObject
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
     * @Column(type="integer")
     * @var Integer
     */
    private $weight = 100;

    /**
     * @Column(type="boolean")
     * @var Boolean
     */
    private $isAdmin = false;

    /**
     * @ManyToMany(targetEntity="Permission")
     * @JoinTable(name="role_permission")
     * @var Permission[]
     */
    private $permissions = array();

    /**
     * @OneToMany(targetEntity="User", mappedBy="role")
     * @var User[]
     */
    private $Users = array();

    /**
     * Role constructor.
     * @param String $name
     * @param String $description
     * @param int $weight
     * @param bool $isAdmin
     * @param Permission[] $permissions
     * @param User[] $Users
     */
    public function __construct($name = null, $description = null, $weight = 0, $isAdmin = false, array $permissions = null, array $Users = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->weight = $weight;
        $this->isAdmin = $isAdmin;
        $this->permissions = ($permissions == null) ? new Permission[] : $permissions;
        $this->Users = ($Users == null) ? new User[] : $Users;
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
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    /**
     * @return boolean
     */
    public function isIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * @param boolean $isAdmin
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }

    /**
     * @return Permission[]
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * @param Permission[] $permissions
     */
    public function setPermissions($permissions)
    {
        $this->permissions = $permissions;
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