<?php 

class AuthenticateController
{
    public static function login()
    {
        require '/var/www/html/Facegram/views/login.php';
    }
    public static function handleLogin()
    {
        $email=$_POST['email'];
        $password=$_POST['password'];
        $errors=array();
        
        $users = UserModel::getUsersByEmail($email);
        
        if(!empty($users) && password_verify($password, $users['password'])){
            $_SESSION['name'] = $users['name'];
            $_SESSION['id'] = $users['id'];
            $_SESSION['email'] = $email;
            $role = $users['types'];
            
            if($role === 'admin'){
                $redirectUrl = '/Facegram/admin/users';
            }elseif ($role === 'user') {
                $redirectUrl = '/Facegram/user';
            }else{
                $errors['Log'] = "Invalid user role!";
            }
        }else{
            $errors['Log'] = "Incorrect email or password!";
        }
        
        if(!empty($errors)){
            $_SESSION['errors'] = $errors;
            $redirectUrl = '/Facegram/login';
        }
        
        if(isset($redirectUrl)){
            header("Location: " . $redirectUrl);
            exit();
        }
        
        AuthenticateController::login();        
    }
}