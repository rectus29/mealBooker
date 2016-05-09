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
use MealBooker\model\User;
use MealBooker\models\dao\CompanyDao;
use MealBooker\models\dao\RoleDao;
use MealBooker\models\dao\UserDao;
use MealBooker\utils\Utils;

$error = null;
$info = null;
if (isset($_POST)
    && isset($_POST['login'])
    && isset($_POST['password'])
) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    if (SecurityManager::get()->authentificate($login, $password) != null) {
        header('Location: ' . WEB_PATH);
    } else {
        header('Location: ' . WEB_PATH . '?error=authError');
    }
} else if (isset($_POST)
    && isset($_POST['email'])
    && isset($_POST['phone'])
    && isset($_POST['firstName'])
    && isset($_POST['lastName'])
    && isset($_POST['password'])
    && isset($_POST['passwordCheck'])
) {
    $companyDao = new CompanyDao($em);
    $userDao = new UserDao($em);
    $roleDao = new RoleDao($em);
    try {
        if ($userDao->getUserByMail($_POST['email']) != null)
            throw new Exception("Ce mail est déjà utilisé par un compte existant");
        //set user data
        $user = new User();
        $user->setLastName($_POST['lastName']);
        $user->setFirstName($_POST['firstName']);
        $user->setMail($_POST['email']);
        $user->setPhoneNumber($_POST['phone']);
        //check password validation
        if ($_POST['password'] != $_POST['passwordCheck'])
            throw new Exception("Le champs mot de passe et confirmation mot de passe doivent étre identiques");
        $user->setPassword(password_hash($_POST['password'], PASSWORD_BCRYPT, ['salt' => $user->getSalt()]));
        //set user role to user
        $role = $roleDao->getByPrimaryKey('2');
        if ($role == null)
            throw new Exception("une erreur est survenue");
        $user->setRole($role);
        //set optIn
        if (isset($_POST['optIn']))
            $user->setOptIn($_POST['optIn']);
        //use session field to put authToken
        $user->setSession(Utils::generateStringCode());
        $user->setStatus(0);
        //save user
        $userDao->save($user);
        MailManager::get()->sendSignUpMail($user);
        $info = "Un mail vous a été envoyé pour confirmer votre inscription.";
    } catch (Exception $ex) {
        $error = $ex->getMessage();
    }
}
?>
<div class="loginbox">
    <div class="row">
        <div class="col-md-12 col-md-offset-1">
            <h1>Bienvenue</h1>

            <p>
                Vous êtes bien sur le système de réservation de repas Aurore Traiteur.<br/>
                Commandez votre déjeuner pour vous le faire livrer à votre entreprise, selon un horaire pré-défini.
            </p>
        </div>
    </div>
    <?php
    if ($error != null) {
        ?>
        <div class="alert alert-danger">
            Erreur : <?php echo $error; ?>
        </div>
        <?php
    }
    if ($info != null) {
        ?>
        <div class="alert alert-success">
            Information : <?php echo $info; ?>
        </div>
        <?php
    }
    ?>
    <br/>
    <br/>

    <div class="col-md-5 col-md-offset-1">
        <form class="form-horizontal" action="#" method="post" id="connectWrapper">
            <h2>Vous avez un compte ?</h2>

            <p>Pour commander votre repas, entrez votre identifiant (adresse mail) ainsi que votre mot de passe.</p>

            <div class="control-group">
                <label for="login">E-mail</label>
                <input name="login" class="form-control" type="text" placeholder="Adresse e-mail ex: a.dupont@mail.com"/>
            </div>
            <br/>

            <div class="control-group">
                <label for="password">Mot de passe</label>
                <input name="password" class="form-control" type="password"/>
            </div>
            <br/>

            <a href="<?php echo WEB_PATH; ?>?page=restorepassword">Mot de passe oublié ?</a>

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
        <h2>Créez un compte</h2>

        <form method="post" action="#" id="signupForm">
            <div class="form-group">
                <label for="exampleInputEmail1">Adresse e-mail</label>
                <input type="email" name="email" class="form-control required" id="exampleInputEmail1" placeholder="Email">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="firsName">Prénom</label>
                        <input type="text" name="firstName" class="form-control required" id="firstName" placeholder="Prénom">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lastName">Nom</label>
                        <input type="text" name="lastName" class="form-control required" id="lastName" placeholder="Nom">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="phone">Numéro de téléphone</label>
                <input type="text" name="phone" class="form-control required" id="phone" placeholder="Numéro de téléphone">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" class="form-control required" id="password" placeholder="Mot de passe">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="passwordCheck">Vérifiez votre mot de passe</label>
                        <input type="password" name="passwordCheck" class="form-control required" id="passwordCheck" placeholder="Vérifiez votre mot de passe">
                    </div>
                </div>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="optIn"/>En cochant cette case, j'accepte de recevoir des offres de la part d'Aurore Traiteur
                </label>
            </div>
            <div class="form-group" style="text-align: center">
                <input type="submit" class="btn btn-green" value="Finaliser l'inscription"/>
            </div>
        </form>
    </div>
</div>
<div class="retour">
    <a href="http://www.aurore-traiteur.fr" class="btn btn-default">Retour sur le site</a>
</div>