<?php

namespace Controller;

use Lib\Controller;
use Model\Customer;
use Model\Account;
use Lib\Config;
use Exception;


class CustomerController  extends Controller{

    public function __construct($data = [])
    {
        parent::__construct($data);

        $this->model = new Customer();
        $this->account_model = new Account();
    }

    public function index()
    {
        Config::set('title_prefix', 'Customer Account');
    }

    public function account()
    {
        Config::set('title_prefix', 'Customer Login');
        $this->data['params'] = $this->params;

        $this->data['params'][0] = isset($this->params[0]) ? $this->params[0] : null;
    }

    public function orders ()
    {
        Config::set('title_prefix', 'Customer Signup');
    }

    public function addresses ()
    {
        Config::set('title_prefix', 'Customer Profile');
    }

    public function settings ()
    {
        Config::set('title_prefix', 'Customer Settings');
    }
}
?>
