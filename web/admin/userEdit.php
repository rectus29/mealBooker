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
use MealBooker\manager\SecurityManager;
use MealBooker\model\User;
use MealBooker\models\dao\CompanyDao;
use MealBooker\models\dao\RoleDao;
use MealBooker\models\dao\UserDao;

if (!SecurityManager::get()->getCurrentUser($_SESSION)->isAdmin()) {
    header('Location:' . WEB_PATH);
}
$userDao = new UserDao($em);
$companyDao = new CompanyDao($em);
$roleDao = new RoleDao($em);
$error = null;
$info = null;

//save mode
if (
    isset($_POST['lastname']) &&
    isset($_POST['firstname']) &&
    isset($_POST['mail']) &&
    isset($_POST['phone']) &&
    isset($_POST['role']) &&
    isset($_POST['company']) &&
    isset($_POST['id']) &&
    isset($_POST['state'])
) {
    try {
        $user = $userDao->getByPrimaryKey($_POST['id']);
        if ($user == null)
            $user = new User();
        $user->setFirstName($_POST['firstname']);
        $user->setLastName($_POST['lastname']);
        $user->setMail($_POST['mail']);
        $user->setPhoneNumber($_POST['phone']);
        $user->setOptIn((isset($_POST['optin'])) ? true : false);
        $user->setStatus($_POST['state']);
        $role = $roleDao->getByPrimaryKey($_POST['role']);
        if ($role == null)
            throw new Exception("une erreur est survenue -> 0x1");
        $user->setRole($role);
        $company = $companyDao->getByPrimaryKey($_POST['company']);
        if ($company == null)
            throw new Exception("une Erreur est survenue -> 0x2");
        $user->setCompany($company);
        //if already password save
        if(isset($_POST['password']) && strlen($_POST['password']) > 0){
            if (($_POST['password'] != $_POST['passwordchk']))
                throw new Exception("Le champs mot de passe et confirmation mot de passe doivent étre identiques");
            $user->setPassword(SecurityManager::get()->hashPassword($_POST['password'], $user->getSalt()));
        }else if($user->getPassword() == null && strlen($_POST['password']) < 1){
            throw new Exception("un mot de passe est requis");
        }
        $userDao->save($user);
        header('Location:' . WEB_PATH . '?page=admin&tab=users');
    } catch (Exception $ex) {
        echo $error;
        $error = $ex->getMessage();
    }
}

//view Mode
if (isset($_GET['id'])) {
    $user = $userDao->getByPrimaryKey($_GET['id']);
    if ($user == null)
        header('Location:' . WEB_PATH);
} else {
    $user = new User();
}
?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <form action="#" method="post" class="form">
            <h2>Editer une Utilisateur</h2>
            <input type="hidden" name="id" value="<?php echo $user->getId(); ?>">

            <div class="form-group">
                <label for="lastname">Nom</label>
                <input name="lastname" class="form-control" type="text" value="<?php echo $user->getLastName(); ?>"/>
            </div>
            <div class="form-group">
                <label for="firstname">Prénom</label>
                <input name="firstname" class="form-control" type="text" value="<?php echo $user->getFirstName(); ?>"/>
            </div>
            <div class="form-group">
                <label for="mail">E-Mail</label>
                <input name="mail" class="form-control" type="email" value="<?php echo $user->getMail(); ?>"/>
            </div>
            <div class="form-group">
                <label for="phone">Téléphone</label>
                <input name="phone" class="form-control" type="text" value="<?php echo $user->getPhoneNumber(); ?>"/>
            </div>
            <div class="form-group">
                <label for="role">Rôle</label>
                <select name="role" class="form-control">
                    <?php
                    foreach ($roleDao->getAll() as $role) {
                        echo '<option value="' . $role->getId() . '" ' . (($role == $user->getRole()) ? 'selected' : '') . ' >' . $role->getName() . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="checkbox">
                <label for="optin">
                    <input name="optin" type="checkbox" <?php echo(($user->isOptIn()) ? "checked" : ""); ?>/>
                    Démarchable
                </label>
            </div>
            <div class="form-group">
                <label for="company">Société</label>
                <select name="company" class="form-control">
                    <?php
                    foreach ($companyDao->getAllEnabled() as $comp) {
                        echo '<option value="' . $comp->getId() . '" ' . (($comp == $user->getCompany()) ? 'selected' : '') . '>' . $comp->getName() . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input name="password" class="form-control" type="password" value=""/>
            </div>
            <div class="form-group">
                <label for="passwordchk">Confirmation mot de passe</label>
                <input name="passwordchk" class="form-control" type="password" value=""/>
            </div>

            <div class="form-group">
                <label for="state">Status</label>
                <select name="state" id="state">
                    <option value="0" <?php echo (0 == $user->getStatus()) ? 'selected' : '' ?>>Inactif</option>
                    <option value="1" <?php echo (1 == $user->getStatus()) ? 'selected' : '' ?>>Actif</option>
                </select>
            </div>

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

            <div class="form-group" style="text-align: center">
                <input type="submit" class="btn btn-green" value="Valider"/>
                <a href="<?php echo WEB_PATH ?>?page=admin&tab=users" class="btn btn-default">Annuler</a>
            </div>
        </form>
    </div>
</div>