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

foreach ($gDao->findAll(Course::class) as $course) {
    ?>
    <article class="course">
        <div class="row">

            <div class="col-md-4">
                <a href="#" class="card">
                    <div class="meal-thumbnail">
                        <img src="img/feu.jpg" alt="" class="img-responsive">

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
        </div>
    </article>
    <?php
}
?>

<article class="course">
  <div class="row">

    <div class="col-md-4">
      <img src="img/crepe-chocolat.jpg" alt="" class="img-responsive">
    </div>

    <div class="col-md-8">
      <h2>Plaid slow-carb</h2>
      <p class="date">
        Le 12 octobre 2015
      </p>

      <p>Pitchfork blog Schlitz hella umami.
      Readymade beard cred forage tattooed art party. Vinyl scenester
      polaroid 3 wolf moon keytar butcher. Locavore cold-pressed,
      Portland 90's chambray viral meditation actually pour-over Echo Park cardigan.
      </p>

      <a href="#" class="btn btn-green">Réserver</a>

    </div>

  </div>
</article>
