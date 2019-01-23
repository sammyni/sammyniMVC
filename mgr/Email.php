<?php
/**
 *
 */
namespace Mgr;

use Lib\App;

class Email
{
    protected static $route;
    protected static $template;
    protected static $returnAddr;
    private static $header;

    public function __construct()
    {

        self::$route = strtolower(App::getRouter()->getRoute());
        self::$template = EMAIL_TEMP_PATH.DS.self::$route.'.html';
        self::$returnAddr = (self::$route == 'admin') ? 'admin@nefworld.com' : 'noreply@nefworld.com';
    }

    private static function buildHeader($senderName = null, $senderEmail = null)
    {
        $from = !is_null($senderEmail) ? $senderEmail : self::$returnAddr;
        $from = !is_null($senderName) ? "$senderName <$from>" : $from;
        $headers = "From: " . $from . "\r\n";
    	$headers .= "Reply-To: " . self::$returnAddr . "\r\n";
    	$headers .= "MIME-Version: 1.0\r\n";
    	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        return $headers;
    }

    private static function buildBody($subject, $msg, $greet)
    {
        ob_start();

        include self::$template;

        $body = ob_get_clean();

        return $body;

    }
    private static function sendMail($to, $subject, $message, $greet, $sender_email = null, $sender_name = null, $reply_to = null ) {
        if(!Is_null($reply_to)){ self::$returnAddr = $reply_to; }
        $headers = self::buildHeader($sender_name, $sender_email);
        $message = self::buildBody($subject, $message, $greet);
        return mail($to, $subject, $message, $headers);
    }

    public static function newAdminAccount($email, $password, $username, $name)
    {
        $greet = "Dear $name,";
        $message = "";
        $message .= "<p>You have been granted access to <a href='https://mybirthdaysplash.com/admin'>mybirthdaysplash.com/admin</a>.</p>";
        $message .= "<p>Your account details are:</p>";
        $message .= "<p><b>Username:</b> $username</p>";
        $message .= "<p><b>Password:</b> $password</p>";
        $message .= "<p>You are encouraged to change your password on your first access.</p>";
        $message .= "<p><br/><br/>Regards, <br/>Admin.</p>";
        return self::sendMail($email, 'Admin Account Created', $message, $greet, null, 'Site Admin' );
    }

    public static function grantAdminPrivilege($email, $name, $access)
    {
        $greet = "Dear $name,";
        $message = "";
        $message .= "<p>Privilege to manage $access has  been granted to your admin account</p>";
        $message .= "<p>Your can manage any activity relating to the privilege granted.</p>";
        $message .= "<p><br/><br/>Regards, <br/>Admin.</p>";
        return self::sendMail($email, 'Privilege Granted', $message, $greet, null, 'Site Admin' );
    }

    public static function newAccount($email, $password)
    {
        $greet = "Hello Dear,";
        $message = "";
        $message .= "<p class='lead'>Your account have been created.</p>";
        $message .= "<p>You password is: \"<b>$password</b>\"</p>";
        $message .= "<p>Thank you for joining us.</p>";
        $message .= "<p class='callout'>You are expected to change the default initial password generated for you at your first login.</p>";
        $message .= "<p><br/><br/>Regards, <br/>Site Admin.</p>";
        return self::sendMail($email, 'Account Created', $message, $greet, "noreply@mybirthdaysplash.com", 'MyBirthdaySplash.' );
    }
}

?>
