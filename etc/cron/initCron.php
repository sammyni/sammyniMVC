<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
require ROOT.DS.'vendor'.DS.'autoload.php';
$dotenv = new Dotenv\Dotenv(ROOT.DS.'config');
$dotenv->load();
$dotenv->required(['BASE_DIR', 'DB_HOST', 'DB_NAME', 'DB_DEFAULT_USER', 'DB_DEFAULT_PWD']);

$db = new Lib\Db(['user'=>getenv('DB_CRON_USER'), 'pwd'=>getenv('DB_CRON_PWD')], false);

$model = new Models\Cron($db);


?>
