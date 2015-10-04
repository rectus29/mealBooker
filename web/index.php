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

require_once(dirname(__FILE__).'/../config/global.php');
require_once(ROOT_DIR.'/bootstrap.php');
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
          include 'security/signin.php';
         ?>
      </div>

    </div>

  </body>
</html>
