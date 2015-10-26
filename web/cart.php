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
use MealBooker\model\Meal;
use MealBooker\models\dao\CourseDao;
use MealBooker\models\dao\DrinkDao;
use MealBooker\models\dao\TimeFrameDao;

$courseDao = new CourseDao($em);
$drinkDao = new DrinkDao($em);
$timeFrameDao = new TimeFrameDao($em);

//prepare new value
$mealCart = ["cart" => []];
//get value from cookie if cookie already set
if (isset($_COOKIE['mealCart'])) {
    $mealCart = json_decode($_COOKIE['mealCart']);
}
var_dump($mealCart);
//add new value in cookie
if ($_POST && isset($_POST['course']) && isset($_POST['drink']) && isset($_POST['timeframe']) && isset($_POST['ts'])) {
    //search for doubloon
    $found = false;
    foreach ($mealCart->cart as $stockedMeal) {
        if ($stockedMeal->id == $_POST['ts'])
            $found = true;
    }
    //if meal stub not in current array
    if (!$found) {
        array_push($mealCart->cart, ['id' => $_POST['ts'], 'course' => $_POST['course'], 'drink' => $_POST['drink'], 'timeframe' => $_POST['timeframe']]);
        setcookie("mealCart", json_encode($mealCart));
    }
    var_dump($mealCart);
};
?>

<div class="row">
    <h2>
        Votre panier
    </h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Plats</th>
            <th>Boisson</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($mealCart->cart as $meal) {
            ?>
            <tr>
                <td>
                    <?php echo $meal->id; ?>
                </td>
                <td>
                    <?php echo $courseDao->getByPrimaryKey($meal->course); ?>
                </td>
                <td>
                    <?php echo $drinkDao->getByPrimaryKey($meal->drink); ?>
                </td>
                <td>
                    <?php echo $timeFrameDao->getByPrimaryKey($meal->timeframe); ?>
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
            <a href="#" class="btn btn-red">
                Vider mon panier
            </a>
            <a href="#" class="btn btn-green">
                Valider ma commande
            </a>
        </div>
    </div>
</div>