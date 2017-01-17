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

use MealBooker\manager\SecurityManager;
use MealBooker\model;
use MealBooker\models\dao\ConfigDao;

error_reporting(E_ALL);

require_once('../config/global.php');
require_once('../vendor/phpmailer/phpmailer/PHPMailerAutoload.php');

$configDao = new ConfigDao($em);

//here check connection to dbserver
$maintenance = !$em->getConnection()->ping();

//check maintenance mod
if ($configDao->getByKey('serverState') != null && $configDao->getByKey('serverState')->getValue() == '0' && !SecurityManager::get()->isAdmin($_SESSION))
    $maintenance = true;
?>
    <!DOCTYPE html>
    <html>
    <?php
    include 'head.php';
    ?>
    <body>
    <?php
    include 'header.php';
    ?>
    <div class="main container">
        <div class="row">
            <?php

                if($maintenance && !SecurityManager::get()->isAdmin($_SESSION)){
                    include 'security/maintenance.php';
                } else if(isset($_GET['page'])){
                    switch ($_GET['page']) {
                        case 'meal':
                            include 'meal.php';
                            break;
                        case 'cart':
                            include 'cart.php';
                            break;
                        case 'account':
                            include 'account.php';
                            break;
                        case 'account_edit':
                            include 'account_edit.php';
                            break;
                        case 'admin':
                            include 'admin/admin.php';
                            break;
                        case 'signin':
                            include 'security/signin.php';
                            break;
                        case 'signupvalidation':
                            include 'security/signupvalidation.php';
                            break;
                        case 'restorepassword':
                            include 'security/restorepassword.php';
                            break;
                        default :
                            include 'courses.php';
                            break;
                    }
                }else{
                    include 'courses.php';
                }
            ?>
        </div>
    </div>
    <?php
    include 'footer.php';
    ?>
    </body>
    </html>
<?php
$em->getConnection()->close();

