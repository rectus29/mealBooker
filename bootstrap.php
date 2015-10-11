<?php
/*-----------------------------------------------------*/
/*      _____           _               ___   ___      */
/*     |  __ \         | |             |__ \ / _ \     */
/*     | |__) |___  ___| |_ _   _ ___     ) | (_) |    */
/*     |  _  // _ \/ __| __| | | / __|   / / \__, |    */
/*     | | \ \  __/ (__| |_| |_| \__ \  / /_   / /     */
/*     |_|  \_\___|\___|\__|\__,_|___/ |____| /_/      */
/*                                                     */
/*                Date: 04/10/2015 17:41                */
/*                 All right reserved                  */
/*-----------------------------------------------------*/

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "config/global.php";
require_once "vendor/autoload.php";

// database configuration parameters
$conn = array(
    'driver' => 'pdo_mysql',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'mealbooker'
);
// obtaining the entity manager
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/class"), DEV_MODE);
$entityManager = EntityManager::create($conn, $config);