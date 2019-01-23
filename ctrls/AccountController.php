<?php

namespace Controller;

use Lib\Controller;
use Model\Account;
use Lib\Config;
use Exception;


class AccountController extends Controller{

    public function __construct($data = [])
    {
        parent::__construct($data);

        $this->model = new Account();
    }

    public function merchant_index()
    {
        /*
        **
        *@ Handle account creation
        *@ If session == active ? click to continue : Create account or login
        **
        */
        Config::set('title_prefix', 'Merchant Account');
    }

    public function merchant_login()
    {
        Config::set('title_prefix', 'Merchant Login');
    }

    public function merchant_profile ()
    {
        Config::set('title_prefix', 'Merchant Profile');
    }

    public function merchant_settings ()
    {
        Config::set('title_prefix', 'Merchant Settings');
    }

    /**
    * Admin Methods
    *
    *
    */
    public function admin_login()
    {
        Config::set('title_prefix', 'Login - Admin');
    }
}
?>
