<?php
namespace Lib;

use Exception;


class View {
    protected $data;

    protected $path;

    protected static function getDefaultViewPath(){
        $router = App::getRouter();

        if(!$router){
            return false;
        }

        $controller_dir = $router->getController();

        $template_name  = $router->getMethodPrefix().$router->getAction().'.html';

        return VIEWS_PATH.DS.$controller_dir.DS.$template_name;
    }

    public function __construct($data = [], $path = null){
        if (!$path){
            $path = self::getDefaultViewPath();
        }

        if(!file_exists($path)){
            throw new Exception("Template not found in the path: $path", 404);
        }

        $this->path = $path;
        $this->data = $data;
    }

    public function render(){

        $data = $this->data;

        ob_start();

        include $this->path;

        $content = ob_get_clean();

        return $content;
    }

    public static function render_partial($partial_file)
    {
        $file = VIEW_PARTIALS_PATH.DS.$partial_file.'.html';

        if (file_exists($file)) {
            include $file;
        }else {
            throw new \Exception("Partial template not found in the path: $file", 404);
        }

    }
}
?>
