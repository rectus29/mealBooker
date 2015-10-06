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
if ($_POST & isset($_POST['login']) && isset($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];





} else {
    ?>
    <form class="form-horizontal col-md-4 col-md-offset-4 well" id="connectWrapper" method="post">
        <div class="input-group">
            <div class="input-group-addon">
                <i class="fa fa-user"/>
            </div>
            <input name="login" class="form-control" type="text"/>
        </div>
        <br/>

        <div class="input-group">
            <div class="input-group-addon">
                <i class="fa fa-lock"/>
            </div>
            <input name="password" class="form-control" type="password"/>
        </div>
        <br/>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                Connection
            </button>
        </div>
        <span id="feedback"/>
    </form>
    <?php
}
?>


