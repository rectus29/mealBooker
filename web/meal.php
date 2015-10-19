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
use MealBooker\models\dao\CourseDao;

if (isset($_GET) && isset($_GET['courseID'])) {
    $courseDao = new CourseDao($em);
    /** @var $course  Course */
    $course = $courseDao->findByPrimaryKey($_GET['courseID']);
    var_dump($course);
    if ($course != null) {
        ?>
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

                    <a href="#" class="btn btn-green">Réserver</a>

                </div>

            </div>
        </article>
    <?php
    }
} else {
    header("location:");
}
?>