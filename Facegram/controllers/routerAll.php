<?php 
include "/var/www/html/Facegram/controllers/authenticateAll.php";
include "/var/www/html/Facegram/controllers/registerUser.php";
include "/var/www/html/Facegram/controllers/editUser.php";
session_start();
class Router{
    
    public function route($urlpath){
        
        switch($urlpath){
            case '/Facegram/login':
                $handler = new Authenticate();
                $handler->handleLogin();
                require '/var/www/html/Facegram/views/login.php';
                break;
            case '/Facegram/register':
                $handler= new Register();
                $handler->create();
                require '/var/www/html/Facegram/views/register.php';
                break;
            case '/Facegram/user':
            require '/var/www/html/Facegram/views/user_home.php';
            break;
            case'/Facegram/user/profile':
                $handler= new Edit();
                $handler->edit();
                
                require '/var/www/html/Facegram/views/user.php';
                break;
            // case '/Facegram/admin':
            //     $this->handleLogin();
            //     require '/var/www/html/Facegram/views/admn_home.php';
            //     break;
            // case'/Facegram/admin/profile':
            //     $this->handleLogin();
            //     require '/var/www/html/Facegram/views/admin_profile.php';
            //     break;
            // case'/Facegram/admin/users':
            //     $this->handleLogin();
            //     require '/var/www/html/Facegram/views/admin.php';
            //     break;
            // case'/Facegram/admin/edit':
            //     $this->handleLogin();
            //     $id = isset($_GET['edit_id']) ? $_GET['edit_id'] : null;
            //     require '/var/www/html/Facegram/views/edit.php';
            //     break;

            default:
            http_response_code(404);
            require '404.php';
            break;
    }

    }
    
    

}

?>