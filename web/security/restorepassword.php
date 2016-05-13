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
use MealBooker\manager\MailManager;
use MealBooker\manager\SecurityManager;
use MealBooker\models\dao\UserDao;

$mod = "QUERY";
if (isset($_POST['email']) && sizeof($_POST['email']) > 0) {
    //query token
    try {
        $email = $_POST['email'];
        $userDao = new UserDao($em);
        $user = $userDao->getUserByMail($email);
        if ($user == null)
            throw new Exception("Adresse Email inconnue");
        else {
            $user->setRestoreToken(\MealBooker\utils\Utils::generateStringCode());
            $userDao->save($user);
            MailManager::get()->sendRestorePasswordMail($user);
            $message = 'Un E-mail vous a était envoyé pour réaliser la restoration de votre mots de passe';
        }
    } catch (Exception $ex) {
        $error = $ex->getMessage();
    }
} else if (isset($_POST['restorepassword']) && sizeof($_POST['restorepassword']) > 0 && isset($_POST['token']) && sizeof($_POST['token']) > 0){
    //token and new password validation
    try{
        $password = $_POST['restorepassword'];
        $token = $_POST['token'];
        $userDao = new UserDao($em);
        $user = $userDao->getByRestoreToken($token);
        if($user != null){
            //unset token and save new password
            $user->setRestoreToken(null);
            $user->setPassword(SecurityManager::hashPassword($password, $user->getSalt()));
            $userDao->save($user);
            $message = 'Votre mots de passe est validé, vous pouvez maintenant vous connecter';
        }else{
            throw new Exception("Une erreur est survenue");
        }
    }catch(Exception $ex){
        $error = $ex->getMessage();
    }
} else if (isset($_GET['token']) && sizeof($_GET['token']) > 0) {
    //query validation
    try {
        $token = $_GET['token'];
        $userDao = new UserDao($em);
        $user = $userDao->getByRestoreToken($token);
        if ($user == null)
            throw new Exception("Jeton de restoration inconnu");
        else if ($user->getUpdated() > (new DateTime())->add(new DateInterval('P1D')))
            throw new Exception('Jeton de restoration expiré');
        else {
            $mod = "RESTOR";
        }
    } catch (Exception $ex) {
        $error = $ex->getMessage();
    }

}
?>
<div class="loginbox">
    <div class="col-md-4 col-md-offset-4">
        <?php
        if ($mod == 'RESTOR' && isset($token)) {
            ?>
            <form class="form-horizontal" action="<?php echo WEB_PATH; ?>?page=restorepassword" method="post" id="restorePassword">
                <input type="hidden" value="<?php echo $token; ?>" name="token">

                <h2>Récupération de votre mots de passe</h2>

                <p>Veuilez saisir votre nouveau mots de passe </p>

                <div class="control-group">
                    <label for="restorepassword">Nouveau mots de passe</label>
                    <input name="restorepassword" class="form-control required" required="required" type="password" placeholder="Nouveau mots de passe"/>
                </div>
                <div class="form-group" style="text-align: center">
                    <input type="submit" class="btn btn-green" value="Valider"/>
                </div>
            </form>
            <?php
        } else if($mod=='QUERY'){
            ?>
            <form class="form-horizontal" action="<?php echo WEB_PATH; ?>?page=restorepassword" method="post" id="restorePassword">
                <h2>Vous avez perdu votre mot de passe ?</h2>

                <p>Indiquez nous votre e-mail pour générer un nouveau mot de passe</p>

                <div class="control-group">
                    <label for="email">E-mail</label>
                    <input name="email" class="form-control required" required="required" type="email" pattern="[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}.[a-z]{2,4}" placeholder="Votre adresse e-mail"/>
                </div>
                <div class="form-group" style="text-align: center">
                    <input type="submit" class="btn btn-green" value="Valider"/>
                </div>

            </form>
            <?php
        }
        ?>
        <?php
        if (isset($error))
        echo '<div id ="feedback" class="alert alert-danger" >' . $error . '</div>';
        if (isset($info))
        echo '<div id ="feedback" class="alert alert-warning" >' . $info . '</div>';
        if (isset($message))
        echo '<div id ="feedback" class="alert alert-success" >' . $message . '</div>';
        ?>
    </div>
</div>