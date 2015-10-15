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

?>
<nav class="navbar">
  <div class="container">
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#">Accueil</a></li>
      <li><a href="#">Mon compte</a></li>
      <li><a href="#">Mon panier</a></li>
      <li class="log-out">
          <a href="<?php echo APP_PATH ?>web/security/signout.php">Déconnexion</a>
      </li>
    </ul>
  </div>
</nav>
