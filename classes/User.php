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
    /*                Date: 28/09/2015 17:01                */
    /*                 All right reserved                  */
/*-----------------------------------------------------*/
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity
 * @Table(name="user")
 */
class User extends DomainObject
{
    /**
     * @Column(type="string")
     * @var String
     */
    private $firstName;

    /**
     * @Column(type="string")
     * @var String
     */
    private $lastName;

    /**
     * @Column(type="string")
     * @var String
     */
    private $mail;

    /**
     * @Column(type="string")
     * @var String
     */
    private $salt;

    /**
     * @Column(type="string")
     * @var String
     */
    private $password;

    /**
     * @Column(type="string")
     * @var String
     */
    private $phoneNumber;

    /**
     * @ManyToOne(targetEntity="Role")
     * @var Role
     */
    private $role;

    /**
     * @ManyToOne(targetEntity="Company")
     * @var Company
     */
    private $company;

    /**
     * @OneToMany(mappedBy="user", targetEntity="Meal")
     * @var Meal[]
     */
    private $meals;

    /**
     * @Column(type="boolean")
     * @var bool
     */
    private $optIn = false;

    /**
     * @Column(type="string")
     * @var string
     */
    private $session = false;

    /**
     * User constructor.
     * @param String $firstName
     * @param String $lastName
     * @param String $mail
     * @param String $salt
     * @param String $password
     * @param String $phoneNumber
     * @param Role $role
     * @param Company $company
     * @param bool $optIn
     */
    public function __construct($firstName = null, $lastName = null, $mail = null, $salt = null, $password = null, $phoneNumber = null, Role $role = null, Company $company = null, $optIn = false)
    {
        $this->created = new \DateTime();
        $this->updated = new \DateTime();
        $this->status = 1;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->mail = $mail;
        $this->salt = ($salt == null) ? uniqid(mt_rand(), true) : $salt;
        $this->password = $password;
        $this->phoneNumber = $phoneNumber;
        $this->role = $role;
        $this->company = $company;
        $this->optIn = $optIn;
    }


    /**
     * @return String
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param String $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return String
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param String $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return String
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param String $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return String
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param String $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * @return String
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param String $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return String
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param String $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return Role
     */
    public function getRole()
    {
        if (isset($this->role))
            return $this->role;
        return null;
    }

    /**
     * @param Role $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param Company $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @return boolean
     */
    public function isOptIn()
    {
        return $this->optIn;
    }

    /**
     * @param boolean $optIn
     */
    public function setOptIn($optIn)
    {
        $this->optIn = $optIn;
    }

    /**
     * @return Meal[]
     */
    public function getMeals()
    {
        return $this->meals;
    }

    /**
     * @param Meal[] $meals
     */
    public function setMeals($meals)
    {
        $this->meals = $meals;
    }

    /**
     * @return string
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @param string $session
     */
    public function setSession($session)
    {
        $this->session = $session;
    }

    /**
     * return name formatted
     * @return string
     */
    public function getFormattedName()
    {
        $out = null;
        if($this->getFirstName() != null)
            $out = $this->getFirstName() ." ";
        return $this->getFirstName() . " " . $this->getLastName();
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        if ($this->getRole() != null)
            return $this->getRole()->isIsAdmin();
        return false;
    }

}