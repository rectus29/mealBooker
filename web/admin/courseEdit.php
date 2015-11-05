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
use MealBooker\models\dao\CourseDao;

if (!SecurityManager::get()->getCurrentUser($_SESSION)->isAdmin()) {
    header('Location:' . WEB_PATH);
}
$courseDao = new CourseDao($em);
//save mode
if (isset($_POST['name']) && isset($_POST['desc']) && isset($_POST['id']) && isset($_POST['state'])) {
    $course = $courseDao->getByPrimaryKey($_POST['id']);
    if ($course == null)
        $course = new Course();
    $course->setName($_POST['name']);
    $course->setDescription($_POST['desc']);
    $course->setStatus($_POST['state']);
    $courseDao->save($course);
    header('Location:' . WEB_PATH . '?page=admin&tab=course');
}

//view Mode
if (isset($_GET['id'])) {
    $course = $courseDao->getByPrimaryKey($_GET['id']);
    if ($course == null)
        header('Location:' . WEB_PATH);
} else {
    $course = new Course();
}
?>
<div class="row">
    <form action="#" method="post" class="form">
        <h2>Editer un plats</h2>
        <input type="hidden" name="id" value="<?php echo $course->getId(); ?>">

        <div class="control-group">
            <label for="name">Nom</label>
            <input name="name" class="form-control" type="text" value="<?php echo $course->getName(); ?>"/>
        </div>
        <div class="control-group">
            <label for="state">Status</label>
            <select name="state" id="state">
                <option value="0" <?php echo (0 == $course->getStatus())?'selected':''?>>Inactif</option>
                <option value="1" <?php echo (1 == $course->getStatus())?'selected':''?>>Actif</option>
            </select>
        </div>
        <div class="control-group">
            <label for="desc">Descriptif</label>
            <textarea name="desc" class="form-control">
                <?php echo $course->getName(); ?>
            </textarea>
        </div>
        <div class="form-group" style="text-align: center">
            <input type="submit" class="btn btn-green" value="Valider"/>
            <a href="<?php echo WEB_PATH ?>?page=admin&tab=course" class="btn btn-default" value="Connexion">Annuler</a>
        </div>
    </form>
</div>