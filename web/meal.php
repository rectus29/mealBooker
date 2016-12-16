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
use MealBooker\models\dao\DessertDao;
use MealBooker\models\dao\DrinkDao;
use MealBooker\models\dao\OrderDao;
use MealBooker\models\dao\TimeFrameDao;
use MealBooker\utils\Utils;

$courseDao = new CourseDao($em);
$drinkDao = new DrinkDao($em);
$dessertDao = new DessertDao($em);
$timeFrameDao = new TimeFrameDao($em);
$MealOrderDao = new OrderDao($em);

//if no ID go to home
if (!isset($_GET['courseID']))
    header("location:" . WEB_PATH);

/** @var $course  Course */
$course = $courseDao->getByPrimaryKey($_GET['courseID']);
$message = null;

//if no course found go to home
if ($course == null)
    header("location:" . WEB_PATH);

$orderEnable = true;
$mealPerDay = $course->getNbPerDay();
//get all order in time window
$todayMealOrder = $MealOrderDao->getCurrentMealOrderForCourse($course);
$remainingCourse = $mealPerDay - sizeof($todayMealOrder);
if (sizeof($todayMealOrder) >= $mealPerDay){
    $message = "Ce plat n'est plus disponible";
    $orderEnable = false;
}else if(!Utils::isOrderEnable()){
    //check time
    $message = "Réservations non disponibles de 11h à 14h";
    $orderEnable = false;
}

?>
<script type="text/javascript">
    $(document).on('click', '#mealForm input[type="submit"]', function (e) {
        e.preventDefault();
        $('#feedback').html('');
        $('#feedback').hide();
        var requiredFree = true;
        var drinkSelected = false;
        var dessertSelected = false;
        if ($('input[name="drink"]:checked').length > 0)
            drinkSelected = true;
        if ($('input[name="dessert"]:checked').length > 0)
            dessertSelected = true;
        if (drinkSelected && dessertSelected && requiredFree) {
            $($(this).parents('form')[0]).submit();
        } else if (!drinkSelected) {
            $('#feedback').html('Veuillez selectionner une boisson');
            $('#feedback').show();
        } else if (!dessertSelected) {
            $('#feedback').html('Veuillez selectionner un dessert');
            $('#feedback').show();
        }
    });

</script>
<form action="<?php echo WEB_PATH; ?>?page=cart" method="post" id="mealForm">
    <input type="hidden" value="<?php echo $course->getId(); ?>" name="course" id="course"/>
    <input type="hidden" value="<?php echo time(); ?>" name="ts"/>

    <div class="course">
        <div class="row">
            <div class="col-md-4">
                <img src="<?php echo APP_PATH; ?>files/course/<?php echo $course->getImg(); ?>" alt="" class="img-responsive">
            </div>
            <div class="col-md-8">
                <div class="pull-right">
                    <?php echo $remainingCourse; ?>&nbsp;Restant(s)
                </div>
                <h2>
                    <?php echo $course->getName(); ?>
                </h2>

                <p>
                    <?php echo $course->getDescription(); ?>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="drinkOptions col-md-6">
                <h4>Boisson :</h4>
                <?php
                foreach ($drinkDao->getAllEnabled() as $drink) {
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
            </div>
            <div class="drinkOptions col-md-6">
                <h4>Dessert :</h4>
                <?php
                foreach ($dessertDao->getAllEnabled() as $dessert) {
                    ?>
                    <div class="radio">
                        <label>
                            <input type="radio" name="dessert" class="required" required id="<?php echo $dessert->getId(); ?>" value="<?php echo $dessert->getId(); ?>">
                            <?php echo $dessert->getName() ?>
                        </label>
                    </div>
                    <?php
                }
                ?>
            </div>

        </div>
        <div id="feedback" class="alert alert-danger" style="display: none">

        </div>
        <div class="validateCourse">
            <div class="row">
                <?php
                if ($message != null) {
                    echo '<div class="alert alert-warning">';
                    echo $message;
                    echo '</div>';
                }
                ?>
                <div class="col-md-4 col-md-offset-4">
                    <a href="<?php WEB_PATH ?>?page=course" class="btn btn-warning">Revenir à la sélection</a>
                    <input type="submit" class="btn btn-green" value="Réserver" <?php if (!$orderEnable) echo "disabled"; ?>/>
                </div>
            </div>
        </div>
    </div>
</form>
