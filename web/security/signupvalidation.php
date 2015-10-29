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

use MealBooker\model\User;
use MealBooker\models\dao\UserDao;

$error = null;
if (isset($_GET['authToken'])) {
    $userDao = new UserDao($em);
    $user = $userDao->getBySession($_GET['authToken']);
    if ($user != null) {
        //reset session and enable user
        $user->setSession(null);
        $user->setStatus(1);
        //save user
        $userDao->save($user);
    }else{
        $error = "Une erreur est survenue";
    }
}
?>
<div class="col-md-6 col-md-offset-3">

    <h2>Bienvenue</h2>

    <p>
        <?php
        if ($error == null) {
            ?>
            votre un compte est maintenant validé !
            <?php
        } else {
            echo $error;
        }
        ?>
    </p>
    <a href="<?php WEB_PATH ?>" class="btn btn-default">Se connecter</a>

</div>
