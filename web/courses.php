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
use MealBooker\models\dao\CourseDao;
use MealBooker\models\dao\OrderDao;

$courseDao = new CourseDao($em);
$MealOrderDao = new OrderDao($em);

$mealPerDay = 0;
foreach ($courseDao->getAllEnabled() as $course) {
    $mealPerDay += $course->getNbPerDay();
}

//get all order in current time window
$todayMealOrder = $MealOrderDao->getCurrentMealOrder();
$remainingMeal = $mealPerDay - sizeof($todayMealOrder)
?>
<article class="course">

    <div class="row">
        <h3 class="pull-right">Il reste <?php echo ($remainingMeal < 0) ? 0 : $remainingMeal; ?> repas disponibles</h3>
    </div>


    <?php
    /**
     * @var $course Course
     **/
    $courses = $courseDao->getAllEnabled();
    for ($i = 0; $i < sizeof($courses); $i++) {
        $course = $courses[$i];
        if ($i % 2 == 0) {
            if ($i > 0)
                echo '</div>';
            if ($i < sizeof($courses))
                echo '<div class="row">';
        }
        $mealOrder = $MealOrderDao->getCurrentMealOrderForCourse($course);
        $remaining = $course->getNbPerDay() - sizeof($mealOrder);
        ?>
        <div class="col-md-6">
            <div class="card">
                <div class="meal-thumbnail">
                    <a href="<?php echo WEB_PATH ?>?page=meal&courseID=<?php echo $course->getId(); ?>">
                        <img src="<?php echo APP_PATH; ?>files/course/<?php echo $course->getImg(); ?>" alt="" class="img-responsive">
                    </a>
                    <div class="meal-left">
                        <?php echo $remaining > 0 ? $remaining : 0; ?> Restant(s)
                    </div>
                </div>
                <div class="card_body">

                    <h3>
                        <a href="<?php echo WEB_PATH ?>?page=meal&courseID=<?php echo $course->getId(); ?>">
                        <?php echo $course->getName(); ?></a></h3>
                    <hr>

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
</article>
