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
use MealBooker\manager\MailManager;
use MealBooker\manager\SecurityManager;
use MealBooker\model\Meal;
use MealBooker\model\MealOrder;
use MealBooker\models\dao\CourseDao;
use MealBooker\models\dao\DessertDao;
use MealBooker\models\dao\DrinkDao;
use MealBooker\models\dao\LocationDao;
use MealBooker\models\dao\MealDao;
use MealBooker\models\dao\OrderDao;
use MealBooker\models\dao\TimeFrameDao;

require_once('../config/global.php');

$courseDao = new CourseDao($em);
$drinkDao = new DrinkDao($em);
$dessertDao = new DessertDao($em);
$timeFrameDao = new TimeFrameDao($em);
$locationDao = new LocationDao($em);
$orderDao = new OrderDao($em);
$mealDao = new MealDao($em);

//if no cart or not logged in
if (!SecurityManager::get()->isAuthentified($_SESSION) || !isset($_SESSION['mealCart'])) {
    header('Location:'.SERVER_URL.WEB_PATH.'404');
} else {
    $mealCart = json_decode($_SESSION['mealCart']);
    if (sizeof($mealCart->cart) > 0) {
        $order = new MealOrder();
        $order->setUser(SecurityManager::get()->getCurrentUser($_SESSION));
        $order->setAddress($order->getUser()->getAddress());
        $order->setDeliveryDate((new DateTime())->setTimestamp($mealCart->deliveryDate));
        //fill order with meal
        $mealArray = array();
        foreach ($mealCart->cart as $mealStub) {
            $drink = $drinkDao->getByPrimaryKey($mealStub->drink);
            $dessert = $dessertDao->getByPrimaryKey($mealStub->dessert);
            $course = $courseDao->getByPrimaryKey($mealStub->course);
            if ($drink != null && $course != null) {
                $meal = new Meal();
                $meal->setBookingId($mealStub->id);
                if ($drink != null)
                    $meal->setDrink($drink);
                if ($dessert != null)
                    $meal->setDessert($dessert);
                $meal->setCourse($course);
                $meal->setOrder($order);
                array_push($mealArray, $meal);
            }
        }
        $order->setMeals($mealArray);
        $orderDao->save($order);
        if (isset($_SESSION['mealCart'])) {
            unset($_SESSION['mealCart']);
        }
        MailManager::get()->sendOrderConfirmation(SecurityManager::get()->getCurrentUser($_SESSION), $order);
        MailManager::get()->sendOrderConfirmationToAdmin($order);
        ?>
        <div class="success">
            <i class="fa fa-check-circle"></i>

            <h1>Votre commande est validée!</h1>

            <p>
                Votre commande de repas est validée, vous allez recevoir un mail récapitulatif de votre commande.
                <br>
                A bientôt sur Aurore Traiteur
            </p>
            <a href="<?php echo WEB_PATH; ?>" class="btn btn-default">Retour à l'accueil</a>
        </div>
        <?php
    } else {
        header('Location : ' . SERVER_URL . WEB_PATH . WEB_PATH .'404');
    }
}
?>