<?php 
include "/var/www/html/Facegram/controllers/AuthenticateController.php";
include "/var/www/html/Facegram/controllers/ProfileController.php";
include "/var/www/html/Facegram/controllers/UsersController.php";
include "/var/www/html/Facegram/controllers/AccessControl.php";

session_start();
class Router{
    private $accesscontrol;

    public function __construct(){
        $this->accesscontrol = new AccessControl();
    }
    public function route($urlpath){
        
        $this->accesscontrol->handle($urlpath);
        
        switch($urlpath){
            case '/Facegram/login':
                $handler = new AuthenticateController();
                $handler->handleLogin();
                break;
            case '/Facegram/register':
                $handler= new UsersController();
                $handler->create();
                break;
            case '/Facegram/user':
            require '/var/www/html/Facegram/views/user_home.php';
            break;
            case'/Facegram/user/profile':
                $handler= new ProfileController();
                $handler->edit('user');
                break;
            case '/Facegram/admin':
                require '/var/www/html/Facegram/views/admn_home.php';
                break;
            case '/Facegram/admin/profile':
                $handler= new ProfileController();
                $handler->edit('admin');
                break;
            case '/Facegram/admin/users':
                require '/var/www/html/Facegram/views/admin.php';
                break;
            case '/Facegram/admin/users/create':                
                $handler= new UsersController();
                $handler->create();
                break;
            case '/Facegram/admin/users/delete':             
                $handler= new UsersController();
                $handler->del();
                break;
            case '/Facegram/admin/user/update':  
                $handler=new UsersController(); 
                $id=$_GET['edit_id'];
                $handler->showdata($id);
                break;
            case '/Facegram/admin/user/update/info':
                $handler= new UsersController();
                $handler->editInfo();
                break;
            case '/Facegram/admin/user/update/image':
                $handler= new UsersController();
                $handler->editImg();
                break;
            case '/Facegram/logout':
                $this->logout();

            default:
            http_response_code(404);
            require '404.php';
            break;
        }

    }
    private function logout(){
        session_start();

        session_unset();
        
        session_destroy();
        
        require "/var/www/html/Facegram/views/login.php";

    }
   
    
    

}

?>