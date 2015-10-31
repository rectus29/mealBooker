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
use MealBooker\models\dao\DrinkDao;
use MealBooker\models\dao\MealDao;
use MealBooker\models\dao\OrderDao;
use MealBooker\models\dao\TimeFrameDao;

$courseDao = new CourseDao($em);
$drinkDao = new DrinkDao($em);
$timeFrameDao = new TimeFrameDao($em);
$orderDao = new OrderDao($em);
$mealDao = new MealDao($em);

//if no cart or not logged in
if((!isset($_COOKIE['mealCart']) && !isset($_POST['timeframe'])) || SecurityManager::get()->isAuthentified($_SESSION))
    header('Location : ' . WEB_PATH);

$mealCart = json_decode($_COOKIE['mealCart']);
if(sizeof($mealCart->cart) > 0){
    $order = new MealOrder();
    $order->setUser(SecurityManager::get()->getCurrentUser($_SESSION));
    $timeframe = $timeFrameDao->getByPrimaryKey($_POST['timeframe']);
    if($timeframe != null)
        $order->setTimeFrame($timeframe);
    //fill oreder with meal
    $mealArray =  array();
    foreach($mealCart->cart as $mealStub){
        $drink = $drinkDao->getByPrimaryKey($mealStub->drink);
        $course = $courseDao->getByPrimaryKey($mealStub->course);
        if($drink != null && $course!= null){
            $meal = new Meal();
            $meal->setBookingId($mealStub->id);
            $meal->setDrink($drink);
            $meal->setCourse($course);
            $meal->setOrder($order);
            array_push($mealArray, $meal);
        }
    }
    $order->setMeals($mealArray);
    $orderDao->save($order);
    MailManager::get()->sendOrderConfirmation($user, $order);
}
if (isset($_COOKIE['mealCart'])) {
    unset($_COOKIE['mealCart']);
    setcookie('mealCart', '', time() - 3600);
}
?>
<div class="success">
    <i class="fa fa-check-circle"></i>

    <h1>Votre commande est validée!</h1>
    <p>
        Votre commande de repas est validée, vous allez recevoir un mail récapitulatif de votre commande.
        <br>
        A bientôt sur Aurore Traiteur
    </p>
    <a href="/" class="btn btn-default">Retour à l'accueil</a>
</div>
