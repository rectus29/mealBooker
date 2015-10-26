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
    $course = $courseDao->getByPrimaryKey($_GET['courseID']);
    if ($course != null) {
        ?>
        <script type="text/javascript">
            $(document).on('click', '.drinkElement', function(e){
                e.preventDefault();
                var el = $(this);
                $('.drinkElement').removeClass('selected');
                $('#drink').val($(el).attr('id'));
                el.addClass('selected');
            });
        </script>
        <form action="<?php echo APP_PATH;?>/web/?page=cart" method="post" id="mealForm">
            <input type="hidden" value="<?php echo $course->getId(); ?>" name="course" id="course"/>
            <input type="hidden" value="" name="drink" id="drink" />
            <input type="hidden" value="<?php echo time(); ?>" name="ts" />
            <article class="course">
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?php echo APP_PATH; ?>files/course/<?php echo $course->getId(); ?>.jpg" alt="" class="img-responsive">
                    </div>
                    <div class="col-md-8">
                        <h2><?php echo $course->getName(); ?></h2>
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
                    foreach ($drinkDao->getAll() as $drink) {
                        ?>
                        <a href="#" class="col-md-3 drinkElement" id="<?php echo $drink->getId(); ?>">
                            <div>
                                <img src="<?php echo APP_PATH; ?>files/drink/<?php echo $drink->getId(); ?>.jpg" alt="" class="img-responsive">
                            </div>
                            <div>
                                <h4>
                                    <?php echo $drink->getName() ?>
                                </h4>
                            </div>
                        </a>
                        <?php
                    }
                    ?>
                </div>
            </article>
            <article>
                <div>
                    Choisissez un horaire de livraison :
                    <select name="timeframe" id="tf">
                        <?php
                        foreach ($timeFrameDao->getAll() as $timeFrame) {
                            ?>
                            <option value="<?php echo $timeFrame->getId(); ?>"><?php echo $timeFrame->getStart() . " - " . $timeFrame->getStop() ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </article>
            <br><br>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <a href="<?php WEB_PATH ?>?page=course" class="btn btn-default">Revenir à la sélection</a>
                    <input type="submit" id="submit" class="btn btn-green" value="Réserver"/>
                </div>
            </div>
        </form>
        <?php
    }
} else {
    header("location:");
}
?>