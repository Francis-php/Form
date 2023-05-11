<?php 
include "/var/www/html/Facegram/controllers/routerAll.php";
$urlpath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$router = new Router();
$router->route($urlpath);





?>