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
use MealBooker\model\Dessert;
use MealBooker\models\dao\DessertDao;

if (!SecurityManager::get()->getCurrentUser($_SESSION)->isAdmin()) {
    header('Location:' . WEB_PATH);
}
$dessertDao = new DessertDao($em);
//save mode
if (isset($_POST['name']) && isset($_POST['desc']) && isset($_POST['id']) && isset($_POST['state'])) {
    $dessert = $dessertDao->getByPrimaryKey($_POST['id']);
    if ($dessert == null)
        $dessert = new Dessert();
    $dessert->setName($_POST['name']);
    $dessert->setDescription($_POST['desc']);
    $dessert->setStatus($_POST['state']);
    $dessertDao->save($dessert);
    header('Location:' . WEB_PATH . '?page=admin&tab=dessert');
}

//view Mode
if (isset($_GET['id'])) {
    $dessert = $dessertDao->getByPrimaryKey($_GET['id']);
    if ($dessert == null)
        header('Location:' . WEB_PATH);
} else {
    $dessert = new Dessert();
}
?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <form action="#" method="post" class="form">
            <h2>Editer un dessert</h2>
            <input type="hidden" name="id" value="<?php echo $dessert->getId(); ?>">

            <div class="form-group">
                <label for="name">Nom</label>
                <input name="name" class="form-control" type="text" value="<?php echo $dessert->getName(); ?>"/>
            </div>
            <div class="form-group">
                <label for="state">Status</label>
                <select name="state" id="state">
                    <option value="0" <?php echo (0 == $dessert->getStatus()) ? 'selected' : '' ?>>Inactif</option>
                    <option value="1" <?php echo (1 == $dessert->getStatus()) ? 'selected' : '' ?>>Actif</option>
                </select>
            </div>
            <div class="form-group">
                <label for="desc">Descriptif</label>
                <textarea name="desc" class="form-control" rows="10"><?php echo $dessert->getDescription(); ?></textarea>
            </div>
            <div class="form-group" style="text-align: center">
                <input type="submit" class="btn btn-green" value="Valider"/>
                <a href="<?php echo WEB_PATH ?>?page=admin&tab=dessert" class="btn btn-default"
                   value="Connexion">Annuler</a>
            </div>
        </form>
    </div>
</div>