<?php
/*-----------------------------------------------------*/
/*      _____           _               ___   ___      */
/*     |  __ \         | |             |__ \ / _ \     */
/*     | |__) |___  ___| |_ _   _ ___     ) | (_) |    */
/*     |  _  // _ \/ __| __| | | / __|   / / \__, |    */
/*     | | \ \  __/ (__| |_| |_| \__ \  / /_   / /     */
/*     |_|  \_\___|\___|\__|\__,_|___/ |____| /_/      */
/*                                                     */
/*                Date: 02/05/2016 23:10               */
/*                 All right reserved                  */
/*-----------------------------------------------------*/
use MealBooker\model\Course;
use MealBooker\models\dao\CourseDao;

$courseDao = new CourseDao($em);
?>

<div class="row">
    <div class="col-md-12">
        <h1>Bienvenue</h1>

        <p>
            Vous êtes bien sur le système de réservation de repas Aurore Traiteur.<br/>
            Commandez votre déjeuner pour vous le faire livrer à votre entreprise, selon un horaire pré-défini.
        </p>
    </div>
</div>

<div class="row courseGallery">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <?php
            /**
             * @var $courseArray Course[]
             */
            $courseArray = $courseDao->getAllEnabled();
            if (sizeof($courseArray) > 0) {
            for ($i = 0; sizeof($courseArray) > $i; $i++) {
                $course = $courseArray[$i];
                ?>

                <div class="item <?php echo ($i < 1) ? "active" : "" ?> ">
                    <div class="row">
                        <div class="col-md-8 img-wrapper">
                            <img src="<?php echo APP_PATH; ?>files/course/<?php echo $course->getImg(); ?>"
                                 alt="<?php echo $course->getName(); ?>" class="img-responsive">
                        </div>
                        <div class="col-md-4">
                            <div class="">
                                <h3><?php echo $course->getName(); ?></h3>

                                <p><?php echo $course->getDescription(); ?></p>
                                <a href="<?php echo WEB_PATH ?>?page=meal&courseID=<?php echo $course->getId(); ?>"
                                   class="btn btn-warning">Commander</a>
                            </div>
                        </div>
                    </div>
                </div>


                <?php
            }
            ?>

        </div>
        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<?php

} else {
    ?>
    <div>
        Pas de menu disponible actuellement
    </div>
    <?php
}
?>


<!--
 <div class="col-md-4">
                <div class="card">
                    <div class="meal-thumbnail">
                        <a href="<?php echo WEB_PATH ?>?page=meal&courseID=<?php echo $course->getId(); ?>">
                            <img src="<?php echo APP_PATH; ?>files/course/<?php echo $course->getImg(); ?>" alt="" class="img-responsive">
                        </a>
                    </div>
                    <div class="card_body">
                        <h3>
                            <a href="<?php echo WEB_PATH ?>?page=meal&courseID=<?php echo $course->getId(); ?>">
                            <?php echo $course->getName(); ?></h3>
                        </a>
                        <p>
                            <?php echo $course->getDescription(); ?>
                        </p>
                        <a href="<?php echo WEB_PATH ?>?page=meal&courseID=<?php echo $course->getId(); ?>" class="btn btn-warning">Commander</a>
                    </div>
                </div>
            </div>
-->





