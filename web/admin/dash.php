<?php
/*-----------------------------------------------------*/
/*      _____           _               ___   ___      */
/*     |  __ \         | |             |__ \ / _ \     */
/*     | |__) |___  ___| |_ _   _ ___     ) | (_) |    */
/*     |  _  // _ \/ __| __| | | / __|   / / \__, |    */
/*     | | \ \  __/ (__| |_| |_| \__ \  / /_   / /     */
/*     |_|  \_\___|\___|\__|\__,_|___/ |____| /_/      */
/*                                                     */
/*                Date: 15/10/2015 23:55               */
/*                 All right reserved                  */
/*-----------------------------------------------------*/

use MealBooker\model\TimeFrame;
use MealBooker\models\dao\ConfigDao;
use MealBooker\models\dao\CourseDao;
use MealBooker\models\dao\DrinkDao;
use MealBooker\models\dao\OrderDao;
use MealBooker\models\dao\DessertDao;
use MealBooker\models\dao\TimeFrameDao;
use MealBooker\utils\Utils;

$configDao = new ConfigDao($em);
$MealOrderDao = new OrderDao($em);
$courseDao = new CourseDao($em);
$drinkDao = new DrinkDao($em);
$dessertDao = new DessertDao($em);
$timeFrameDao = new TimeFrameDao($em);
$mealPerDay = 40;
/** @var TimeFrame[] $timeFrames */
$timeFrames = [];

foreach ($timeFrameDao->getAll() as $tf) {
    if ($tf->getStatus() == 1)
        array_push($timeFrames, $tf);
}


$config = $configDao->getByKey('mealPerDay');
if (isset($config))
    $mealPerDay = $config->getValue();
//set ref date for display
$refDate = new DateTime();
if ($refDate > (new DateTime())->setTime(STARTBOOKINGHOUR, STARTBOOKINGMINUTE)) {
    $refDate->add(new DateInterval('P1D'));
}
//get all order in time window
$todayMealOrder = $MealOrderDao->getCurrentMealOrder();

?>

<h3>
    <!--Commande du jour --><?php /*echo sizeof($todayMealOrder) . "/" . $mealPerDay */ ?>
    <small class="pull-right"><?php echo Utils::formatDate($refDate) ?></small>
</h3>
<div class="clearfix"></div>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Utilisateur</th>
            <th>Composition</th>
            <th>Livraison</th>
        </tr>
        </thead>
        <tbody>
        <?php
            if (sizeof($todayMealOrder) > 0) {
                foreach ($todayMealOrder as $mealOrder) {
                    ?>
                    <tr>
                        <td><?php echo sprintf("%04s", $mealOrder->getId()); ?></td>
                        <td><?php echo $mealOrder->getUser()->getFormattedName(); ?></td>
                        <td>
                            <ul>
                                <?php
                                foreach ($mealOrder->getMeals() as $meal) {
                                    echo "<li>" . $meal->getCourse()->getName();
                                    if ($meal->getDrink() != null)
                                        echo " - " . $meal->getDrink()->getName();
                                    if ($meal->getDessert())
                                        echo " - " . $meal->getDessert()->getName();
                                    echo " </li>";
                                }
                                ?>
                            </ul>
                        <td><?php echo $mealOrder->getTimeFrame()->getStart(); ?></td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="4">Aucune commande</td>
                </tr>
                <?php
            }
        ?>
        </tbody>
    </table>
</div>


