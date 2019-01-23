<?php
/**
 *
 */
namespace Lib;

use Exception;

class App{
    protected static $router;

    public static $db;

    public static function getRouter(){
        return self::$router;
    }

    public static function run($uri){

        self::$router = new Router($uri);

        Lang::load(self::$router->getLanguage());

        self::$db = new Db();
        $controller = self::$router->getController();
        $controller_class = ucfirst(self::$router->getController()).'Controller';
        $controller_method = strtolower(self::$router->getMethodPrefix().self::$router->getAction());
        $controller_class_call = "Controller\\".$controller_class;

        if (class_exists($controller_class_call)) {
            $controller_object = new $controller_class_call();
        }else {
            throw new \Exception("Controller $controller_class_call not found", 404);
        }

        $layout = self::$router->getRoute();
        $controller = self::$router->getController();

        //Use $layout to control page access using various routes4

        if($layout == 'admin'){
            if(!Session::get('admin_login') && $controller_method !== 'admin_login'){
                Router::Redirect('/admin/account/login');
            }else {
                # handle pages and privileges
            }
        }

        if($layout == 'default' && $controller == 'customer'){
            if($controller_method != 'account' && !Session::get('customer_login')){
                Router::Redirect('/customer/account/login');
            }
        }

        //calling Controllers method
        if(method_exists($controller_object, $controller_method)){
            $view_path  = $controller_object->$controller_method();
            $view_obj   = new View($controller_object->getData(), $view_path);
            $content    = $view_obj->render();
        }else{
            throw new Exception("Method $controller_method of class $controller_class does not exist.", 404);
        }

        $layout = self::$router->getRoute();
        $layout_path = VIEWS_PATH.DS.$layout.'.html';
        $layout_view_obj = new View(compact('content'), $layout_path);
        echo $layout_view_obj->render();
    }

    public static function errorPage($code = null){
        $code = is_null($code) ? '000' : $code;
        $controller_class_call = "Controller\\".strtoupper(Config::get('default_controller')).'Controller';
        $controller_object = new $controller_class_call();

        $view_path  = VIEWS_PATH.DS.Config::get('default_controller').DS.$code.'.html';
        $view_obj   = new View($controller_object->getData(), $view_path);
        $content    = $view_obj->render();

        $layout = Config::get('default_route');
        $layout_path = VIEWS_PATH.DS.Config::get('default_route').'.html';
        $layout_view_obj = new View(compact('content'), $layout_path);
        echo $layout_view_obj->render();
    }
}
