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
use MealBooker\models\dao\CompanyDao;
use MealBooker\models\dao\CourseDao;
use MealBooker\models\dao\DrinkDao;
use MealBooker\models\dao\TimeFrameDao;
use MealBooker\utils\Utils;

$courseDao = new CourseDao($em);
$companyDao = new CompanyDao($em);
$drinkDao = new DrinkDao($em);
$timeFrameDao = new TimeFrameDao($em);
?>
<div class="row">

    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Nom</th>
            <th>Créé le</th>
            <th>Nombre d'utilisateurs</th>
            <th>Statut</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($companyDao->getAll() as $company) {
            ?>
            <tr>
                <td><?php echo $company->getId(); ?></td>
                <td><?php echo $company->getName(); ?></td>
                <td><?php echo Utils::formatDate($company->getCreated()); ?></td>
                <td><?php echo sizeof($company->getUsers()); ?></td>
                <td><?php echo ($company->getStatus() == 1) ? 'Actif' : 'Inactif'; ?></td>
                <td>
                    <a href="<?php echo WEB_PATH ?>?page=admin&tab=companyedit&id=<?php echo $company->getId() ?>"><i class="fa fa-edit"></i></a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
<div class="row">
    <a class="btn btn-green pull-right" href="<?php echo WEB_PATH ?>?page=admin&tab=companyedit">Créer</a>
</div>