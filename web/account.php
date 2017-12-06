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
if (isset($user) && $user == null) {
    header('Location: ' . SERVER_URL . WEB_PATH);
}
?>
<div class="page-header">
    <h1>Mon compte</h1>
</div>
<div class="row">
    <div class="pull-right">
        <a href="<?php echo WEB_PATH . "?page=account_edit" ?>" class="btn btn-default">Editer</a>
    </div>
    <div class="col-md-6">
        <strong>Nom :</strong> <?php echo $user->getLastName(); ?><br>
        <strong>Prénom :</strong> <?php echo $user->getFirstName(); ?><br>
        <strong>Entreprise :</strong> <?php echo $user->getCompany(); ?><br>
        <strong>Adresse de livraison :</strong> <?php
            echo ($user->getAddress() != null)
                ? $user->getAddress()->getFormattedAddress()
                : "-";
        ?><br>
    </div>
    <div class="col-md-6">
        <strong>Mail :</strong> <?php echo $user->getMail(); ?><br>
        <strong>Téléphone :</strong> <?php echo $user->getPhoneNumber(); ?><br>
        <strong>Date d'inscription :</strong> <?php echo Utils::formatDate($user->getCreated()); ?><br>
    </div>
</div>
<div class="row">
    <h2>Historique de mes commandes</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Date de commande</th>
            <th>Commande</th>
            <th>Lieu</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sortedOrder = $user->getOrders()->getValues();
        usort($sortedOrder, function($a, $b){
            /** @var $a  \MealBooker\model\MealOrder */
            /** @var $b  \MealBooker\model\MealOrder */
             if($a->getCreated() > $b->getCreated()){
                 return -1;
             }else if($a->getCreated() < $b->getCreated()){
                 return 1;
             }
             return 0;
        });
        foreach ($sortedOrder as $mealOrder) {
            ?>
            <tr>
                <td><?php echo $mealOrder->getId(); ?></td>
                <td><?php echo Utils::formatDate($mealOrder->getCreated()); ?></td>
                <td>
                    <ul>
                        <?php
                        foreach ($mealOrder->getMeals() as $meal) {
                            echo "<li>" . $meal->getCourse()->getName();
                            if ($meal->getDrink() != null){
                                echo " - " . $meal->getDrink()->getName();
                            }
                            if ($meal->getDessert() != null) {
                                echo " - " . $meal->getDessert()->getName();
                            }
                            echo " </li>";
                        }
                        ?>
                    </ul>
                </td>
                <td><?php echo ($mealOrder->getAddress()!= null)?$mealOrder->getAddress()->getFormattedAddress():"-"; ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
