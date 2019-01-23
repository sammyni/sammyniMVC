<?php
namespace Model;

use Lib\App;
use Lib\Model;

/**
 *
 */
class Account extends Model
{
    private $model_db;

    public function __construct($custom_db = null)
    {
        $this->model_db = $custom_db;
        $db = is_null($this->model_db) ? App::$db : $this->model_db;
        parent::__construct($db);
    }


}

?>
