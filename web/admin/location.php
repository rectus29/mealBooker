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
use MealBooker\models\dao\LocationDao;

$localDao = new LocationDao($em);
?>
<div class="row">

    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Libellé</th>
            <th>Statut</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // @var $location Location
        foreach ($localDao->getAll() as $location) {
            ?>
            <tr>
                <td><?php echo $location->getId();?></td>
                <td><?php echo $location->getName();?></td>
                <td><?php echo ($location->getStatus()==1)?'Actif':'Inactif';?></td>
                <td>
                    <a href="<?php echo WEB_PATH?>?page=admin&tab=locationedit&id=<?php echo $location->getId() ?>"><i class="fa fa-edit"></i></a>
                </td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>
<div class="row">
    <a class="btn btn-green pull-right" href="<?php echo WEB_PATH ?>?page=admin&tab=locationedit">Créer</a>
</div>