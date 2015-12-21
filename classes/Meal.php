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

use DateTime;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity
 * @Table(name="app_meal")
 */
class Meal extends DomainObject
{
    /**
     * @Column
     * @var string
     */
    private $bookingId;

    /**
     * @ManyToOne(targetEntity="Drink")
     * @var Drink
     */
    private $drink;

    /**
     * @ManyToOne(targetEntity="Dessert")
     * @var Dessert
     */
    private $dessert;

    /**
     * @ManyToOne(targetEntity="Course")
     * @var Course
     */
    private $course;

    /**
     * @ManyToOne(inversedBy="meals", targetEntity="MealOrder")
     * @var MealOrder
     */
    private $order;

    /**
     * Meal constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * @return Drink
     */
    public function getDrink()
    {
        return $this->drink;
    }

    /**
     * @param Drink $drink
     */
    public function setDrink($drink)
    {
        $this->drink = $drink;
    }

    /**
     * @return Course
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * @param Course $course
     */
    public function setCourse($course)
    {
        $this->course = $course;
    }


    /**
     * @return User
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param MealOrder $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return string
     */
    public function getBookingId()
    {
        return $this->bookingId;
    }

    /**
     * @param string $bookingId
     */
    public function setBookingId($bookingId)
    {
        $this->bookingId = $bookingId;
    }

    /**
     * @return Dessert
     */
    public function getDessert()
    {
        return $this->dessert;
    }

    /**
     * @param Dessert $dessert
     */
    public function setDessert($dessert)
    {
        $this->dessert = $dessert;
    }

    function __toString()
    {
        return '{ "id" :' . self::getId() . ',"course":' . self::getCourse() . $this->getId() . ',"drink":' . self::getDrink()->getId() . '}';
    }


}