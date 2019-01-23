<?php
/**
 *
 */
namespace Mgr;

use Models\User;

class Login
{
    public static function verifyUserPassword($pwd, $rid = null)
    {
        $ref = is_null($rid) ? Session::get('login') : $rid;

        $userModel = new User();

        $user = $userModel->getUserByReg($ref);

        if(is_null($user)){return false;}

        return password_verify($pwd, $user['pwd']);
    }
}

?>
