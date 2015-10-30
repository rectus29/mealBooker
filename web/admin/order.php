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
    <div class="row">
        <a class="btn btn-green pull-right" href="#">Créer</a>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Date de réservation</th>
            <th>Horaire</th>
            <th>Composition</th>
            <th>Utilisateur</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach ($orderDao->getAll() as $order) {
            ?>
            <tr>
                <td><?php echo $order->getId(); ?></td>
                <td><?php echo Utils::get()->formatDate($order->getCreated(), "d M Y H:m"); ?></td>
                <td><?php echo $order->getTimeFrame()->__toString(); ?></td>
                <td>
                    <?php
                    foreach ($order->getMeals() as $meal) {
                        echo $meal->getCourse()->getName() . " - ". $meal->getDrink()->getName()
                        ?>

                        <?php
                    }
                    ?>
                </td>
                <td><?php echo $order->getUser()->getFormattedName() . " (" . $order->getUser()->getCompany()->getName() . ")"; ?></td>
                <td>
                    <a href=""><i class="fa fa-edit"></i></a>
                    <a href=""><i class="fa fa-toggle-on"></i></a>
                    <a href=""><i class="fa fa-remove"></i></a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>