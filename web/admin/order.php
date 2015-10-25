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
use MealBooker\models\dao\MealDao;
use MealBooker\utils\Utils;

$mealDao = new MealDao($em);
?>
<div class="row">
    <div class="row">
        <a class="btn btn-green pull-right" href="#">Créer</a>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Début</th>
            <th>Fin</th>
            <th>Statut</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($mealDao->getAll() as $meal) {
            ?>
            <tr>
                <td><?php echo $meal->getId();?></td>
                <td><?php echo Utils::get()->formatDate($meal->getCreated());?></td>
                <td><?php echo $meal->getCourse()->getName();?></td>
                <td><?php echo $meal->getDrink()->getName();?></td>
                <td><?php echo $meal->getTimeFrame()->__toString();?></td>
                <td><?php echo $meal->getUser()->getFormattedName() . " (" . $meal->getUser()->getCompany()->getName().")";?></td>
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