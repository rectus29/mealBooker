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
use MealBooker\models\dao\DrinkDao;

$drinkDao = new DrinkDao($em);
?>
<div class="row">

    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Nom</th>
            <th>Créé le</th>
            <th>Statut</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($drinkDao->getAll() as $drink) {
            ?>
            <tr>
                <td><?php echo $drink->getId();?></td>
                <td><?php echo $drink->getName();?></td>
                <td><?php echo $drink->getCreated()->format('d M Y');?></td>
                <td><?php echo ($drink->getStatus()==1)?'Actif':'Inactif';?></td>
                <td>
                    <a href="<?php echo WEB_PATH?>?page=admin&tab=drinkedit&id=<?php echo $drink->getId() ?>"><i class="fa fa-edit"></i></a>
                </td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>
<div class="row">
    <a class="btn btn-green pull-right" href="<?php echo WEB_PATH?>?page=admin&tab=drinkedit">Créer</a>
</div>