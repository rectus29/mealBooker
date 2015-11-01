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
use MealBooker\models\dao\CourseDao;
use MealBooker\models\dao\DrinkDao;
use MealBooker\utils\Utils;

$configDao = new ConfigDao($em);
$MealOrderDao = new OrderDao($em);
$courseDao = new CourseDao($em);
$drinkDao = new DrinkDao($em);
$mealPerDay = 40;

$config = $configDao->getByKey('mealPerDay');
if (isset($config))
    $mealPerDay = $config->getValue();

//set ref date
$refDate = new DateTime();
if($refDate > (new DateTime())->setTime(14,0)){
    $refDate->add(new DateInterval('P1D'));
}
//set min date
$startDate = (new DateTime())->setTimeStamp($refDate->getTimestamp());
$startDate->sub(new DateInterval('P1D'));
$startDate->setTime(14, 0);
//set min date
$stopDate = (new DateTime())->setTimeStamp($refDate->getTimestamp());
$stopDate->setTime(12, 0);
//get all order in time window
$todayMealOrder = $MealOrderDao->getMealOrderBetween($startDate, $stopDate);

$courses = [];
$drinks = [];
foreach($todayMealOrder as $order){
    foreach($order->getMeals() as $meal){
        //sum course type
        if(array_key_exists ($meal->getCourse()->getId() ,$courses))
            $courses[$meal->getCourse()->getId()] = $courses[$meal->getCourse()->getId()]+1;
        else
            $courses[$meal->getCourse()->getId()] = 1;
        //sum drink type
        if(array_key_exists($meal->getDrink()->getId(),$drinks))
            $drinks[$meal->getDrink()->getId()] = $drinks[$meal->getDrink()->getId()]+1;
        else
            $drinks[$meal->getDrink()->getId()] = 1;
    }
}

?>

<h3>Commande du jour <?php echo sizeof($todayMealOrder) . "/" . $mealPerDay ?>
    <small class="pull-right"><?php echo Utils::formatDate($refDate, "d M Y") ?></small>
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
                <td><?php echo $mealOrder->getId(); ?></td>
                <td><?php echo $mealOrder->getUser()->getFormattedName() . "(" . $mealOrder->getUser()->getCompany()->getName() . ")"; ?></td>
                <td>
                    <ul>
                        <?php
                        foreach ($mealOrder->getMeals() as $meal) {
                            echo "<li>" . $meal->getCourse()->getName() . " - " . $meal->getDrink()->getName() . " </li>";
                        }
                        ?>
                    </ul>
                <td><?php echo $mealOrder->getTimeFrame()->getStart(); ?></td>
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
<div class="row">
    <div class="col-md-8">
        <h4>Repas</h4>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Plats</th>
                <th>Nombre</th>
            </tr>
            </thead>
            <tbody>
            <?php
                foreach($courses as $course => $nb){
            ?>
            <tr>
                <td><?php echo $courseDao->getByPrimaryKey($course)->getName()?></td>
                <td><?php echo $nb?></td>
            </tr>
            <?php
                }
            ?>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <h4>Boissons</h4>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Boissons</th>
                <th>Nombre</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($drinks as $drink => $nb){
                ?>
                <tr>
                    <td><?php echo $drinkDao->getByPrimaryKey($drink)->getName()?></td>
                    <td><?php echo $nb?></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>



