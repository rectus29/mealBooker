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
require_once('../../config/global.php');
$error = null;
$info = null;
if (isset($_POST)
    && isset($_POST['login'])
    && isset($_POST['password'])
) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    if (SecurityManager::get()->authentificate($login, $password) != null) {
        header('Location: ' . WEB_PATH );
    } else {
        header('Location: ' . WEB_PATH . '?page=signin&error=authError');
    }
}
