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
use MealBooker\models\dao\CourseDao;
use MealBooker\models\dao\DrinkDao;
use MealBooker\models\dao\TimeFrameDao;

$courseDao = new CourseDao($em);
$drinkDao = new DrinkDao($em);
$timeFrameDao = new TimeFrameDao($em);

//prepare new value
$mealCart = new stdClass();
$mealCart->cart = [];
//get value from cookie if cookie already set
if (isset($_COOKIE['mealCart'])) {
    $mealCart = json_decode($_COOKIE['mealCart']);
}
//add new value in cookie
if ($_POST && isset($_POST['course']) && isset($_POST['drink']) && isset($_POST['ts'])) {
    //search for doubloon
    $found = false;
    foreach ($mealCart->cart as $stockedMeal) {
        if ($stockedMeal->id == $_POST['ts'])
            $found = true;
    }
    //if meal stub not in current array
    if (!$found) {
        $object = new stdClass();
        $object->id = $_POST['ts'];
        $object->course = $_POST['course'];
        $object->drink = $_POST['drink'];
        array_push($mealCart->cart, $object);
        setcookie("mealCart", json_encode($mealCart));
    }
};
?>

<div class="row">
    <form action="<?php echo WEB_PATH; ?>?page=cartconfirm" method="post">
        <h2>
            Mes commandes
        </h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Plats</th>
                <th>Boissons</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (sizeof($mealCart->cart) > 0) {
                foreach ($mealCart->cart as $meal) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $courseDao->getByPrimaryKey($meal->course); ?>
                        </td>
                        <td>
                            <?php echo $drinkDao->getByPrimaryKey($meal->drink); ?>
                        </td>
                        <td>
                            <a href="#" class="remove" id="">
                                <i class="fa fa-remove"></i>
                            </a>
                        </td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="5">Aucune commande</td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>

        <div class="timeOptions">

            <h4>Horaire de livraison </h4>

            <p>
                <?php
                $date = new DateTime();
                $after = new DateTime();
                $after->setTime(STARTBOOKINGHOUR, 00);
                if ($date > $after)
                    $date->add(new DateInterval('P1D'));

                ?>
                Le <?php echo \MealBooker\utils\Utils::formatDate($date); ?> à :
            </p>

            <select name="timeframe" id="tf" class="required">
                <?php
                foreach ($timeFrameDao->getAllEnabled() as $timeFrame) {
                    ?>
                    <option value="<?php echo $timeFrame->getId(); ?>"><?php echo $timeFrame->getStart() ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="validateCourse">
            <div class="row">
                <div class="col-md-offset-3 col-md-6" style="text-align: center">
                    <a href="<?php echo WEB_PATH ?>" class="btn btn-default">Completer ma commande</a>

                    <input type="submit" class="btn btn-green" value="Valider ma commande"/><br>
                    <a href="<?php WEB_PATH ?>?page=cart" style="margin-top: 15px; display: inline-block">
                        Vider mon panier
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>