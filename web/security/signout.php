<?php
require(dirname(__FILE__) . '/../../config/global.php');

unset($_SESSION['auth']);
unset($_SESSION);
header('Location : /index.php');

