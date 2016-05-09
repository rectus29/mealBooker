<?php
/*-----------------------------------------------------*/
/*      _____           _               ___   ___      */
/*     |  __ \         | |             |__ \ / _ \     */
/*     | |__) |___  ___| |_ _   _ ___     ) | (_) |    */
/*     |  _  // _ \/ __| __| | | / __|   / / \__, |    */
/*     | | \ \  __/ (__| |_| |_| \__ \  / /_   / /     */
/*     |_|  \_\___|\___|\__|\__,_|___/ |____| /_/      */
/*                                                     */
/*                Date: 02/05/2016 23:10               */
/*                 All right reserved                  */
/*-----------------------------------------------------*/
use MealBooker\model\Course;
use MealBooker\models\dao\CourseDao;

$courseDao = new CourseDao($em);
?>
<div class="row courseGallery">
    <?php
    /**
     * @var $courseArray Course[]
     */
    $courseArray = $courseDao->getAllEnabled();
    if (sizeof($courseArray) > 0) {
        foreach ($courseArray as $course) {
            ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="meal-thumbnail">
                        <a href="<?php echo WEB_PATH ?>?page=meal&courseID=<?php echo $course->getId(); ?>">
                            <img src="<?php echo APP_PATH; ?>files/course/<?php echo $course->getImg(); ?>" alt="" class="img-responsive">
                        </a>
                    </div>
                    <div class="card_body">
                        <h3>
                            <a href="<?php echo WEB_PATH ?>?page=meal&courseID=<?php echo $course->getId(); ?>">
                            <?php echo $course->getName(); ?></h3>
                        </a>
                        <p>
                            <?php echo $course->getDescription(); ?>
                        </p>
                        <a href="<?php echo WEB_PATH ?>?page=meal&courseID=<?php echo $course->getId(); ?>" class="btn btn-warning">Commander</a>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
?>
        <div>
            Pas de menu disponible actuellement
        </div>
<?php
    }
    ?>
</div>



