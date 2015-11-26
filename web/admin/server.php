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
use MealBooker\models\dao\ConfigDao;

$configDao = new ConfigDao($em);
if(isset($_POST['state'])){
    $state = $configDao->getByKey('serverstate');
    $state->setValue($_POST['state']);
    $configDao->save($state);
}
?>
<div class="row">
    <?php
    $state = $configDao->getByKey('serverstate');
    if ($state != null)
        $state = $state->getValue();
    ?>
    <form action="#" method="post">
        Etat de la boutique :
        <select name="state">
            <option value="0" <?php echo ($state == '0') ? 'selected' : '' ?>>Hors ligne</option>
            <option value="1" <?php echo ($state == '1') ? 'selected' : '' ?>>En ligne</option>
        </select>
        <input type="submit" value="Enregister" class="btn btn-green"/>
    </form>
</div>