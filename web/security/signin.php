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

if ($_POST & isset($_POST['login']) && isset($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    echo $login;
    echo $password;
    if (SecurityManager::get()->authentificate($login, $password, $_SESSION) != null) {
        header('Location: ' . WEB_PATH);
    } else {
        header('Location: ' . WEB_PATH . '?error=authError');
    }

} else {
    ?>
    <form class="form-horizontal col-md-4 col-md-offset-4 " target="<?php echo WEB_PATH;?>" method="post" id="connectWrapper">
        <h2>Connexion</h2>

        <div class="input-group">
            <div class="input-group-addon">
                <i class="fa fa-user"></i>
            </div>
            <input name="login" class="form-control" type="text"/>
        </div>
        <br/>

        <div class="input-group">
            <div class="input-group-addon">
                <i class="fa fa-lock"></i>
            </div>
            <input name="password" class="form-control" type="password"/>
        </div>
        <br/>

        <div class="form-group" style="text-align: center">
            <a href="<?php echo WEB_PATH;?>?page=inscription" class="btn btn-default">S'incrire</a>
            <input type="submit" class="btn btn-warning" value="Connection"/>
        </div>
        <?php
        if (isset($_GET['error'])) {
            echo '<div id = "feedback" class="alert alert-danger" >';
            echo 'Erreur lors de l\'authentification';
            echo '</div>';
        }
        ?>
    </form>
    <?php
}
?>