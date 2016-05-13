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


<div class="row courseGallery">
    <?php
        /**
     * @var $courseArray Course[]
     */
        $courseArray = $courseDao->getAllEnabled();
        if (sizeof($courseArray) > 0) {
        ?>
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <?php
                    for ($i = 0; sizeof($courseArray) > $i; $i++) {
                        ?>
                        <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i ?>" class="<?php echo ($i < 1) ? "active" : "" ?>"></li>
                        <?php
                    }
                ?>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
            <?php
                for ($i = 0; sizeof($courseArray) > $i; $i++) {
                    $course = $courseArray[$i];
                    ?>
                    <div class="item <?php echo ($i < 1) ? "active" : "" ?> ">
                        <div class="row">
                            <div class="col-md-8 img-wrapper" style="background-image:url('<?php echo APP_PATH; ?>files/course/<?php echo $course->getImg(); ?>')">

                            </div>
                            <div class="col-md-4 desc">
                                <div class="caption">
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
                <span class="sr-only">Previous</span>
                <i class="fa fa-chevron-left"></i>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <i class="fa fa-chevron-right"></i>
                <span class="sr-only">Next</span>
            </a>
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
</div>
<div class="row">
    <div class="col-md-12 intro">
        <h1>Bienvenue</h1>

        <p>
            Vous êtes bien sur le système de réservation de repas Aurore Traiteur.<br/>
            Commandez votre déjeuner pour vous le faire livrer à votre entreprise, selon un horaire pré-défini.
        </p>
    </div>
</div>







