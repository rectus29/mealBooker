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

//set ref date
$refDate = new DateTime();
if ($refDate > (new DateTime())->setTime(STARTBOOKINGHOUR, STARTBOOKINGMINUTE)) {
    $refDate->add(new DateInterval('P1D'));
}
//set min date
$startDate = (new DateTime())->setTimeStamp($refDate->getTimestamp());
$startDate->sub(new DateInterval('P1D'));
$startDate->setTime(STARTBOOKINGHOUR, STARTBOOKINGMINUTE);
//set min date
$stopDate = (new DateTime())->setTimeStamp($refDate->getTimestamp());
$stopDate->setTime(STOPBOOKINGHOUR, STOPBOOKINGMINUTE);
//get all order in time window


$todayMealOrder = $MealOrderDao->getMealOrderBetween($startDate, $stopDate);

$timeFramesOrder = [];
foreach ($timeFrames as $tf) {
    $timeFramesOrder[$tf->getStart()] = [];
}
$drinks = [];
$desserts = [];
$courses = [];
foreach ($todayMealOrder as $order) {
    foreach ($order->getMeals() as $meal) {
        if ($meal->getDrink() != null) {
            //build drink by timeframe
            if (array_key_exists($meal->getDrink()->getId(), $drinks)) {
                $drinks[$meal->getDrink()->getId()][$order->getTimeFrame()->getStart()] = $drinks[$meal->getDrink()->getId()][$order->getTimeFrame()->getStart()] + 1;
            } else {
                $drinks[$meal->getDrink()->getId()] = [];
                foreach ($timeFrames as $tf) {
                    $var = ($order->getTimeFrame() == $tf) ? 1 : 0;
                    $drinks[$meal->getDrink()->getId()][$tf->getStart()] = $var;
                }
            }
        }
        if ($meal->getDessert() != null) {
            //build dessert by timeframe
            if (array_key_exists($meal->getDessert()->getId(), $desserts)) {
                $desserts[$meal->getDessert()->getId()][$order->getTimeFrame()->getStart()] = $desserts[$meal->getDessert()->getId()][$order->getTimeFrame()->getStart()] + 1;
            } else {
                $desserts[$meal->getDessert()->getId()] = [];
                foreach ($timeFrames as $tf) {
                    $var = ($order->getTimeFrame() == $tf) ? 1 : 0;
                    $desserts[$meal->getDessert()->getId()][$tf->getStart()] = $var;
                }
            }
        }

        //build courses by timeframe
        if (array_key_exists($meal->getCourse()->getId(), $courses)) {
            $courses[$meal->getCourse()->getId()][$order->getTimeFrame()->getStart()] = $courses[$meal->getCourse()->getId()][$order->getTimeFrame()->getStart()] + 1;
        } else {
            $courses[$meal->getCourse()->getId()] = [];
            foreach ($timeFrames as $tf) {
                $var = ($order->getTimeFrame() == $tf) ? 1 : 0;
                $courses[$meal->getCourse()->getId()][$tf->getStart()] = $var;
            }
        }
    }
    array_push($timeFramesOrder[$order->getTimeFrame()->getStart()], $order);
}
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
        foreach ($timeFramesOrder as $timeFrame => $orders) {
            ?>
            <tr>
                <td colspan="4"><b><?php echo $timeFrame; ?></b></td>
            </tr>
            <?php
            if (sizeof($orders) > 0) {
                foreach ($orders as $mealOrder) {
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
        }
        ?>
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-md-6">
        <h4>Repas</h4>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Plats</th>
                <?php
                /** @var TimeFrame $tf */
                foreach ($timeFrames as $tf) {
                    ?>
                    <th><?php echo $tf->getStart() ?></th>
                    <?php
                }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($courses as $course => $courseData) {
                ?>
                <tr>
                    <td><?php echo $courseDao->getByPrimaryKey($course); ?></td>
                    <?php
                    foreach ($courseData as $tf => $val) {
                        ?>
                        <td><?php echo $val ?></td>
                        <?php
                    }
                    ?>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="col-md-6">
        <h4>Boissons</h4>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Boissons</th>
                <?php
                /** @var TimeFrame $tf */
                foreach ($timeFrames as $tf) {
                    ?>
                    <th><?php echo $tf->getStart() ?></th>
                    <?php
                }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($drinks as $drink => $drinkData) {
                ?>
                <tr>
                    <td><?php echo $drinkDao->getByPrimaryKey($drink); ?></td>
                    <?php
                    foreach ($drinkData as $tf => $val) {
                        ?>
                        <td><?php echo $val ?></td>
                        <?php
                    }
                    ?>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <h4>Desserts</h4>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Desserts</th>
                <?php
                /** @var TimeFrame $tf */
                foreach ($timeFrames as $tf) {
                    ?>
                    <th><?php echo $tf->getStart() ?></th>
                    <?php
                }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($desserts as $dessert => $dessertData) {
                ?>
                <tr>
                    <td><?php echo $dessertDao->getByPrimaryKey($dessert); ?></td>
                    <?php
                    foreach ($dessertData as $tf => $val) {
                        ?>
                        <td><?php echo $val ?></td>
                        <?php
                    }
                    ?>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>


