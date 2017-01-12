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
use DateTime;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity
 * @Table(name="app_user")
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
     * @Column(type="string",unique=true)
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
     * @Column(type="string", nullable=true)
     * @var String
     */
    private $company;

    /**
     * @OneToMany(mappedBy="user", targetEntity="MealOrder")
     * @var MealOrder[]
     */
    private $orders;

    /**
     * @OneToMany(mappedBy="user", targetEntity="Address",cascade={"persist"})
     * @var Address[]
     */
    private $address = array();

    /**
     * @Column(type="boolean")
     * @var bool
     */
    private $optIn = false;

    /**
     * @Column(type="string", nullable=true)
     * @var string
     */
    private $session;

    /**
     * @Column(type="string", nullable=true)
     * @var string
     */
    private $restoreToken;


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
    public function __construct($firstName = null, $lastName = null, $mail = null, $salt = null, $password = null, $phoneNumber = null, Role $role = null, $company = null, $optIn = false, $address = null)
    {
        parent::__construct();
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->mail = $mail;
        $this->salt = ($salt == null) ? str_replace('+', '.', base64_encode(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM))) : $salt;
        $this->password = $password;
        $this->phoneNumber = $phoneNumber;
        $this->role = $role;
        $this->company = $company;
        $this->optIn = $optIn;
        $this->address->add(($address == null)?new Address():$address);
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
        $this->setUpdated(new DateTime());
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
        $this->setUpdated(new DateTime());
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
        $this->setUpdated(new DateTime());
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
        $this->setUpdated(new DateTime());
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
        $this->setUpdated(new DateTime());
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
        $this->setUpdated(new DateTime());
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
        $this->setUpdated(new DateTime());
        $this->role = $role;
    }

    /**
     * @return String
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param String $company
     */
    public function setCompany($company)
    {
        $this->setUpdated(new DateTime());
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
        $this->setUpdated(new DateTime());
        $this->optIn = $optIn;
    }

    /**
     * @return MealOrder[]
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * @param MealOrder[] $order
     */
    public function setOrders($order)
    {
        $this->setUpdated(new DateTime());
        $this->orders = $order;
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
        $this->setUpdated(new DateTime());
        $this->session = $session;
    }

    /**
     * @return string
     */
    public function getRestoreToken()
    {
        return $this->restoreToken;
    }

    /**
     * @param string $restoreToken
     */
    public function setRestoreToken($restoreToken)
    {
        $this->setUpdated(new DateTime());
        $this->restoreToken = $restoreToken;
    }



    /**
     * return name formatted
     * @return string
     */
    public function getFormattedName()
    {
        $out = null;
        if ($this->getFirstName() != null)
            $out = $this->getFirstName() . " ";
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

    /**
     * @return Address[]
     */
    public function getAllAdress()
    {
        return $this->address;
    }

    /**
     * @param Address[] $adresses
     */
    public function setAdresses($adresses)
    {
        $this->address = $adresses;
    }

    /**
     * return the first address of the address book
     * @return Address|null
     */
    public function getAddress()
    {
        if (!empty($this->address)) {
            return $this->address->get(0);
        }
        return null;
    }

    public function addAddress($address)
    {
        $this->address->add($address);
        return $this->address;
    }



}