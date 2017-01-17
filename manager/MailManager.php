<?php
namespace MealBooker\manager;
    /*-----------------------------------------------------*/
    /*      _____           _               ___   ___      */
    /*     |  __ \         | |             |__ \ / _ \     */
    /*     | |__) |___  ___| |_ _   _ ___     ) | (_) |    */
    /*     |  _  // _ \/ __| __| | | / __|   / / \__, |    */
    /*     | | \ \  __/ (__| |_| |_| \__ \  / /_   / /     */
    /*     |_|  \_\___|\___|\__|\__,_|___/ |____| /_/      */
    /*                                                     */
    /*                Date: 13/10/2015 23:07               */
    /*                 All right reserved                  */
/*-----------------------------------------------------*/

use Doctrine\ORM\EntityManager;
use Exception;
use MealBooker\model\MealOrder;
use MealBooker\model\User;
use MealBooker\models\dao\UserDao;
use PHPMailer;


class MailManager
{

    /** @var PHPMailer */
    private static $mail;

    /** @var UserDao */
    private static $userDao;

    /** @var MailManager */
    private static $ownInstance = null;

    /** @var EntityManager */
    private static $em = null;

    /**
     * @param $entityManager
     * @param $mailConfig
     * @throws \phpmailerException
     * @internal param $EntityManager MailManager constructor.* MailManager constructor.
     */
    public function __construct($entityManager, $mailConfig)
    {
        self::$em = $entityManager;
        self::$userDao = new UserDao($entityManager);
        self::$mail = new PHPMailer;
        self::$mail->isSMTP();                                            // Set mailer to use SMTP
        self::$mail->Host = $mailConfig['serversmtp'];                    // Specify main and backup SMTP servers
        self::$mail->SMTPAuth = $mailConfig['SMTPAuth'];                  // Enable SMTP authentication
        self::$mail->Username = $mailConfig['Username'];                  // SMTP username
        self::$mail->Password = $mailConfig['Password'];                  // SMTP password
        self::$mail->SMTPSecure = $mailConfig['SMTPSecure'];              // Enable TLS encryption, `ssl` also accepted
        self::$mail->Port = $mailConfig['Port'];                          // TCP port to connect to
        self::$mail->setFrom($mailConfig['from']);
        self::$mail->isHTML(true);
    }


    /**
     * @param $em EntityManager
     * @param $mailConfig Array
     * @return $this|MailManager
     */
    public static function init($em, $mailConfig)
    {
        if (self::$ownInstance == null)
            self::$ownInstance = new MailManager($em, $mailConfig);
        return self::$ownInstance;
    }

    /**
     * @return $this|MailManager
     */
    public static function get()
    {
        if (self::$ownInstance == null && self::em != null)
            return self::init(self::$em);
        return self::$ownInstance;
    }

    /**
     * send signup confirmation to saved user
     * @param User $user
     * @return bool
     * @throws Exception
     */
    public static function sendSignUpMail($user)
    {
        self::$mail->addAddress($user->getMail());
        self::$mail->Subject = 'Inscription Aurore traiteur';
        self::$mail->Body = '
        <table>
            <tbody>
                <tr>
                    <td style="background: black;"><img src="' . SERVER_URL . WEB_PATH . 'img/logo_mail.jpg"></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2">
                        Bonjour,<br/>
                        <br />
                        Pour valider votre inscription cliquez sur le lien suivant : <a href="' . SERVER_URL . WEB_PATH . "?page=signupvalidation&authToken=" . $user->getSession() . '">Se connecter</a>
                    </td>
                </tr>
            </tbody>
	    </table>';
        if (!self::$mail->send()) {
            throw new Exception("Message could not be sent - " . self::$mail->ErrorInfo);
        } else {
            return true;
        }
    }

