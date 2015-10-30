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

$error = null;
$info = null;
if (isset($_POST) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['idEntreprise']) && isset($_POST['password']) && isset($_POST['passwordCheck'])) {
    $companyDao = new CompanyDao($em);
    $userDao = new UserDao($em);
    $roleDao = new RoleDao($em);
    try {
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
        //set company with validation code
        $company = $companyDao->getByValidationCode($_POST['idEntreprise']);
        if ($company == null)
            throw new Exception("Code de validation inconnu");
        $user->setCompany($company);
        //set optIn
        if (isset($_POST['optIn']))
            $user->setOptIn($_POST['optIn']);
        //use session field to put authToken
        $user->setSession(SecurityManager::get()->generateStringCode());
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
<div class="col-md-6 col-md-offset-3">

    <h2>Bienvenue</h2>

    <p>
        Vous êtes bien sur le système de réservation de repas Aurore Traiteur.<br />
        Commandez votre déjeuner pour vous le faire livrer à votre entreprise, selon un horaire pré-défini.
    </p>
    <ul>
        <li>Créez un compte</li>
        <li>Préciser l'identifiant de VOTRE entreprise qui vous a été communiqué (3 chiffres)</li>
        <li>Faites-vous livrer votre repas directement à votre lieu de travail !</li>
    </ul>

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
        <div class="form-group">
            <label for="idEntreprise">Identifiant entreprise</label>
            <input type="text" name="idEntreprise" class="form-control required" id="idEntreprise" placeholder="0123456">
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
        <input type="submit" class="btn btn-warning" value="Finaliser l'inscription"/>
    </form>
    <?php
    if ($error != null) {
        ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
        <?php
    }
    ?>
    <?php
    if ($info != null) {
        ?>
        <div class="alert alert-success">
            <?php echo $info; ?>
        </div>
        <?php
    }
    ?>
</div>
