<?php 
include "/var/www/Facegram/controllers/Router.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$urlpath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router = new Router();
$router->route($urlpath);





?>