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

?>
<nav class="navbar">
    <div class="container">
        <ul class="nav navbar-nav navbar-right">
            <li>
            <a href="https://aurore-traiteur.fr/">Accueil</a>
            </li>
            <li>
                <a href="<?php echo WEB_PATH ?>">Menus</a>
            </li>
            <?php if (isset($_SESSION) && SecurityManager::get()->isAuthentified($_SESSION)) { ?>
            <li>
                <a href="<?php echo WEB_PATH ?>?page=account">Mon compte</a>
            </li>
            <?php } ?>
            <li>
                <a href="<?php echo WEB_PATH ?>?page=cart">Mon panier</a>
            </li>
            <?php if (isset($_SESSION) && SecurityManager::get()->isAuthentified($_SESSION)&& SecurityManager::get()->isAdmin($_SESSION)) { ?>
            <li>
                <a href="<?php echo WEB_PATH ?>?page=admin">Administration</a>
            </li>
            <?php } ?>
            <?php if (isset($_SESSION) && SecurityManager::get()->isAuthentified($_SESSION)) { ?>
            <li class="log-out">
                <a href="<?php echo WEB_PATH ?>security/signout.php">Déconnexion</a>
            </li>
            <?php }else{ ?>
            <li class="log-out">
                <a href="<?php echo WEB_PATH ?>?page=signin">Se connecter</a>
            </li>
            <?php } ?>
        </ul>
    </div>
</nav>
