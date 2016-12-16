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
use MealBooker\model\Location;
use MealBooker\model\TimeFrame;
use MealBooker\models\dao\LocationDao;

if (!SecurityManager::get()->getCurrentUser($_SESSION)->isAdmin()) {
    header('Location:' . WEB_PATH);
}
$locationDao = new LocationDao($em);
//save mode
if (isset($_POST['name']) && isset($_POST['id']) && isset($_POST['state'])) {
    // @var Location
    $location = $locationDao->getByPrimaryKey($_POST['id']);
    if ($location == null)
        $location = new Location();
    $location->setName($_POST['name']);
    $location->setStatus($_POST['state']);
    $locationDao->save($location);
    header('Location:' . WEB_PATH . '?page=admin&tab=location');
}

//view Mode
if (isset($_GET['id'])) {
    $location = $locationDao->getByPrimaryKey($_GET['id']);
    if ($location == null)
        header('Location:' . WEB_PATH);
} else {
    $location = new Location();
}
?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <form action="#" method="post" class="form">
            <h2>Editer un lieu</h2>
            <input type="hidden" name="id" value="<?php echo $location->getId(); ?>">

            <div class="control-group">
                <label for="start">Libellé</label>
                <input name="name" class="form-control" type="text" value="<?php echo $location->getName(); ?>"/>
            </div>
            <div class="control-group">
                <label for="state">Status</label>
                <select name="state" id="state">
                    <option value="0" <?php echo (0 == $location->getStatus()) ? 'selected' : '' ?>>Inactif</option>
                    <option value="1" <?php echo (1 == $location->getStatus()) ? 'selected' : '' ?>>Actif</option>
                </select>
            </div>
            <div class="form-group" style="text-align: center">
                <input type="submit" class="btn btn-green" value="Valider"/>
                <a href="<?php echo WEB_PATH ?>?page=admin&tab=location" class="btn btn-default" value="Connexion">Annuler</a>
            </div>
        </form>
    </div>
</div>