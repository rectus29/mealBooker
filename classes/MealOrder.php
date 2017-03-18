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
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity
 * @Table(name="app_mealorder")
 */
class MealOrder extends DomainObject
{
    /**
     * @OneToMany(mappedBy="order", targetEntity="Meal", cascade={"persist"})
     * @var Meal[]
     */
    private $meals;

    /**
     * @ManyToOne(inversedBy="orders", targetEntity="User")
     * @var User
     */
    private $user;

    /**
     * @ManyToOne(targetEntity="Address")
     * @JoinColumn(name="address_id", referencedColumnName="id", nullable=false)
     * @var Address
     */
    private $address;

    /**
     * @Column(type="datetime")
     * @var DateTime
     */
    private $deliveryDate;

    /**
     * return the id formatted for display
     * @return string
     */
    public function getFormattedID(){
        return sprintf("%04s", $this->getId());
    }

    /**
     * Meal constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->meals = array();
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
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param Address $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return DateTime
     */
    public function getDeliveryDate()
    {
        return $this->deliveryDate;
    }

    /**
     * @param DateTime $deliveryDate
     */
    public function setDeliveryDate($deliveryDate)
    {
        $this->deliveryDate = $deliveryDate;
    }
}