<?php
date_default_timezone_set('Africa/Lagos');
use Lib\App;
use Lib\Config;

//App core contstants
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('VIEWS_PATH', ROOT.DS.'views');
define('VIEW_PARTIALS_PATH', VIEWS_PATH.DS.'partials');
define('EMAIL_TEMP_PATH', VIEWS_PATH.DS.'email_temp');

require_once ROOT.DS.'config'.DS.'init.php';
require_once ROOT.DS.'util'.DS.'set_secure_session.php';

//Static Files [js,css] dir paths contstants
define('JS_PATH', ROOT.DS.Config::get('public_dir').DS.'assets'.DS.'javascripts');
define('CSS_PATH', ROOT.DS.Config::get('public_dir').DS.'assets'.DS.'stylesheets');

try {
    App::run(str_replace(Config::get('app_root'), '', $_SERVER['REQUEST_URI']));
} catch (\Exception $e) {
    $erro_code = $e->getCode();
    if (getenv('ENV') == 'prod') {
        App::errorPage($erro_code);
    }else {
        // echo $e->getMessage();
        var_dump($e);
    }
}
?>
