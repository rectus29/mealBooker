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
use MealBooker\model\Address;
use MealBooker\model\User;
use MealBooker\models\dao\CompanyDao;
use MealBooker\models\dao\RoleDao;
use MealBooker\models\dao\UserDao;
/** @var $user User */
$user = SecurityManager::get()->getCurrentUser($_SESSION);
if (isset($user) && $user == null){
    header('Location: ' . WEB_PATH);
}

$userDao = new UserDao($em);
$roleDao = new RoleDao($em);
$error = null;
$info = null;

//save mode
if (
    isset($_POST['lastname']) &&
    isset($_POST['firstname']) &&
    isset($_POST['mail']) &&
    isset($_POST['phone']) &&
    isset($_POST['company']) &&
    isset($_POST['id']) &&
    isset($_POST['address']) &&
    isset($_POST['addressComplement']) &&
    isset($_POST['city']) &&
    isset($_POST['zipCode'])
) {
    try {
        $user = $userDao->getByPrimaryKey($_POST['id']);
        if ($user == null)
            header('Location: ' . WEB_PATH);
        $user->setFirstName($_POST['firstname']);
        $user->setLastName($_POST['lastname']);
        $user->setMail($_POST['mail']);
        $user->setPhoneNumber($_POST['phone']);
        $user->setCompany($_POST['company']);
        //set address data
        if ($user->getAddress() == null) {
            $user->addAddress(new Address());
        }
        $user->getAddress()->setUser($user);
        $user->getAddress()->setAddress($_POST['address']);
        $user->getAddress()->setAddressComplement($_POST['addressComplement']);
        $user->getAddress()->setCity($_POST['city']);
        $user->getAddress()->setZipCode($_POST['zipCode']);
        $userDao->save($user);
        header('Location:' . WEB_PATH . '?page=account');
    } catch (Exception $ex) {
        echo $error;
        $error = $ex->getMessage();
    }
}



?>


<div class="page-header">
    <h1>Editer mon compte</h1>
</div>

<form action="#" method="post" class="form" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $user->getId(); ?>">
    <div class="row">
        <div class="col-md-6">
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
                <input name="mail" class="form-control required" type="email" value="<?php echo $user->getMail(); ?>"/>
            </div>
            <div class="form-group">
                <label for="phone">Téléphone</label>
                <input name="phone" class="form-control required" type="text" value="<?php echo $user->getPhoneNumber(); ?>"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="company">Société</label>
                <input name="company" class="form-control" type="text" value="<?php echo $user->getCompany(); ?>"/>
            </div>
            <hr>
            <div class="form-group">
                <label for="address">Adresse</label>
                <input name="address" class="form-control required" type="text" value="<?php echo ($user->getAddress() != null) ? $user->getAddress()->getAddress() : ""; ?>"/>
            </div>
            <div class="form-group">
                <label for="address">Complement d'adresse</label>
                <input name="addressComplement" class="form-control required" type="text" value="<?php echo ($user->getAddress() != null) ? $user->getAddress()->getAddressComplement() : ""; ?>"/>
            </div>
            <div class="form-group">
                <label for="city">Ville</label>
                <input name="city" class="form-control required" type="text" value="<?php echo ($user->getAddress() != null) ? $user->getAddress()->getCity() : ""; ?>"/>
            </div>
            <div class="form-group">
                <label for="zipCode">Code postal</label>
                <input name="zipCode" class="form-control required" type="text" value="<?php echo ($user->getAddress() != null) ? $user->getAddress()->getZipCode() : ""; ?>"/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="form-group" style="text-align: center">
                <input type="submit" class="btn btn-green" value="Valider"/>
                <a href="<?php echo WEB_PATH ?>?page=account" class="btn btn-default">Annuler</a>
            </div>
        </div>
    </div>
</form>
