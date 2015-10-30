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

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use MealBooker\manager\MailManager;
use MealBooker\manager\SecurityManager;
use MealBooker\model;
use MealBooker\models\dao\GenericDAO;

session_start();
define('APP_PATH',  '/reservresto/');
define('WEB_PATH',  APP_PATH.'web/');
define('SERVER_URL',  'http://127.0.0.1');
define('LIB_DIR',  dirname(__FILE__).'/../lib/');
define('CFG_DIR',  dirname(__FILE__).'/');
define('CSS_DIR',  dirname(__FILE__).'/../css/');
define('WEB_DIR',  dirname(__FILE__).'/../web/');
define('HTML_DIR', dirname(__FILE__).'/../html/');
define('ROOT_DIR', dirname(__FILE__).'/../');
define('FILE_DIR', ROOT_DIR . '/files/');
define('DEV_MODE', true);

if(!file_exists(FILE_DIR)){
    mkdir(FILE_DIR);
}
require_once ROOT_DIR."/vendor/autoload.php";

// database configuration parameters
$conn = array(
    'driver' => 'pdo_mysql',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'mealbooker'
);
//mailerconfig
$mailConfig = [
    'serversmtp' => 'SSL0.OVH.NET',
    'SMTPAuth' => true,
    'Username' => 'contact@aurore-traiteur.fr',
    'Password' => 'pass4CONTACT',
    'SMTPSecure' => 'ssl',
    'Port' => 465,
    'from' => 'contact@aurore-traiteur.fr'
];
// obtaining the entity manager
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/../classes/"), DEV_MODE);
$em = EntityManager::create($conn, $config);
$securityMananger = SecurityManager::init($em);
$mailManager = MailManager::init($em, $mailConfig);
$gDao = new GenericDAO($em);

return ConsoleRunner::createHelperSet($em);



