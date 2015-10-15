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
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity
 * @Table(name="meal")
 */
class Meal extends DomainObject
{

    /**
     * @Column(type="string")
     * @var String
     */
    private $name;

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

}