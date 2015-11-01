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

if (isset($_POST['login']) && isset($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    if (SecurityManager::get()->authentificate($login, $password) != null) {
        header('Location: ' . WEB_PATH);
    } else {
        header('Location: ' . WEB_PATH . '?error=authError');
    }

} else {
    ?>
    <div class="loginbox">
        <div class="col-md-5 col-md-offset-1">
            <form class="form-horizontal" target="<?php echo WEB_PATH;?>" method="post" id="connectWrapper">
                <h2>Vous avez un compte ?</h2>
                    <p>Pour commander votre repas, entrez votre identifiant (adresse mail) ainsi que votre mot de passe.</p>
                <div class="control-group">
                    <label for="login">E-mail</label>
                    <input name="login" class="form-control" type="text" placeholder="Adresse e-mail ex: a.dupont@mail.com" />
                </div>
                <br/>

                <div class="control-group">
                    <label for="password">Mot de passe</label>
                    <input name="password" class="form-control" type="password"/>
                </div>
                <br/>
                <a href="">Mot de passe oublié ?</a>

                <div class="form-group" style="text-align: center">
                    <input type="submit" class="btn btn-green" value="Connexion"/>
                </div>
                <?php
                if (isset($_GET['error'])) {
                    echo '<div id = "feedback" class="alert alert-danger" >';
                    echo 'Erreur lors de l\'authentification';
                    echo '</div>';
                }
                ?>
            </form>
        </div>
        <div class="col-md-5">
            <div class="inscription">
                <h2>Vous avez un code entreprise ?</h2>
                    <p>Créez un compte et faites-vous livrer votre repas dans votre entreprise.</p>
                <div style="text-align: center">
                    <a href="<?php echo WEB_PATH;?>?page=inscription" class="btn btn-warning">S'incrire</a>
                </div>
            </div>
            <div class="retour">
                <a href="http://www.aurore-traiteur.fr" class="btn btn-default">Retour sur le site</a>
            </div>

        </div>
    </div>
    <?php
}
?>