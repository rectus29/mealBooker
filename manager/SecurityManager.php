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

use Doctrine\ORM\EntityManager;
use MealBooker\model\User;
use MealBooker\models\dao\UserDao;

class SecurityManager
{

    /**
     * @var SecurityManager
     */
    private static $ownInstance = null;

    /**
     * @var EntityManager
     */
    private static $em = null;

    /**
     * @param EntityManager
     * SecurityManager constructor.
     */
    public function __construct($entityManager)
    {
        self::$em = $entityManager;
    }

    /**
     * @return $this|SecurityManager
     */
    public static function get()
    {
        if (self::$ownInstance == null && self::em != null)
            return self::init(self::$em);
        return self::$ownInstance;
    }

    /**
     * @return $this|SecurityManager
     */
    public static function init($em)
    {
        if (self::$ownInstance == null)
            self::$ownInstance = new SecurityManager($em);
        return self::$ownInstance;
    }

    /**
     * verify if current user is authentify
     * @param $session session to check
     * @return bool
     */
    public function isAuthentified($session)
    {
        if (isset($session['auth'])) {
            $userDao = new UserDao(self::$em);
            $user = $userDao->getBySession($session['auth']);
            if ($user != null)
                return true;
        }
        return false;
    }

    /**
     * Check if current user is admin
     * @param $session session to check
     * @return bool
     */
    public function isAdmin($session)
    {
        $user = $this->getCurrentUser($session);
        if ($user != null && $user->getRole() != null)
            return $user->getRole()->isIsAdmin();
        return false;
    }

    /**
     * return current logged user
     * @param $session
     * @return User
     */
    public function getCurrentUser($session)
    {
        $userDao = new UserDao(self::$em);
        if (isset($session['auth'])) {
            $user = $userDao->getBySession($session['auth']);
            if ($user != null)
                return $user;
        }
        return null;
    }

    /**
     * check credential and authenticate user
     * @param $login
     * @param $password
     * @return User
     */
    public function authentificate($login, $password)
    {
        $userDao = new UserDao(self::$em);
        $user = $userDao->getUserByMail($login);
//        var_dump($user);
//        var_dump(self::hashPassword($password, $user->getSalt()));
        if (($user != null && $user->getPassword() === self::hashPassword($password, $user->getSalt())) && $user->getStatus() == 1) {
            $user->setSession(session_id());
            $userDao->save($user);
            $_SESSION['auth'] = session_id();
            return $user;
        } else {
            return null;
        }
    }

    /**
     * return hashed password
     * @param $password
     * @param $salt
     * @return string
     */
    public static function hashPassword($password, $salt)
    {
        return password_hash($password, PASSWORD_BCRYPT, ['salt' => $salt]);
    }

    /**
     * logout user by session id
     * @param $session
     */
    public function logOutUser($session)
    {
        try {
            $userDao = new UserDao(self::$em);
            $user = $this->getCurrentUser($session);

            if ($user != null) {
                $user->setSession('');
                $userDao->save($user);

                return true;
            }
            return false;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

}