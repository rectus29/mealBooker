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

require(dirname(__FILE__).'/../config/global.php');
require(ROOT_DIR.'/bootstrap.php');
require(ROOT_DIR.'/cli-config.php');
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
            if(isset($_SESSION) && $securityManager->isAuthentified($_SESSION))
                include 'menu.php';
            else
                include 'security/signup.php';
         ?>
      </div>

    </div>

  </body>
</html>
