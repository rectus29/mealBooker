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
 * @Table(name="timeframe")
 */
class TimeFrame extends DomainObject
{

    /**
     * @Column(type="string")
     * @var String
     */
    private $start;

    /**
     * @Column(type="string")
     * @var String
     */
    private $stop;

    function __construct($start = null, $stop = null)
    {
        $this->start = $start;
        $this->stop = $stop;
    }


    /**
     * @return String
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param String $start
     */
    public function setStart($start)
    {
        $this->start = $start;
    }

    /**
     * @return String
     */
    public function getStop()
    {
        return $this->stop;
    }

    /**
     * @param String $stop
     */
    public function setStop($stop)
    {
        $this->stop = $stop;
    }
    /**
     * @return string
     */
    function __toString()
    {
        return self::getStart() . " - " . self::getStop();
    }


}