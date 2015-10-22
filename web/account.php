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
    header('Location: /');

?>
<div class="page-header">
    <h1>Mon compte</h1>
</div>
<div class="row">

    <?php echo $user->getFirstName() . " " . $user->getLastName(); ?><br>
    <?php echo $user->getMail(); ?><br>
    <?php echo $user->getPhoneNumber(); ?><br>
    <?php echo $user->getCreated()->format('d M Y'); ?><br>
    <?php
    var_dump($user->getCompany());
    echo $user->getCompany()->getName();
    ?><br>

</div>
<div class="row">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Date</th>
            <th>Commande</th>
            <th>Statut</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        </tbody>
    </table>
</div>
