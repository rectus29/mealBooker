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

use MealBooker\model\User;
use MealBooker\models\dao\UserDao;

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
        if (isset($session['auth']) && $session['auth'] === true)
            return true;
        return false;
    }

    /**
     * Check if current user is admin
     * @param $session session to check
     * @return bool
     */
    public function isAdmin($session)
    {
        return true;
    }

    /**
     * check credential and authenticate user
     * @param $login
     * @param $password
     * @return bool
     */
    public function authentificate($login, $password)
    {
        $userDao = new UserDao($em);
        $user = $userDao->getUserByMail($login);
        if ($user != null && $user->getPassword() === $password) {
            //TODO salt password
            $_SESSION['auth'] = true;
            return true;
        } else {
            return false;
        }
    }

    /**
     * return current logged user
     * @param $session
     * @return User
     */
    public function getCurrentUser($session)
    {
        $user = new User();
        if ($user != null)
            return $user;
        return null;
    }
}