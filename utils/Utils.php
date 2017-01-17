<?php
namespace MealBooker\utils;
/*-----------------------------------------------------*/
/*      _____           _               ___   ___      */
/*     |  __ \         | |             |__ \ / _ \     */
/*     | |__) |___  ___| |_ _   _ ___     ) | (_) |    */
/*     |  _  // _ \/ __| __| | | / __|   / / \__, |    */
/*     | | \ \  __/ (__| |_| |_| \__ \  / /_   / /     */
/*     |_|  \_\___|\___|\__|\__,_|___/ |____| /_/      */
/*                                                     */
/*                Date: 13/10/2015 23:07               */
/*                 All right reserved                  */
/*-----------------------------------------------------*/

use DateInterval;
use DateTime;

class Utils {

    /**
     * @var Utils
     */
    private static $ownInstance = null;

    /**
     * Utils constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return $this|Utils
     */
    public static function get()
    {
        if (self::$ownInstance == null)
            self::$ownInstance = new Utils();
        return self::$ownInstance;
    }

    /**
     * format a date
     * @param Datetime $date date to format
     * @param string $format
     * @return String
     */
    public static function formatDate($date, $format = 'd/m/Y'){
        $out ="-";
        setlocale(LC_TIME, "fr_FR");
        if(isset($date) && $date != null)
            if(is_a($date, DateTime::class))
                return $date->format($format);
        //return strftime ('%d %B %Y', $date->getTimestamp() );
        return $out;
    }


    /**
     * @return bool
     */
    public static function  isOrderEnable(){
        //check if system is order enable
        $close = new DateTime();
        $close->setTime(STOPBOOKINGHOUR,STOPBOOKINGMINUTE);
        $open = new DateTime();
        $open->setTime(STARTBOOKINGHOUR,STARTBOOKINGMINUTE);
        if(new DateTime() < $close && new DateTime() > $open )
            return true;
        return false;
    }

    /**
     * generate alphanumeric code
     * @param $codelength int length of string to generate
     * @return string
     */
    public static function generateStringCode($codelength = 24)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $string = '';
        for ($i = 0; $i < $codelength; $i++) {
            $string .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $string;
    }
}