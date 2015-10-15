<?php
namespace MealBooker\manager;
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

class SecurityManager
{

    /**
     * @var SecurityManager
     */
    private static $ownInstance = null;

    /**
     * SecurityManager constructor.
     */
    public function __construct()
    {
    }


    /**
     * @return $this|SecurityManager
     */
    public static function get()
    {
        if (self::$ownInstance == null)
            self::$ownInstance = new SecurityManager();
        return self::$ownInstance;
    }

    /**
     * verify if current user is authentify
     * @param $session session to check
     * @return bool
     */
    public function isAuthentified($session)
    {
        if (isset($session['auth']) && $session['auth'] == true)
            return true;
        return false;
    }
}