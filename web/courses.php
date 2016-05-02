<?php
/*-----------------------------------------------------*/
/*      _____           _               ___   ___      */
/*     |  __ \         | |             |__ \ / _ \     */
/*     | |__) |___  ___| |_ _   _ ___     ) | (_) |    */
/*     |  _  // _ \/ __| __| | | / __|   / / \__, |    */
/*     | | \ \  __/ (__| |_| |_| \__ \  / /_   / /     */
/*     |_|  \_\___|\___|\__|\__,_|___/ |____| /_/      */
/*                                                     */
/*                Date: 04/10/2015 17:41               */
/*                 All right reserved                  */
/*-----------------------------------------------------*/
use MealBooker\model\Course;
use MealBooker\model\Meal;
use MealBooker\models\dao\CourseDao;
use MealBooker\models\dao\OrderDao;

$courseDao = new CourseDao($em);
$MealOrderDao = new OrderDao($em);

$mealPerDay = 0;
foreach($courseDao->getAllEnabled() as $course){
    $mealPerDay += $course->getNbPerDay();
}

//get all order in current time window
$todayMealOrder = $MealOrderDao->getCurrentMealOrder();

?>
<article class="course">

    <!--<div class="row">
        <h3>Il reste <?php /*echo $mealPerDay - sizeof($todayMealOrder);*/?> repas disponibles</h3>
    </div>-->

    <div class="row">
        <?php
        /**
         * @var $course Course
         **/
        foreach ($courseDao->getAllEnabled() as $course) {
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
        ?>
    </div>
</article>
