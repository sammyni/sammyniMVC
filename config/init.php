<?php

require ROOT.DS.'vendor'.DS.'autoload.php';

use Lib\View;
use Lib\Lang;
use Lib\Config;
use Lib\Session;
use Models\User;


$dotenv = new Dotenv\Dotenv(ROOT.DS.'config');
$dotenv->load();
$dotenv->required(['BASE_DIR', 'DB_HOST', 'DB_NAME', 'DB_DEFAULT_USER', 'DB_DEFAULT_PWD']);

Config::set('site_name', 'Sam\'s Php MVC');

Config::set('languages', ['en','fr']);

Config::set('routes',[
    'default' => '',
    'admin' => 'admin_'
]);

//Set Route Defaults
Config::set('default_route', 'default');
Config::set('default_language', 'en');
Config::set('default_controller', 'start');
Config::set('default_action', 'index');

// Dirname Setup
Config::set('public_dir', 'www');
Config::set('app_root', getenv('BASE_DIR'));

Config::set('user_agent_token', hash('sha512', $_SERVER['HTTP_USER_AGENT']));


// Public Directories Path
Config::set('upload_path', ROOT.DS.Config::get('public_dir').DS.'_uploads');
Config::set('favicon_path', Config::get('app_root').'/favicon');
Config::set('assets_path', Config::get('app_root').'/assets');


//Image & Assets Directory Paths
Config::set('img_paths', [
    'default' => Config::get('assets_path').'/images',
    //'blog' => Config::get('assets_path').'/images/blog',
    'background' => Config::get('assets_path').'/images/bg',
    // 'col' => Config::get('assets_path').'/images/collections',
    'utility' => Config::get('assets_path').'/images/util',
    'logo' => Config::get('assets_path').'/images/util/logo',
    // 'fgs' => Config::get('assets_path').'/images/util/flags',
]);

Config::set('dist_path', Config::get('assets_path').'/dist');
Config::set('js_path', Config::get('assets_path').'/javascripts');
Config::set('css_path', Config::get('assets_path').'/stylesheets');
Config::set('plugin_path', Config::get('assets_path').'/plugins');

Config::set('href', [
    'home' => '/',
    'user_account' => 'user/account',
    'user_login' => 'user/account/login',
    'user_logout' => 'user/account/logout',
]);

//Include Utility Functions
include ROOT.DS.'util'.DS.'util_functions.php';


//Include Input validation Utility function
include ROOT.DS.'util'.DS.'input_validator.php';

?>
