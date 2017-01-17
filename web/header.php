<?php
/*-----------------------------------------------------*/
/*      _____           _               ___   ___      */
/*     |  __ \         | |             |__ \ / _ \     */
/*     | |__) |___  ___| |_ _   _ ___     ) | (_) |    */
/*     |  _  // _ \/ __| __| | | / __|   / / \__, |    */
/*     | | \ \  __/ (__| |_| |_| \__ \  / /_   / /     */
/*     |_|  \_\___|\___|\__|\__,_|___/ |____| /_/      */
/*                                                     */
/*                Date: 23/09/2015                     */
/*                 All right reserved                  */
/*-----------------------------------------------------*/

use MealBooker\manager\SecurityManager;

?>
<header>
    <div class="hero">
        <div class="headings">
            <div class="container">
                <a href="<?php echo WEB_PATH; ?>" class="brand"><img src="img/logo.png" alt="Aurore Traiteur"
                                                                     width="150"/></a>

                <p>
                    "Cuisiner suppose une tête légère, un esprit généreux et un coeur large" - Paul Gauguin
                </p>
            </div>
        </div>
        <?php
           include 'nav.php';
        ?>
    </div>
</header>
