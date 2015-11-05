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
use MealBooker\models\dao\CourseDao;

$courseDao = new CourseDao($em);
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
        foreach ($courseDao->getAll() as $course) {
            ?>
            <tr>
                <td><?php echo $course->getId();?></td>
                <td><?php echo $course->getName();?></td>
                <td><?php echo $course->getCreated()->format('d M Y');?></td>
                <td><?php echo ($course->getStatus()==1)?'Actif':'Inactif';?></td>
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
</div>