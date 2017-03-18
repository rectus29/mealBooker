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
use MealBooker\manager\SecurityManager;
use MealBooker\models\dao\CourseDao;
use MealBooker\models\dao\DessertDao;
use MealBooker\models\dao\DrinkDao;
use MealBooker\models\dao\LocationDao;
use MealBooker\models\dao\TimeFrameDao;
use MealBooker\utils\Utils;

$courseDao = new CourseDao($em);
$drinkDao = new DrinkDao($em);
$dessertDao = new DessertDao($em);
$timeFrameDao = new TimeFrameDao($em);
$locationDao = new LocationDao($em);


//prepare new value
$mealCart = new stdClass();
$mealCart->cart = [];
//get value from cookie if cookie already set
if (isset($_SESSION['mealCart'])) {
    $mealCart = json_decode($_SESSION['mealCart']);
}

//prepare date for display
$deliveryDate = new DateTime();
$after = new DateTime();
$after->setTime(STARTBOOKINGHOUR, STARTBOOKINGMINUTE);
if ($deliveryDate > $after){
    $deliveryDate->add(new DateInterval('P1D'));

}
//if the current date is in weekend report to the next monday
if(Utils::isWeekend($deliveryDate)){
    $i = 0;
    while(Utils::isWeekend($deliveryDate) && $i < 2){
        $deliveryDate->add(new DateInterval('P1D'));
        $i++;
    }
}

//add new value in cookie
if ($_POST && isset($_POST['course']) && isset($_POST['ts'])) {
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
        $object->drink = (isset($_POST['drink'])) ? $_POST['drink'] : "";
        $object->dessert = (isset($_POST['dessert'])) ? $_POST['dessert'] : "";
        array_push($mealCart->cart, $object);
        //add the delivery date to the cart
        $mealCart->deliveryDate = $deliveryDate->getTimestamp();
        $_SESSION['mealCart'] = json_encode($mealCart);
    }
};

if (isset($_GET['delete'])) {
    $toDelete = $_GET['delete'];
    if ($toDelete != '') {
        for ($i = 0; $i < sizeof($mealCart->cart); $i++) {
            if ($mealCart->cart[$i]->id == $toDelete)
                array_splice($mealCart->cart, $i, 1);
        }
        $_SESSION['mealCart'] = json_encode($mealCart);
    } else {
        $mealCart->cart = [];
        unset($_SESSION['mealCart']);
    }
}
?>

<div class="row">
    <!--<form action="<?php echo WEB_PATH; ?>cart_validate.php" method="post">-->
        <form action="<?php echo WEB_PATH; ?>?page=cartconfirm" method="post">
        <div class="pull-right">
            <a href="<?php WEB_PATH ?>?page=cart&delete" id="cartRemove" style="margin-top: 15px; display: inline-block">
                Vider mon panier
            </a>
        </div>
        <h2>
            Mon panier
        </h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Plats</th>
                <th>Boissons</th>
                <th>Desserts</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (sizeof($mealCart->cart) > 0) {
                foreach ($mealCart->cart as $meal) {
                    $drink = $drinkDao->getByPrimaryKey($meal->drink);
                    $dessert = $dessertDao->getByPrimaryKey($meal->dessert);
                    $course = $courseDao->getByPrimaryKey($meal->course);
                    ?>
                    <tr>
                        <td>
                            <?php echo $course; ?>
                        </td>
                        <td>
                            <?php echo ($drink != null) ? $drink : "-"; ?>
                        </td>
                        <td>
                            <?php echo ($dessert != null) ? $dessert : "-"; ?>
                        </td>
                        <td>
                            <a href="<?php WEB_PATH ?>?page=cart&delete=<?php echo $meal->id; ?>" class="remove" id="cartRemove">
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
            <?php


            ?>
            <h4>Livraison le <?php echo \MealBooker\utils\Utils::formatDate($deliveryDate); ?> entre 9h et 11h </h4>

        </div>
        <?php
        if (SecurityManager::get()->isAuthentified($_SESSION)){
            $user = SecurityManager::get()->getCurrentUser($_SESSION);
            if ($user->getAddress() != null) {
                ?>
                <div class="locationOptions">
                    <h4>Lieu de livraison </h4>
                    <?php echo $user->getAddress()->getFormattedAddress();?>
                </div>
                <?php
            }
        }
        ?>
        <div class="validateCourse">
            <div class="row">
                <div class="col-md-offset-3 col-md-6" style="text-align: center">
                    <?php
                    if(SecurityManager::get()->isAuthentified($_SESSION)){
                        $user = SecurityManager::get()->getCurrentUser($_SESSION);
                        if ($user->getAddress() != null) {
                            echo '<input type="submit" class="btn btn-green"/>';
                        } else {
                            echo '<div class="alert alert-warning">Veuillez renseigner votre adresse dans "Mon compte" pour pouvoir valider votre commande</div>';
                        }
                    }else{
                        echo '<div class="alert alert-warning">Veuillez vous connecter pour pouvoir valider votre commande</div>';
                    }
                    ?>
                    <a href="<?php echo WEB_PATH ?>" class="btn btn-default">Compléter ma commande</a>
                </div>
            </div>
        </div>
    </form>
</div>