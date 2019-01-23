<?php
use Lib\App;
use Lib\Lang;
use Lib\View;
use Lib\Config;
use Lib\Session;

//Get Router Language
function __getLang()
{
    $router = App::getRouter();
    return $router->getLanguage();
}

//Manage languages
function __($key, $default_val) { return Lang::get($key, $default_val); }

//Get Session Value
function __gss($session_name) { return Session::get($session_name); }
function __sss($session_key, $session_value){ return Session::set($session_key, $session_value); }

//Include Partials
function __inc($partial) { View::render_partial($partial); }

// Auto version static files
function __js($file) {
    return file_exists(JS_PATH.DS.$file.'.min.js') && getenv('ENV') != 'dev'
    ? Config::get('js_path').'/'.$file.'.min.js?'.filemtime(JS_PATH.DS.$file.'.min.js')
    : (file_exists(JS_PATH.DS.$file.'.js') ? Config::get('js_path').'/'.$file.'.js?'.filemtime(JS_PATH.DS.$file.'.js') : '');
}
function __css($file) {
    return file_exists(CSS_PATH.DS.$file.'.min.css') && getenv('ENV') != 'dev'
    ? Config::get('css_path').'/'.$file.'.min.css?'.filemtime(CSS_PATH.DS.$file.'.min.css')
    : (file_exists(CSS_PATH.DS.$file.'.css') ? Config::get('css_path').'/'.$file.'.css?'.filemtime(CSS_PATH.DS.$file.'.css') : '');
}

function __img($file, $path_index = null)
{

    $path_index = is_null($path_index) ? 'def' : $path_index;

    $path_init = Config::get('img_paths')[$path_index];

    $path_out = str_replace(Config::get('app_root'), '', $path_init);


    $file_path = ROOT.DS.Config::get('public_dir').str_replace('/',DS,$path_out).DS.$file;
    //return $file_path;
    return file_exists($file_path) ? Config::get('img_paths')[$path_index].'/'.$file.'?'.filemtime($file_path) : '';
}

function __baseUri(){
    $lang = __getLang();
    $router = App::getRouter();
    $route_path = $router->getRoute() == 'default' ? '' :  '/' . $router->getRoute();
    $uri =  $lang == Config::get('default_language') ? Config::get('app_root').$route_path : Config::get('app_root').'/'.$lang.$route_path;
    return str_replace('//', '/', $uri);
}

function __ctrBaseUri()
{

    $uri = __baseUri();
    $router = App::getRouter();

    $controller_path = $router->getController() === Config::get('default_controller') ? '' : '/' . $router->getController();
    $uri .= $controller_path;

    return str_replace('//', '/', $uri);
}

function __actionBaseUri()
{
    $uri = __ctrBaseUri();
    $router = App::getRouter();

    $uri .= $router->getAction() == 'index' ? '' : '/'.$router->getAction();
    return str_replace('//', '/', $uri);
}

function __hrefBase()
{
    $lang = __getLang();
    $router = App::getRouter();
    return  $lang == Config::get('default_language') ?  Config::get('app_root') : Config::get('app_root').'/'.$lang;
}

function __href($key)
{
    $uri = __hrefBase();
    $uri .= key_exists($key, Config::get('href')) ? '/'.Config::get('href')[$key] : '';
    return str_replace('//', '/', $uri);
}



// Xtra Utility functions functions
function array_sort_key($array, $on, $order=SORT_DESC)
{
    $new_array = [];
    $sortable_array = [];

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }
        switch ($order) {
            case SORT_ASC:
            asort($sortable_array);
            break;
            case SORT_DESC:
            arsort($sortable_array);
            break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}

function bsAlert($msg, $type='info', $persist = false)
{
    $html = "";
    $html .= "<div class='alert alert-{$type} " . !$persist ? " alert-dismissible'" : "'" . " role='alert'>";
    $html .= !$persist ? "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" : "";
    $html .= $msg. "</div>";
    return $html;
}

function makeDbDate($timestamp = null)
{
    $timestamp = is_null($timestamp) ? time() : $timestamp;

    return Date('Y-m-d H:i:s', $timestamp);
}

function Hex2String($hex)
{
    $string='';
    for ($i=0; $i < strlen($hex)-1; $i+=2){
        $string .= chr(hexdec($hex[$i].$hex[$i+1]));
    }
    return $string;
}
function String2Hex($string)
{
    $hex='';
    for ($i=0; $i < strlen($string); $i++){
        $hex .= dechex(ord($string[$i]));
    }
    return $hex;
}

function randomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function msg($msg, $type='info')
{
    $html = "";
    $html .= "<div class='alert alert-{$type} alert-dismissible' role='alert'>";
    $html .="<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
    $html .= $msg. "</div>";
    return $html;
}
?>
