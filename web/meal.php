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
use MealBooker\models\dao\DrinkDao;
use MealBooker\models\dao\OrderDao;
use MealBooker\models\dao\TimeFrameDao;
use MealBooker\utils\Utils;

$courseDao = new CourseDao($em);
$drinkDao = new DrinkDao($em);
$timeFrameDao = new TimeFrameDao($em);
$MealOrderDao = new OrderDao($em);

$orderEnable = false;
$mealPerDay = 40;
$config = $configDao->getByKey('mealPerDay');
if (isset($config))
    $mealPerDay = $config->getValue();
//get all order in time window
$todayMealOrder = $MealOrderDao->getCurrentMealOrder();
if (sizeof($todayMealOrder) >= $mealPerDay)
    $orderEnable = true;
//check time
$orderEnable = Utils::isOrderEnable();

if (isset($_GET) && isset($_GET['courseID'])) {
    /** @var $course  Course */
    $course = $courseDao->getByPrimaryKey($_GET['courseID']);
    if ($course != null) {
        ?>
        <script type="text/javascript">
            $(document).on('click', '#mealForm input[type="submit"]', function (e) {
                e.preventDefault();
                $('#feedback').html('');
                $('#feedback').hide();
                var requiredFree = true;
                var drinkSelected = false;
                if ($('input[name="drink"]:checked').length > 0)
                    drinkSelected = true;
                if (drinkSelected && requiredFree) {
                    $($(this).parents('form')[0]).submit();
                } else if (!drinkSelected) {
                    $('#feedback').html('Veuillez selectionner une boisson');
                    $('#feedback').show();
                }
            });

        </script>
        <form action="<?php echo WEB_PATH; ?>?page=cart" method="post" id="mealForm">
            <input type="hidden" value="<?php echo $course->getId(); ?>" name="course" id="course"/>
            <input type="hidden" value="<?php echo time(); ?>" name="ts"/>
            <article class="course">
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?php echo APP_PATH; ?>files/course/<?php echo $course->getId(); ?>.jpg" alt="" class="img-responsive">
                    </div>
                    <div class="col-md-8">
                        <h2><?php echo $course->getName(); ?></h2>

                        <p>
                            <?php echo $course->getDescription(); ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <section class="drinkOptions col-md-6">
                        <h4>Choisissez une boisson :</h4>
                        <?php
                        foreach ($drinkDao->getAll() as $drink) {
                            ?>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="drink" class="required" required id="<?php echo $drink->getId(); ?>" value="<?php echo $drink->getId(); ?>">
                                    <?php echo $drink->getName() ?>
                                </label>
                            </div>
                            <?php
                        }
                        ?>
                    </section>
                    <div id="feedback" class="alert alert-danger" style="display: none">

                    </div>
                </div>
                <section class="validateCourse">
                    <div class="row">
                        <?php
                        if ($orderEnable) {
                            ?>
                            <div class="alert alert-warning">
                                Réservations non disponibles de 12h à 14h
                            </div>
                            <?php
                        }
                        ?>
                        <div class="col-md-4 col-md-offset-4">
                            <a href="<?php WEB_PATH ?>?page=course" class="btn btn-default">Revenir à la sélection</a>
                            <input type="submit" class="btn btn-green" value="Réserver" <?php if ($orderEnable) echo "disabled"; ?>/>
                        </div>
                    </div>
                </section>
            </article>
        </form>
        <?php
    }
} else {
    header("location:" . WEB_PATH);
}
?>
