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
use MealBooker\model\Course;
use MealBooker\model\Drink;
use MealBooker\models\dao\DrinkDao;

if (!SecurityManager::get()->getCurrentUser($_SESSION)->isAdmin()) {
    header('Location:' . WEB_PATH);
}
$drinkDao = new DrinkDao($em);
//save mode
if (isset($_POST['name']) && isset($_POST['desc']) && isset($_POST['id']) && isset($_POST['state'])) {
    $drink = $drinkDao->getByPrimaryKey($_POST['id']);
    if ($drink == null)
        $drink = new Drink();
    $drink->setName($_POST['name']);
    $drink->setDescription($_POST['desc']);
    $drink->setStatus($_POST['state']);
    $drinkDao->save($drink);
    header('Location:' . WEB_PATH . '?page=admin&tab=drink');
}

//view Mode
if (isset($_GET['id'])) {
    $drink = $drinkDao->getByPrimaryKey($_GET['id']);
    if ($drink == null)
        header('Location:' . WEB_PATH);
} else {
    $drink = new Drink();
}
?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <form action="#" method="post" class="form">
            <h2>Editer une Boisson</h2>
            <input type="hidden" name="id" value="<?php echo $drink->getId(); ?>">

            <div class="form-group">
                <label for="name">Nom</label>
                <input name="name" class="form-control" type="text" value="<?php echo $drink->getName(); ?>"/>
            </div>
            <div class="form-group">
                <label for="state">Status</label>
                <select name="state" id="state">
                    <option value="0" <?php echo (0 == $drink->getStatus()) ? 'selected' : '' ?>>Inactif</option>
                    <option value="1" <?php echo (1 == $drink->getStatus()) ? 'selected' : '' ?>>Actif</option>
                </select>
            </div>
            <div class="form-group">
                <label for="desc">Descriptif</label>
                <textarea name="desc" class="form-control" rows="10"><?php echo $drink->getDescription(); ?></textarea>
            </div>
            <div class="form-group" style="text-align: center">
                <input type="submit" class="btn btn-green" value="Valider"/>
                <a href="<?php echo WEB_PATH ?>?page=admin&tab=drink" class="btn btn-default"
                   value="Connexion">Annuler</a>
            </div>
        </form>
    </div>
</div>