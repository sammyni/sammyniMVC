<?php
/**
 *
 */
namespace Lib;

use Lib\App;

class Model
{
    protected $db;

    public function __construct($db = null)
    {
        $this->db = is_null($db) ? App::$db : $db;
    }
}

?>
