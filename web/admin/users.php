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
use MealBooker\models\dao\UserDao;
use MealBooker\utils\Utils;

$userDao = new UserDao($em);
?>
<div class="row">

    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Nom</th>
            <th>Mail</th>
            <th>Tél.</th>
            <th>Créé le</th>
            <th>Société</th>
            <th>Démarchable</th>
            <th>Rôle</th>
            <th>Statut</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($userDao->getAll() as $user) {
            ?>
            <tr <?php echo ($user->isOptIn()) ? 'class="success"' : ''; ?>>
                <td><?php echo $user->getId(); ?></td>
                <td><?php echo $user->getFormattedName(); ?></td>
                <td><?php echo $user->getMail(); ?></td>
                <td><?php echo $user->getPhoneNumber(); ?></td>
                <td><?php echo Utils::formatDate($user->getCreated()); ?></td>
                <td><?php echo $user->getCompany(); ?></td>
                <td><?php echo ($user->isOptIn()) ? "Oui" : "Non"; ?></td>
                <td><?php echo $user->getRole()->getName(); ?></td>
                <td><?php echo ($user->getStatus() == 1) ? 'Actif' : 'Inactif'; ?></td>
                <td>
                    <a href="<?php echo WEB_PATH ?>?page=admin&tab=useredit&id=<?php echo $user->getId() ?>"><i class="fa fa-edit"></i></a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
<div class="row">
    <a class="btn btn-green pull-right" href="<?php echo WEB_PATH ?>?page=admin&tab=useredit">Créer</a>
</div>