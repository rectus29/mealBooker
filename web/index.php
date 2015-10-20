<?php
namespace MealBooker;
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

require_once(dirname(__FILE__) . '/../config/global.php');
require_once(ROOT_DIR . '/bootstrap.php');
require_once(ROOT_DIR . '/cli-config.php');
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
<div class="container">
    <div class="row">
        <?php
        if (isset($_SESSION) && SecurityManager::get()->isAuthentified($_SESSION)) {
            if (isset($_GET['page'])) {
                switch ($_GET['page']) {
                    case 'meal':
                        include 'meal.php';
                        break;
                    case 'courses':
                        include 'courses.php';
                        break;
                    case 'cart':
                        include 'cart.php';
                        break;
                    case 'account':
                        include 'account.php';
                        break;
                    case 'admin':
                        include 'admin/admin.php';
                        break;
                    default :
                        include 'courses.php';
                        break;
                }
            }else{
                include 'courses.php';
            }
        } else
            include 'security/signup.php';
        ?>
    </div>
</div>
<?php
    include 'footer.php';
?>
</body>
</html>
