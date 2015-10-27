<?php
/*-----------------------------------------------------*/
/*      _____           _               ___   ___      */
/*     |  __ \         | |             |__ \ / _ \     */
/*     | |__) |___  ___| |_ _   _ ___     ) | (_) |    */
/*     |  _  // _ \/ __| __| | | / __|   / / \__, |    */
/*     | | \ \  __/ (__| |_| |_| \__ \  / /_   / /     */
/*     |_|  \_\___|\___|\__|\__,_|___/ |____| /_/      */
/*                                                     */
/*                Date: 15/10/2015 23:55               */
/*                 All right reserved                  */
/*-----------------------------------------------------*/
use MealBooker\manager\SecurityManager;

if(!SecurityManager::get()->isAdmin($_SESSION))
    header('location: / ');

$reqTab = null;
if (isset($_GET['tab'])) {
    $reqTab = $_GET['tab'];
}
?>
<div class="row">
    <div class="page-header">
        <h1>Administration</h1>
    </div>
    <div>
        <ul class="nav nav-tabs">
            <li role="presentation" <?php echo ($reqTab == null || $reqTab == 'dash') ? 'class="active"' : "" ?>><a href="<?php echo WEB_PATH . "?page=admin"?>">Dashboard</a></li>
            <li role="presentation" <?php echo ($reqTab != null && $reqTab == 'order') ? 'class="active"' : "" ?>><a href="<?php echo WEB_PATH . "?page=admin&tab=order"?>">Commandes</a></li>
            <li role="presentation" <?php echo ($reqTab != null && $reqTab == 'course') ? 'class="active"' : "" ?>><a href="<?php echo WEB_PATH . "?page=admin&tab=course"?>">Plats</a></li>
            <li role="presentation" <?php echo ($reqTab != null && $reqTab == 'drink') ? 'class="active"' : "" ?>><a href="<?php echo WEB_PATH . "?page=admin&tab=drink"?>">Boissons</a></li>
            <li role="presentation" <?php echo ($reqTab != null && $reqTab == 'timeframe') ? 'class="active"' : "" ?>><a href="<?php echo WEB_PATH . "?page=admin&tab=timeframe"?>">Horaires</a></li>
            <li role="presentation" <?php echo ($reqTab != null && $reqTab == 'users') ? 'class="active"' : "" ?>><a href="<?php echo WEB_PATH . "?page=admin&tab=users"?>">Utilisateurs</a></li>
            <li role="presentation" <?php echo ($reqTab != null && $reqTab == 'company') ? 'class="active"' : "" ?>><a href="<?php echo WEB_PATH . "?page=admin&tab=company"?>">Entreprises</a></li>
            <li role="presentation" <?php echo ($reqTab != null && $reqTab == 'server') ? 'class="active"' : "" ?>><a href="<?php echo WEB_PATH . "?page=admin&tab=server"?>">Gestion serveur</a></li>
        </ul>
        <div>
            <?php
                switch ($reqTab){
                    case 'dash' :
                        include 'dash.php';
                        break;
                    case 'order' :
                        include 'order.php';
                        break;
                    case 'course' :
                        include 'course.php';
                        break;
                    case 'drink' :
                        include 'drink.php';
                        break;
                    case 'timeframe' :
                        include 'timeframe.php';
                        break;
                    case 'users' :
                        include 'users.php';
                        break;
                    case 'company' :
                        include 'company.php';
                        break;
                    case 'server' :
                        include 'server.php';
                        break;
                    default :
                        include 'dash.php';
                        break;
                }
            ?>
        </div>
    </div>
</div>
