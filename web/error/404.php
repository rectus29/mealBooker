<?php
/*-----------------------------------------------------*/
/*      _____           _               ___   ___      */
/*     |  __ \         | |             |__ \ / _ \     */
/*     | |__) |___  ___| |_ _   _ ___     ) | (_) |    */
/*     |  _  // _ \/ __| __| | | / __|   / / \__, |    */
/*     | | \ \  __/ (__| |_| |_| \__ \  / /_   / /     */
/*     |_|  \_\___|\___|\__|\__,_|___/ |____| /_/      */
/*                                                     */
/*                Date: 21/10/2015 10:00                */
/*                 All right reserved                  */
/*-----------------------------------------------------*/

require_once('../../config/global.php');
?>
<!DOCTYPE html>
<html>
<?php
include '../head.php';
?>
<body>
<header>
    <div class="hero">
        <div class="headings">
            <div class="container">
                <a href="<?php echo WEB_PATH; ?>" class="brand">
                    <img src="<?php echo WEB_PATH; ?>img/logo.png" alt="Aurore Traiteur" width="150"/></a>

                <p>
                    "Cuisiner suppose une tête légère, un esprit généreux et un coeur large" - Paul Gauguin
                </p>
            </div>
        </div>
    </div>
</header>
<div class="container">
    <h1>404</h1>
    <h2>Désolé la page que vous recherchez n'existe pas</h2>
    <a class="btn btn-warning" href="<?php echo WEB_PATH; ?>">Retour vers l'accueil</a>
</div>

<?php
include '../footer.php';
?>
</body>
</html>
