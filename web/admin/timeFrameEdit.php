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
use MealBooker\model\TimeFrame;
use MealBooker\models\dao\TimeFrameDao;

if (!SecurityManager::get()->getCurrentUser($_SESSION)->isAdmin()) {
    header('Location:' . WEB_PATH);
}
$timeFrameDao = new TimeFrameDao($em);
//save mode
if (isset($_POST['start']) && isset($_POST['id']) && isset($_POST['state'])) {
    $timeFrame = $timeFrameDao->getByPrimaryKey($_POST['id']);
    if ($timeFrame == null)
        $timeFrame = new TimeFrame();
    $timeFrame->setStart($_POST['start']);
    $timeFrame->setStatus($_POST['state']);
    $timeFrameDao->save($timeFrame);
    header('Location:' . WEB_PATH . '?page=admin&tab=timeframe');
}

//view Mode
if (isset($_GET['id'])) {
    $timeFrame = $timeFrameDao->getByPrimaryKey($_GET['id']);
    if ($timeFrame == null)
        header('Location:' . WEB_PATH);
} else {
    $timeFrame = new TimeFrame();
}
?>
<div class="row">
    <form action="#" method="post" class="form">
        <h2>Editer une Horaire</h2>
        <input type="hidden" name="id" value="<?php echo $timeFrame->getId(); ?>">

        <div class="control-group">
            <label for="start">Horaire</label>
            <input name="start" class="form-control" type="text" value="<?php echo $timeFrame->getStart(); ?>"/>
        </div>
        <div class="control-group">
            <label for="state">Status</label>
            <select name="state" id="state">
                <option value="0" <?php echo (0 == $timeFrame->getStatus())?'selected':''?>>Inactif</option>
                <option value="1" <?php echo (1 == $timeFrame->getStatus())?'selected':''?>>Actif</option>
            </select>
        </div>
        <div class="form-group" style="text-align: center">
            <input type="submit" class="btn btn-green" value="Valider"/>
            <a href="<?php echo WEB_PATH ?>?page=admin&tab=timeframe" class="btn btn-default" value="Connexion">Annuler</a>
        </div>
    </form>
</div>