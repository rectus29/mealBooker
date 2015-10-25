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
    public static function formatDate($date, $format = 'd M Y'){
        $out ="-";
        if(isset($date) && $date != null)
            if(is_a($date, DateTime::class))
                return $date->format($format);
        return $out;
    }
}