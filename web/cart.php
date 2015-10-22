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
use MealBooker\models\dao\DrinkDao;
use MealBooker\models\dao\TimeFrameDao;

$courseDao = new CourseDao($em);
$drinkDao = new DrinkDao($em);
$timeFrameDao = new TimeFrameDao($em);
$mealCart = "";
if (isset($_COOKIE['mealCart'])) {
    $mealCart = $_COOKIE['mealCart'];
}

if ($_POST && isset($_POST['course']) && isset($_POST['drink']) && isset($_POST['timeframe']) && isset($_POST['ts'])) {
    $mealCart .= "{ id:" . $_POST['ts'] . ",course:" . $_POST['course'] . ", drink:" . $_POST['drink'] . ", timeframe:" . $_POST['timeframe'] . "},";
    setcookie("mealCart", $mealCart);
}
$cartObject = json_decode($mealCart);
?>
<div class="row">
    <div>
        Votre panier
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Plats</th>
            <th>Boisson</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($mealCart as $meal) {
            ?>
            <tr>
                <td>
                    <?php echo $meal->getName(); ?>
                </td>
                <td>
                    <?php echo $drink->getName(); ?>
                </td>
                <td>
                    <?php echo $timeFrame->toString(); ?>
                </td>
                <td>
                    <a href="#" class="remove" id="">
                        <i class="fa fa-remove"></i>
                    </a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>

<div class="row">
    <div class="col-md-offset-4 col-md-4">
        <a href="#" class="btn btn-green">
            Valider ma commande
        </a>
    </div>
</div>
</div>