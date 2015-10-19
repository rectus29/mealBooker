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
use MealBooker\model\User;

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
        var_dump(SecurityManager::get()->isAuthentified($_SESSION));
        if (isset($_SESSION) && SecurityManager::get()->isAuthentified($_SESSION))
            //include 'courses.php';
            include 'meal.php';
        else
            include 'security/signup.php';
        ?>
    </div>
</div>
</body>
</html>
