<?php
include "/var/www/html/Facegram/controllers/AuthenticateController.php";
include "/var/www/html/Facegram/controllers/ProfileController.php";
include "/var/www/html/Facegram/controllers/UsersController.php";
include "/var/www/html/Facegram/middlewares/Middleware.php";
include "/var/www/html/Facegram/models/Database.php";
include "/var/www/html/Facegram/models/UserModel.php";
include "/var/www/html/Facegram/controllers/PostController.php";

session_start();

class Router
{
    private $middleware;
    public function __construct()
    {
        $this->middleware = new Middleware();
    }
    public function route($urlpath)
    {
       
        
        $this->middleware->handle($urlpath);
        $uri= str_replace('/Facegram','',$urlpath);
        $method=$_SERVER['REQUEST_METHOD'];


        $routes=[
            ['uri'=>'/login', 'method'=>'GET', 'controller'=>AuthenticateController::class, 'controllerMethod'=>'login'],
            ['uri'=>'/login/post', 'method'=>'POST', 'controller'=>AuthenticateController::class, 'controllerMethod'=>'handleLogin'],
            ['uri'=>'/register', 'method'=>'GET', 'controller'=>UsersController::class, 'controllerMethod'=>'register'],
            ['uri'=>'/register/submit', 'method'=>'POST', 'controller'=>UsersController::class, 'controllerMethod'=>'create'],
            ['uri'=>'/user', 'method'=>'GET', 'controller'=>PostController::class, 'controllerMethod'=>'showProfile'],
            ['uri'=>'/user/profile', 'method'=>'GET', 'controller'=>ProfileController::class, 'controllerMethod'=>'show'],
            ['uri'=>'/user/profile/updateimg', 'method'=>'POST', 'controller'=>ProfileController::class, 'controllerMethod'=>'editPic'],
            ['uri'=>'/user/profile/updateinfo', 'method'=>'POST', 'controller'=>ProfileController::class, 'controllerMethod'=>'editInfo'],
            ['uri'=>'/user/profile/updatepass', 'method'=>'POST', 'controller'=>ProfileController::class, 'controllerMethod'=>'editPass'],
            ['uri'=>'/admin', 'method'=>'GET', 'controller'=>PostController::class, 'controllerMethod'=>'showProfile'],
            ['uri'=>'/admin/profile', 'method'=>'GET', 'controller'=>ProfileController::class, 'controllerMethod'=>'show'],
            ['uri'=>'/admin/profile/updateimg', 'method'=>'POST', 'controller'=>ProfileController::class, 'controllerMethod'=>'editPic'],
            ['uri'=>'/admin/profile/updateinfo', 'method'=>'POST', 'controller'=>ProfileController::class, 'controllerMethod'=>'editInfo'],
            ['uri'=>'/admin/profile/updatepass', 'method'=>'POST', 'controller'=>ProfileController::class, 'controllerMethod'=>'editPass'],
            ['uri'=>'/admin/users', 'method'=>'GET', 'controller'=>UsersController::class, 'controllerMethod'=>'showUsers'],
            ['uri'=>'/admin/users/create', 'method'=>'POST', 'controller'=>UsersController::class, 'controllerMethod'=>'create'],
            ['uri'=>'/admin/users/delete', 'method'=>'POST', 'controller'=>UsersController::class, 'controllerMethod'=>'del'],
            ['uri'=>'/admin/user/update', 'method'=>'GET', 'controller'=>UsersController::class, 'controllerMethod'=>'showdata'],
            ['uri'=>'/admin/user/update/info', 'method'=>'POST', 'controller'=>UsersController::class, 'controllerMethod'=>'editInfo'],
            ['uri'=>'/admin/user/update/image', 'method'=>'POST', 'controller'=>UsersController::class, 'controllerMethod'=>'editImg'],
            ['uri'=>'/logout', 'method'=>'GET', 'controller'=>Router::class, 'controllerMethod'=>'logout']
        ];

        $matchedRoute= null;

        foreach($routes as $route){

            if($route['uri']===$uri && $route['method']===$method){
                $matchedRoute= $route;
                break;

            }
        }

        if($matchedRoute){
            $controllerName=$matchedRoute['controller'];
            $controllerMethod=$matchedRoute['controllerMethod'];
            $controllerName::$controllerMethod();

        }

        else{

        }



    }
    private static function logout()
    {
        session_unset();
        session_destroy();

        AuthenticateController::login();
    }

}

?>