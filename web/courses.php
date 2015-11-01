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

$mealPerDay = 40;
$config = $configDao->getByKey('mealPerDay');
if (isset($config))
    $mealPerDay = $config->getValue();
//set min date
$startDate = new DateTime();
$startDate->sub(new DateInterval('P1D'));
$startDate->setTime(14, 0);
//set min date
$stopDate = new DateTime();
$stopDate->setTime(12, 0);
//get all order in time window
$todayMealOrder = $MealOrderDao->getMealOrderBetween($startDate, $stopDate);

?>

<article class="course">
    <div class="row">
        <h3>Il reste <?php echo $mealPerDay - sizeof($todayMealOrder);?> repas disponibles</h3>
    </div>
    <div class="row">
        <?php
        /**
         * @var $course Course
         */
        foreach ($courseDao->getAll() as $course) {
            ?>
            <div class="col-md-6">
                <a href="<?php echo WEB_PATH ?>?page=meal&courseID=<?php echo $course->getId(); ?>" class="card">
                    <div class="meal-thumbnail">
                        <img src="<?php echo APP_PATH; ?>files/course/<?php echo $course->getId(); ?>.jpg" alt="" class="img-responsive">

                        <div class="card_date">
                            <p><?php echo $course->getUpdated()->format('d M Y') ?></p>
                        </div>
                    </div>
                    <div class="card_body">
                        <h3><?php echo $course->getName(); ?></h3>

                        <p>
                            <?php echo $course->getDescription(); ?>
                        </p>
                    </div>
                </a>
            </div>

            <?php
        }
        ?>
    </div>
</article>
