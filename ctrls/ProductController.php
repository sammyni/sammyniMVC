<?php

namespace Controller;

use Lib\Controller;
use Model\Product;
use Lib\Config;
use Exception;


class ProductController extends Controller{

    public function __construct($data = [])
    {
        parent::__construct($data);

        $this->model = new Product();
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
