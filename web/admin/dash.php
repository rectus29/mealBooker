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

use MealBooker\models\dao\ConfigDao;
use MealBooker\models\dao\OrderDao;
use MealBooker\manager\SecurityManager;
use MealBooker\model\Meal;
use MealBooker\model\MealOrder;
use MealBooker\models\dao\CourseDao;
use MealBooker\models\dao\DrinkDao;
use MealBooker\models\dao\MealDao;
use MealBooker\models\dao\TimeFrameDao;
use MealBooker\utils\Utils;

$configDao = new ConfigDao($em);
$MealOrderDao = new OrderDao($em);
$mealPerDay = 40;

$config = $configDao->getByKey('mealPerDay');
if (isset($config))
    $mealPerDay = $config->getValue();

//set min date
$startDate = new DateTime();
$startDate->sub(new DateInterval('P1D'));
$startDate->setTime(14, 0);
//set min date
$stopDate = new DateTime();
$stopDate->setTime(12, 0);
//get all order in time window
$todayMealOrder = $MealOrderDao->getMealOrderBetween($startDate, $stopDate);

?>

<h3>Commande du jour <?php echo sizeof($todayMealOrder) . "/" . $mealPerDay ?>
    <small class="pull-right"><?php echo Utils::formatDate(new DateTime(), "d M Y")?></small>
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
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($todayMealOrder as $mealOrder) {
            ?>
            <tr>
                <td><?php echo $mealOrder->getId();?></td>
                <td><?php echo $mealOrder->getUser()->getFormattedName() ."(" . $mealOrder->getUser()->getCompany()->getName() . ")";?></td>
                <td>
                    <ul>
                        <?php
                        foreach ($mealOrder->getMeals() as $meal) {
                            echo "<li>" . $meal->getCourse()->getName() . " - " . $meal->getDrink()->getName() . " </li>";
                        }
                        ?>
                    </ul>
                <td><?php echo $mealOrder->getTimeFrame()->getStart();?></td>
                <td>
                    <i class="fa fa-trash"></i>
                    <i class="fa fa-edit"></i>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>



