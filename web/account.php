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

$user = SecurityManager::get()->getCurrentUser($_SESSION);
if (isset($user) && $user == null)
    header('Location: ' . WEB_PATH);

?>
<div class="page-header">
    <h1>Mon compte</h1>
</div>
<div class="row">

    Nom <?php echo $user->getFirstName(); ?><br>
    Prénom <?php echo $user->getLastName(); ?><br>
    Mail <?php echo $user->getMail(); ?><br>
    Téléphone <?php echo $user->getPhoneNumber(); ?><br>
    Date d'inscription <?php echo $user->getCreated()->format('d M Y'); ?><br>
    Société <?php echo $user->getCompany()->getName(); ?><br>

</div>
<div class="row">
    <h2>Historique de vos commandes</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Date</th>
            <th>Commande</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($user->getMeals() as $meal) {
            ?>
            <tr>
                <td><?php $meal->getBookingId() ?></td>
                <td><?php $meal->getCreated() ?></td>
                <td><?php $meal->getCourse() . " " . $meal->getDrink() ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
