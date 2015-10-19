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
                <i class="fa-icon-user"></i>
                <?php SecurityManager::get()->getCurrentUser($_SESSION)?>
            </li>
            <li>
                <a href="<?php echo APP_PATH ?>/">Accueil</a>
            </li>
            <li>
                <a href="<?php echo APP_PATH ?>/account">Mon compte</a>
            </li>
            <li>
                <a href="<?php echo APP_PATH ?>/cart">Mon panier</a>
            </li>
            <?php
            if (SecurityManager::get()->isAdmin($_SESSION)) {
                ?>
                <li>
                    <a href="<?php echo APP_PATH ?>/admin">Administration</a>
                </li>
                <?php
            }
            ?>
            <li class="log-out">
                <a href="<?php echo APP_PATH ?>web/security/signout.php">Déconnexion</a>
            </li>
        </ul>
    </div>
</nav>
