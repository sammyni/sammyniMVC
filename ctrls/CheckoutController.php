<?php

namespace Controller;

use Lib\Controller;
use Model\Checkout;
use Lib\Config;
use Exception;


class CheckoutController extends Controller{

    public function __construct($data = [])
    {
        parent::__construct($data);

        $this->model = new Checkout();
    }

    public function index()
    {
        Config::set('title_prefix', 'Welcome');
    }

    public function merchant_index()
    {
        # code...
    }
}
?>
