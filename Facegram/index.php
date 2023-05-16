<?php 
include "/var/www/html/Facegram/controllers/Router.php";
$urlpath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$router = new Router();
$router->route($urlpath);





?>