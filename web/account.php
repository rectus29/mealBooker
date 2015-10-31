<?php
/*-----------------------------------------------------*/
/*      _____           _               ___   ___      */
/*     |  __ \         | |             |__ \ / _ \     */
/*     | |__) |___  ___| |_ _   _ ___     ) | (_) |    */
/*     |  _  // _ \/ __| __| | | / __|   / / \__, |    */
/*     | | \ \  __/ (__| |_| |_| \__ \  / /_   / /     */
/*     |_|  \_\___|\___|\__|\__,_|___/ |____| /_/      */
/*                                                     */
/*                Date: 23/09/2015                     */
/*                 All right reserved                  */
/*-----------------------------------------------------*/


use MealBooker\manager\SecurityManager;
use MealBooker\utils\Utils;

$user = SecurityManager::get()->getCurrentUser($_SESSION);
if (isset($user) && $user == null)
    header('Location: ' . WEB_PATH);

?>
<div class="page-header">
    <h1>Mon compte</h1>
</div>
<div class="row">

    <strong>Nom :</strong> <?php echo $user->getFirstName(); ?><br>
    <strong>Prénom :</strong> <?php echo $user->getLastName(); ?><br>
    <strong>Mail :</strong> <?php echo $user->getMail(); ?><br>
    <strong>Téléphone :</strong> <?php echo $user->getPhoneNumber(); ?><br>
    <strong>Date d'inscription :</strong> <?php echo $user->getCreated()->format('d M Y'); ?><br>
    <strong>Société :</strong> <?php echo $user->getCompany()->getName(); ?><br>

</div>
<div class="row">
    <h2>Historique de mes commandes</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Date</th>
            <th>Commande</th>
            <th>Horaire</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($user->getOrders() as $mealOrder) {
            ?>
            <tr>
                <td><?php echo $mealOrder->getId(); ?></td>
                <td><?php echo Utils::formatDate($mealOrder->getCreated()); ?></td>
                <td>
                    <ul>
                        <?php
                        foreach ($mealOrder->getMeals() as $meal) {
                            echo "<li>" . $meal->getCourse()->getName() . " - " . $meal->getDrink()->getName() . " </li>";
                        }
                        ?>
                    </ul>
                </td>
                <td><?php echo $mealOrder->getTimeFrame()->getStart();?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
