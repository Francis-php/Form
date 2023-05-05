<?php 



$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    
    case '/Facegram/login':
        require '/var/www/html/Facegram/views/login.php';
        break;
    case '/Facegram/register':
        require '/var/www/html/Facegram/views/register.php';
        break;
    case '/Facegram/user':
        require '/var/www/html/Facegram/views/user.php';
        break;
    case '/Facegram/admin':
        require '/var/www/html/Facegram/views/admin.php';
        break;

    
    default:
        http_response_code(404);
        require '404.php';
        break;
}



?>