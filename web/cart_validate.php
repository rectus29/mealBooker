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
use MealBooker\model\Meal;
use MealBooker\models\dao\CourseDao;
use MealBooker\models\dao\DrinkDao;
use MealBooker\models\dao\TimeFrameDao;

$courseDao = new CourseDao($em);
$drinkDao = new DrinkDao($em);
$timeFrameDao = new TimeFrameDao($em);

if(!isset($_COOKIE['mealCart']) && SecurityManager::get()->isAuthentified($_SESSION))
    header('location :' .APP_PATH);

$mealCart = json_decode($_COOKIE['mealCart']);
foreach($mealCart->cart as $mealStub){
    $meal = new Meal();
    echo $mealStub->id;
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
    <a href="<?php WEB_PATH ?>" class="btn btn-default">Retour à l'accueil</a>
</div>
