<?php

namespace Controller;

use Lib\Controller;
use Model\Collections;
use Lib\Config;
use Exception;


class CollectionsController extends Controller{

    public function __construct($data = [])
    {
        parent::__construct($data);

        $this->model = new Collections();
    }

    public function index()
    {

    }

    public function merchant()
    {
        # code...
    }

    public function details()
    {
        // TODO: Request products ID as parameter
    }

    public function categories()
    {
        # code...
    }

    public function merchant_index()
    {
        /*
        **
        *@ Handle account creation
        *@ If session == active ? click to continue : Create account or login
        **
        */
        Config::set('title_prefix', 'Merchant Products');
    }
}
?>
