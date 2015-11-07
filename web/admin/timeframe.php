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
use MealBooker\models\dao\TimeFrameDao;

$tfDao = new TimeFrameDao($em);
?>
<div class="row">

    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Début</th>
            <th>Statut</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($tfDao->getAll() as $tf) {
            ?>
            <tr>
                <td><?php echo $tf->getId();?></td>
                <td><?php echo $tf->getStart();?></td>
                <td><?php echo ($tf->getStatus()==1)?'Actif':'Inactif';?></td>
                <td>
                    <a href="<?php echo WEB_PATH?>?page=admin&tab=timeframeedit&id=<?php echo $tf->getId() ?>"><i class="fa fa-edit"></i></a>
                </td>
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