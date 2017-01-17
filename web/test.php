<?php
/*-----------------------------------------------------*/
/*      _____           _               ___   ___      */
/*     |  __ \         | |             |__ \ / _ \     */
/*     | |__) |___  ___| |_ _   _ ___     ) | (_) |    */
/*     |  _  // _ \/ __| __| | | / __|   / / \__, |    */
/*     | | \ \  __/ (__| |_| |_| \__ \  / /_   / /     */
/*     |_|  \_\___|\___|\__|\__,_|___/ |____| /_/      */
/*                                                     */
/*                Date: 17/01/2017 14:23                */
/*                 All right reserved                  */
/*-----------------------------------------------------*/


use MealBooker\manager\SecurityManager;
use MealBooker\model;
use MealBooker\models\dao\ConfigDao;
use MealBooker\model\MealOrder;
use MealBooker\model\User;
use MealBooker\models\dao\OrderDao;

error_reporting(E_ALL);

require_once('../config/global.php');


$orderDao = new OrderDao($em);
$order = $orderDao->getByPrimaryKey(1);
echo  '
        <table width="480px"  style"width:480px;">
            <tbody>
                <tr style="background: black;">
                    <td><img src="' . SERVER_URL . WEB_PATH . 'img/logo_mail.jpg"></td>
                </tr>
                <tr>
                    <td>
                        Bonjour,<br/>
                        <br />
                        Nouvelle commande #' . $order->getFormattedID() . ' <br />
                        De'. $order->getUser()->getFormattedName().'<br />
                        Lieu de livraison :'. $order->getAddress()->getFormattedAddress().' 
                        <br />
                        <table>';
foreach($order->getMeals() as $meal){
    static::$mail->Body += '<tr>';
    static::$mail->Body += '<td>' . $meal->getCourse()->getName() .'</td>';
    static::$mail->Body += '<td>' . $meal->getDessert()->getName() .'</td>';
    static::$mail->Body += '<td>' . $meal->getDrink()->getName() .'</td>';
    static::$mail->Body += '</tr>';
}'</table>
                        A bient&ocirc;t sur <a href="http://aurore-traiteur.fr">aurore-traiteur.fr</a>
                    </td>
                </tr>
            </tbody>
	    </table>';