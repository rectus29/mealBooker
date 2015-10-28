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
use MealBooker\model\Meal;
use MealBooker\models\dao\CourseDao;

$courseDao = new CourseDao($em);

?>
<p>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere, lacus sit amet rhoncus semper, risus justo euismod justo, vitae commodo velit dui eu lacus. Nam iaculis enim dolor, nec sodales lorem sollicitudin condimentum. Pellentesque sed enim enim. Pellentesque dapibus nisl eget arcu sagittis porttitor. Suspendisse feugiat nec odio imperdiet maximus. Maecenas fringilla nulla vitae ante mattis placerat. Morbi dictum neque quis dui fringilla auctor. Cras bibendum feugiat leo, et tincidunt risus accumsan ac. Praesent sit amet commodo sapien. Cras consectetur blandit ipsum, vitae dapibus ligula tempus vitae.
</p>
<article class="course">
    <div class="row">
        <?php
        /**
         * @var $course Course
         */
        foreach ($courseDao->getAll() as $course) {
            ?>
            <div class="col-md-6">
                <a href="<?php echo APP_PATH ?>/web/?page=meal&courseID=<?php echo $course->getId(); ?>" class="card">
                    <div class="meal-thumbnail">
                        <img src="<?php echo APP_PATH; ?>files/course/<?php echo $course->getId(); ?>.jpg" alt="" class="img-responsive">

                        <div class="card_date">
                            <p><?php echo $course->getUpdated()->format('d M Y') ?></p>
                        </div>
                    </div>
                    <div class="card_body">
                        <h3><?php echo $course->getName(); ?></h3>

                        <p>
                            <?php echo $course->getDescription(); ?>
                        </p>
                    </div>
                </a>
            </div>

            <?php
        }
        ?>
    </div>
</article>
