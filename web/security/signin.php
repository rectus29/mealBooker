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

if ($_POST & isset($_POST['login']) && isset($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    if(SecurityManager::get()->authentificate($login, $password, $_SESSION)){
        header('Location: /');
    }else{
        header('Location: /');
    }

} else {
?>
<form class="form-horizontal col-md-4 col-md-offset-4 " id="connectWrapper">
  <h2>Connexion</h2>
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-user"></i>
        </div>
        <input class="form-control" type="text"/>
    </div>
    <br/>

    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-lock"></i>
        </div>
        <input class="form-control" type="password"/>
    </div>
    <br/>

    <div class="form-group" style="text-align: center">
        <button type="submit" class="btn btn-warning">
            Connection
        </button>
    </div>
    <span id="feedback"/>
</form>
    <?php
}
?>