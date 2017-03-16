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
$GLOBALS['maintenance'] = !$em->getConnection()->ping();

//check maintenance mod
if ($configDao->getByKey('serverState') != null && $configDao->getByKey('serverState')->getValue() == '0' && !SecurityManager::get()->isAdmin($_SESSION)){
    $GLOBALS['maintenance'] = true;
}

function includeWithMaintenanceControl($page){
    if($GLOBALS['maintenance'] && !SecurityManager::get()->isAdmin($_SESSION)){
        return 'security/maintenance.php';
    }else{
        return $page;
    }
}

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

            <?php
                if(isset($_GET['page'])){
                    switch ($_GET['page']) {
                        case 'meal':
                            include includeWithMaintenanceControl('meal.php');
                            break;
                        case 'cart':
                            include includeWithMaintenanceControl('cart.php');
                            break;
                        case 'account':
                            include includeWithMaintenanceControl('account.php');
                            break;
                        case 'account_edit':
                            include includeWithMaintenanceControl('account_edit.php');
                            break;
                        case 'admin':
                            include includeWithMaintenanceControl('admin/admin.php');
                            break;
                        case 'signin':
                            include 'security/signin.php';
                            break;
                        case 'signupvalidation':
                            include includeWithMaintenanceControl('security/signupvalidation.php');
                            break;
                        case 'restorepassword':
                            include includeWithMaintenanceControl('security/restorepassword.php');
                            break;
                        default :
                            include includeWithMaintenanceControl('courses.php');
                            break;
                    }
                }else{
                    include includeWithMaintenanceControl('courses.php');
                }
            ?>

    </div>
    <?php
    include 'footer.php';
    ?>
    </body>
    </html>
<?php
$em->getConnection()->close();

