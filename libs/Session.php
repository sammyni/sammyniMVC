<?php

/**
 *
 */
namespace Lib;

class Session
{

    public static function setMsg($msg)
    {
        self::set('msg', $msg);
    }

    public static function hasMsg()
    {
        return !is_null(self::get('msg'));
    }

    public static function showMsg()
    {
        echo self::get('msg');
        self::delete('msg');
    }

    public static function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }


    public static function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    /**
    *@return object
    */
    public static function getObj($key)
    {
        if (isset($_SESSION[$key])) {
            if (is_array($_SESSION[$key])) {
                return json_decode(json_encode($_SESSION[$key]), FALSE);
            }else {
                return null;
            }
        }else {
            return null;
        }

    }

    public static function delete($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
    
    public static function destroy()
    {
        $_SESSION = array();

        $params = session_get_cookie_params();

        setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);

        session_destroy();
    }
}

?>
