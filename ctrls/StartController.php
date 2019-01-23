<?php

namespace Controller;

use Lib\Controller;
use Model\Start;
use Lib\Config;
use Exception;


class StartController extends Controller{

    public function __construct($data = [])
    {
        parent::__construct($data);

        $this->model = new Start();
    }

    public function index()
    {
        Config::set('title_prefix', 'Welcome');
    }

    public function merchant_index()
    {
        /*
        **
        *@ Logged in Open merchant dashboard
        *@ Not logged in open welcome page
        **
        */
    }

    public function admin_index()
    {
        # code...
    }
}
?>
