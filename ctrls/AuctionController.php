<?php

namespace Controller;

use Lib\Controller;
use Model\Auction;
use Lib\Config;
use Exception;


class AuctionController extends Controller{

    public function __construct($data = [])
    {
        parent::__construct($data);

        $this->model = new Auction();
    }

    public function index()
    {
        Config::set('title_prefix', 'Art Auction');
    }

    public function sales()
    {
        // TODO: List Sales [Sort By Time, Price, Number of Bids]
    }

    public function item()
    {
        # code...
    }

    public function merchant_index()
    {
        Config::set('title_prefix', 'Merchant Auction');
    }

    public function admin_index($value='')
    {
        # code...
    }
}
?>
