<?php
namespace MealBooker;
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
require('../../config/global.php');
use MealBooker\manager\SecurityManager;

if (isset($_SESSION['auth'])) {
    SecurityManager::get()->logOutUser($_SESSION);
    unset($_SESSION['auth']);
    session_regenerate_id();
}
header('Location: '.WEB_PATH);

