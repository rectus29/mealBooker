<?php
/*-----------------------------------------------------*/
/*      _____           _               ___   ___      */
/*     |  __ \         | |             |__ \ / _ \     */
/*     | |__) |___  ___| |_ _   _ ___     ) | (_) |    */
/*     |  _  // _ \/ __| __| | | / __|   / / \__, |    */
/*     | | \ \  __/ (__| |_| |_| \__ \  / /_   / /     */
/*     |_|  \_\___|\___|\__|\__,_|___/ |____| /_/      */
/*                                                     */
/*                Date: 04/10/2015 17:41               */
/*                 All right reserved                  */
/*-----------------------------------------------------*/
use MealBooker\model\Course;
use MealBooker\models\dao\CourseDao;
use MealBooker\models\dao\DrinkDao;
use MealBooker\models\dao\TimeFrameDao;

$courseDao = new CourseDao($em);
$drinkDao = new DrinkDao($em);
$timeFrameDao = new TimeFrameDao($em);

if (isset($_GET) && isset($_GET['courseID'])) {
    /** @var $course  Course */
    $course = $courseDao->findByPrimaryKey($_GET['courseID']);
    if ($course != null) {
        ?>
        <form action="">
            <article class="course">
                <div class="row">

                    <div class="col-md-4">
                        <img src="img/crepe-chocolat.jpg" alt="" class="img-responsive">
                    </div>

                    <div class="col-md-8">
                        <h2><?php echo $course->getName(); ?></h2>

                        <p class="date">
                            <?php echo $course->getUpdated()->format('d M Y') ?>
                        </p>

                        <p>
                            <?php echo $course->getDescription(); ?>
                        </p>
                    </div>
                </div>
            </article>
            <article>
                <div>
                    Choisissez une boisson :
                </div>
                <div class="row">
                    <?php
                    foreach ($drinkDao->findAll() as $drink) {
                        ?>
                        <div class="col-md-3">
                            <div>
                                <img src="img/crepe-chocolat.jpg" alt="" class="img-responsive">
                            </div>
                            <div>
                                <h4>
                                    <?php echo $drink->getName() ?>
                                </h4>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </article>
            <article>
                <p>Choisissez un horaire de livraison :</p>
                <select name="timeframe" id="tf">
                    <?php
                        foreach($timeFrameDao->findAll() as $timeFrame) {
                            ?>
                            <option value="<?php echo $timeFrame->getId(); ?>"><?php echo $timeFrame->getStart() . " - " . $timeFrame->getStop() ?></option>
                        <?php
                        }
                    ?>
                </select>
            </article>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <a href="#" class="btn btn-default">Revenir à la sélection</a>
                    <a href="#" class="btn btn-green">Réserver</a>
                </div>
            </div>
        </form>
    <?php
    }
} else {
    header("location:");
}
?>