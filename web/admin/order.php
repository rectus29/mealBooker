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
use MealBooker\models\dao\OrderDao;
use MealBooker\utils\Utils;

$orderDao = new OrderDao($em);
?>
<div class="row">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Date de réservation</th>
            <!--<th>Horaire</th>-->
            <th>Lieu de livraison</th>
            <th>Composition</th>
            <th>Utilisateur</th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach ($orderDao->getAll() as $order) {
            ?>
            <tr>
                <td><?php echo sprintf("%04s", $order->getId()); ?></td>
                <td><?php echo Utils::formatDate($order->getCreated(), "d/m/Y H:m"); ?></td>
                <!--<td><?php echo ($order->getTimeFrame()!= null)?$order->getTimeFrame()->__toString():"-"; ?></td>-->
                <td><?php echo ($order->getLocation() != null)?$order->getLocation()->getName():"-"; ?></td>
                <td>
                    <ul>
                        <?php
                        foreach ($order->getMeals() as $meal) {
                            echo "<li>" . $meal->getCourse()->getName();
                            if($meal->getDrink() != null )
                                echo " - " . $meal->getDrink()->getName();
                            if($meal->getDessert() != null )
                                echo " - " . $meal->getDessert()->getName();
                            echo  " </li>";
                        }
                        ?>
                    </ul>
                </td>
                <td><?php echo $order->getUser()->getFormattedName(); ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
<div class="row">
    <a class="btn btn-green pull-right" href="#" disabled>Créer</a>
</div>