<?php
/*-----------------------------------------------------*/
/*      _____           _               ___   ___      */
/*     |  __ \         | |             |__ \ / _ \     */
/*     | |__) |___  ___| |_ _   _ ___     ) | (_) |    */
/*     |  _  // _ \/ __| __| | | / __|   / / \__, |    */
/*     | | \ \  __/ (__| |_| |_| \__ \  / /_   / /     */
/*     |_|  \_\___|\___|\__|\__,_|___/ |____| /_/      */
/*                                                     */
/*                Date: 23/09/2015                     */
/*                 All right reserved                  */
/*-----------------------------------------------------*/

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use MealBooker\manager\MailManager;
use MealBooker\manager\SecurityManager;
use MealBooker\model;
use MealBooker\models\dao\ConfigDao;
use MealBooker\models\dao\GenericDao;

//enable devmode
define('DEV_MOD', true);
error_reporting(E_ALL);

session_start();
if (DEV_MOD) {
    define('APP_PATH', '/mealBooker/');
    define('SERVER_URL', 'http://127.0.0.1');
    define('ADMINMAIL', 'contact@alexandrebernard.fr');
} else {
    define('APP_PATH', '/');
    define('SERVER_URL', '');
    define('ADMINMAIL', 'aurore-traiteur@orange.fr');
}
/** SYSTEM CONSTANT */
define('WEB_PATH', APP_PATH . 'web/');
define('LIB_DIR', dirname(__FILE__) . '/../lib/');
define('CFG_DIR', dirname(__FILE__) . '/');
define('CSS_DIR', dirname(__FILE__) . '/../css/');
define('WEB_DIR', dirname(__FILE__) . '/../web/');
define('HTML_DIR', dirname(__FILE__) . '/../html/');
define('ROOT_DIR', dirname(__FILE__) . '/../');
define('FILE_DIR', ROOT_DIR . '/files/');

/** USEFULL CONSTANT */
define('STOPBOOKINGHOUR', 18);
define('STOPBOOKINGMINUTE', 00);
define('STARTBOOKINGHOUR', 07);
define('STARTBOOKINGMINUTE', 00);

if (!file_exists(FILE_DIR)) {
    mkdir(FILE_DIR);
}
require_once ROOT_DIR . "/vendor/autoload.php";

// database configuration parameters
$devConn = array(
    'driver' => 'pdo_mysql',
    'user' => 'root',
    'password' => '',
    'dbname' => 'mealbooker',
    'charset' => 'utf8',
);
$conn = array(
    'driver' => 'pdo_mysql',
    'host' => '',
    'user' => '',
    'password' => '',
    'dbname' => '',
    'charset' => 'utf8',
);

//mailerconfig
$mailConfig = [
    'serversmtp' => 'SSL0.OVH.NET',
    'SMTPAuth' => true,
    'Username' => '',
    'Password' => '',
    'SMTPSecure' => 'ssl',
    'Port' => 465,
    'from' => 'contact@aurore-traiteur.fr'
];
// obtaining the entity manager
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/../classes/"), true);
$em = EntityManager::create((DEV_MOD) ? $devConn : $conn, $config);
$securityMananger = SecurityManager::init($em);
$mailManager = MailManager::init($em, $mailConfig);
$gDao = new GenericDao($em);
$configDao = new ConfigDao($em);

