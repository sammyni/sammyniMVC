<?php

namespace Controller;

use Lib\Controller;
use Model\Cart;
use Lib\Config;
use Exception;


class CartController extends Controller{

    public function __construct($data = [])
    {
        parent::__construct($data);

        $this->model = new Cart();
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
