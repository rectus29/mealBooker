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

$userDao = new UserDao($em);
?>
<div class="row">

    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Nom</th>
            <th>Mail</th>
            <th>Créé le</th>
            <th>Société</th>
            <th>Rôle</th>
            <th>Statut</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($userDao->getAll() as $user) {
            ?>
            <tr>
                <td><?php echo $user->getId();?></td>
                <td><?php echo $user->getFormattedName();?></td>
                <td><?php echo $user->getMail();?></td>
                <td><?php echo $user->getCreated()->format('d M Y');?></td>
                <td><?php echo $user->getCompany()->getName();?></td>
                <td><?php echo $user->getRole()->getName();?></td>
                <td><?php echo $user->getStatus();?></td>
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
<div class="row">
    <a class="btn btn-green pull-right" href="#">Créer</a>
</div>v