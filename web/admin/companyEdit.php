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
use MealBooker\model\Company;
use MealBooker\models\dao\CompanyDao;

if (!SecurityManager::get()->getCurrentUser($_SESSION)->isAdmin()) {
    header('Location:' . WEB_PATH);
}
$companyDao = new CompanyDao($em);
//save mode
if (isset($_POST['name']) && isset($_POST['id']) && isset($_POST['validCode']) && isset($_POST['state'])) {
    $company = $companyDao->getByPrimaryKey($_POST['id']);
    if ($company == null)
        $company = new Company();
    $company->setName($_POST['name']);
    $company->setValidationCode($_POST['validCode']);
    $company->setStatus($_POST['state']);
    $companyDao->save($company);
    header('Location:' . WEB_PATH . '?page=admin&tab=company');
}

//view Mode
if (isset($_GET['id'])) {
    $company = $companyDao->getByPrimaryKey($_GET['id']);
    if ($company == null)
        header('Location:' . WEB_PATH);
} else {
    $company = new Company();
}
?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <form action="#" method="post" class="form" enctype="multipart/form-data">
            <?php
            if ($company->getId() == null) {
                ?>
                <h2>Ajouter une Société</h2>
            <?php } else { ?>
                <h2>Editer une Société</h2>
            <?php } ?>
            <input type="hidden" name="id" value="<?php echo $company->getId(); ?>">

            <div class="form-group">
                <label for="name">Nom</label>
                <input name="name" class="form-control" type="text" value="<?php echo $company->getName(); ?>"/>
            </div>
            <div class="form-group">
                <label for="validCode">Code de validation</label>
                <input name="validCode" class="form-control" type="text" value="<?php echo $company->getValidationCode(); ?>"/>
            </div>
            <div class="form-group">
                <label for="state">Status</label>
                <select name="state" id="state">
                    <option value="1" <?php echo (1 == $company->getStatus()) ? 'selected' : '' ?>>Actif</option>
                    <option value="0" <?php echo (0 == $company->getStatus()) ? 'selected' : '' ?>>Inactif</option>
                </select>
            </div>
            <div class="form-group" style="text-align: center">
                <input type="submit" class="btn btn-green" value="Valider"/>
                <a href="<?php echo WEB_PATH ?>?page=admin&tab=company" class="btn btn-default">Annuler</a>
            </div>
        </form>
    </div>
</div>