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
            <li role="presentation" <?php echo ($reqTab == null || $reqTab == 'dash') ? 'class="active"' : "" ?>><a href="#">Dashboard</a></li>
            <li role="presentation" <?php echo ($reqTab != null && $reqTab == 'order') ? 'class="active"' : "" ?>><a href="#">Commandes</a></li>
            <li role="presentation" <?php echo ($reqTab != null && $reqTab == 'courses') ? 'class="active"' : "" ?>><a href="#">Plats</a></li>
            <li role="presentation" <?php echo ($reqTab != null && $reqTab == 'drink') ? 'class="active"' : "" ?>><a href="#">Boissons</a></li>
            <li role="presentation" <?php echo ($reqTab != null && $reqTab == 'timeframe') ? 'class="active"' : "" ?>><a href="#">Horaires</a></li>
            <li role="presentation" <?php echo ($reqTab != null && $reqTab == 'users') ? 'class="active"' : "" ?>><a href="#">Utilisateurs</a></li>
            <li role="presentation" <?php echo ($reqTab != null && $reqTab == 'company') ? 'class="active"' : "" ?>><a href="#">Entreprises</a></li>
            <li role="presentation" <?php echo ($reqTab != null && $reqTab == 'server') ? 'class="active"' : "" ?>><a href="#">Gestion serveur</a></li>
        </ul>
        <div>

        </div>
    </div>
</div>
