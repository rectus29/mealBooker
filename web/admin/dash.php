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

$configDao = new ConfigDao($em);
$MealOrderDao = new OrderDao($em);
$mealPerDay = 40;

$config = $configDao->getByKey('mealPerDay');
if(isset($config))
    $mealPerDay = $config->getValue();

//set min date
$startDate = new DateTime();
$startDate->sub(new DateInterval('P1D'));
$startDate->setTime(14,0);
//set min date
$stopDate = new DateTime();
$stopDate->setTime(12,0);


var_dump($todayMealOrder = $MealOrderDao->getMealOrderBetween($startDate, $stopDate));

?>

<h3>Commande du jour  <?php echo sizeof($todayMealOrder)."/". $mealPerDay?><small class="pull-right">27 Octobre 2015</small></h3>
<div class="clearfix"></div>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>

                <th>#</th>
                <th>Utilisateur</th>
                <th>Plat</th>
                <th>Boisson</th>
                <th>Livraison</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>#</td>
                <td>Paul Durand</td>
                <td>Escalope Milanaise</td>
                <td>Ice-tea</td>
                <td>12h00 - 12h30</td>
                <td>
                    <i class="fa fa-trash"></i>
                    <i class="fa fa-edit"></i>
                </td>
            </tr>
        </tbody>
    </table>
</div>



