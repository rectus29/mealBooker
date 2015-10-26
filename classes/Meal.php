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
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity
 * @Table(name="meal")
 */
class Meal extends DomainObject
{
    /**
     * @ManyToOne(targetEntity="Drink")
     * @var Drink
     */
    private $drink;

    /**
     * @ManyToOne(targetEntity="Course")
     * @var Course
     */
    private $course;

    /**
     * @ManyToOne(targetEntity="TimeFrame")
     * @var TimeFrame
     */
    private $timeFrame;

    /**
     * @ManyToOne(targetEntity="User")
     * @var User
     */
    private $user;

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
     * @return TimeFrame
     */
    public function getTimeFrame()
    {
        return $this->timeFrame;
    }

    /**
     * @param TimeFrame $timeFrame
     */
    public function setTimeFrame($timeFrame)
    {
        $this->timeFrame = $timeFrame;
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

    function __toString()
    {
        return '{ "id" :' . self::getId() . ',"course":' . self::getCourse() . $this->getId() . ',"drink":' . self::getDrink()->getId() . ',"timeframe":' . self::getTimeFrame()->getId() . '}';
    }


}