    /**
     * send order confirmation mail
     * @param User $user
     * @param MealOrder $order
     * @return bool
     * @throws Exception
     */
    public static function sendOrderConfirmation($user, $order)
    {
        self::$mail->addAddress($user->getMail());
        self::$mail->Subject = 'Confirmation de votre commande Aurore traiteur';
        self::$mail->Body = '
        <table width="480px"  style"width:480px;">
            <tbody>
                <tr style="background: black;">
                    <td><img src="' . SERVER_URL . WEB_PATH . 'img/logo_mail.jpg"></td>
                </tr>
                <tr>
                    <td>
                        Bonjour,<br/>
                        <br />
                        Votre commande #' . sprintf("%04s",$order->getId()) . ' est valid&eacute;e,<br />
                        <br />
                        A bient&ocirc;t sur <a href="http://aurore-traiteur.fr">aurore-traiteur.fr</a>
                    </td>
                </tr>
            </tbody>
	    </table>';
        if (!self::$mail->send()) {
            throw new Exception("Message could not be sent - " . self::$mail->ErrorInfo);
        } else {
            return true;
        }
    }

    /**
     * send order confirmation mail to site admin
     * @param MealOrder $order
     * @return bool
     * @throws Exception
     */
    public static function sendOrderConfirmationToAdmin($order)
    {
        static::$mail->addAddress(ADMINMAIL);
        static::$mail->Subject = 'Commande ' . $order->getFormattedID() . ' enregistrée';
        static::$mail->Body = '
       <table width="480px"  style"width:480px;">
            <tbody>
                <tr style="background: black;">
                    <td><img src="' . SERVER_URL . WEB_PATH . 'img/logo_mail.jpg"></td>
                </tr>
                <tr>
                    <td>
                        <br />
                        Bonjour,<br/>
                        <br />
                        Nouvelle commande : #' . $order->getFormattedID() . ' <br />
                        Date de commande : '. Utils::formatDate($order->getCreated(), 'd/m/Y H:m:s') .' <br />
                        De : '. $order->getUser()->getFormattedName().'<br />
                        Lieu de livraison : '. $order->getAddress()->getFormattedAddress().'
                        <br />
                        <br />
                        <table>
                        <tr>
                            <th width="30%">Plat</th>
                            <th width="30%">Dessert</th>
                            <th width="30%">Boisson</th>
                        </tr>';
        foreach($order->getMeals() as $meal){
            static::$mail->Body += '<tr>';
            static::$mail->Body += '<td width="30%">' . $meal->getCourse()->getName() .'</td>';
            static::$mail->Body += '<td>' . $meal->getDessert()->getName() .'</td>';
            static::$mail->Body += '<td>' . $meal->getDrink()->getName() .'</td>';
            static::$mail->Body += '</tr>';
        }'</table>
                    <br />
                        A bient&ocirc;t sur <a href="http://aurore-traiteur.fr">aurore-traiteur.fr</a>
                    </td>
                </tr>
            </tbody>
	    </table>';
        if (!self::$mail->send()) {
            throw new Exception("Message could not be sent - " . self::$mail->ErrorInfo);
        } else {
            return true;
        }
    }



    /**
     * send restoration mail to user
     * @param $user User
     * @return bool
     * @throws Exception
     */
    public static function sendRestorePasswordMail($user)
    {
        self::$mail->addAddress($user->getMail());
        self::$mail->Subject = 'Aurore traiteur - Restaurattion de votre mot de passe';
        self::$mail->Body = '
        <table>
            <tbody>
                <tr style="background: black;">
                    <td><img src="' . SERVER_URL . WEB_PATH . 'img/logo_mail.jpg"></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2">
                       Bonjour ' . $user->getFormattedName() . '
                        <p>
                            Pour finaliser la proc&eacute;dure de restauration de votre mot de passe veuillez suivre le lien suivant :
                        </p>
                        <p>
                            ' . SERVER_URL.WEB_PATH . '?page=restorepassword&token='.$user->getRestoreToken().'
                        </p>
                        <p>
                            Attention : le lien ci-dessus n\'est valable que pendant 24h
                        </p>
                        Cordialement,
                    </td>
                </tr>
            </tbody>
	    </table>';
        if (!self::$mail->send()) {
            throw new Exception("Message could not be sent - " . self::$mail->ErrorInfo);
        } else {
            return true;
        }
    }

    /**
     * @return PHPMailer
     */
    public static function getMail()
    {
        return self::$mail;
    }


}