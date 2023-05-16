<?php 

class AuthenticateController
{
    public function handleLogin()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $errors = array();
        $users=UserModel::getUsersByEmail($email);

        if (!empty($users)) {
            
            $redirectUrl = '';

            if ($users['email'] === $email && password_verify($password, $users['password'])) {
                
                $_SESSION['name'] = $users['name'];
                $_SESSION['id'] = $users['id'];
                $_SESSION['email'] = $email;
                $role = $users['types'];
                
                if ($role === 'admin') {
                    $redirectUrl = '/Facegram/admin/users';
                } elseif ($role === 'user') {
                    $redirectUrl ='/Facegram/user';
                } 
            
                header("Location: " . $redirectUrl);
                exit();
            } else {
                $errors['Log'] = "Incorrect email or password!";
                $_SESSION['errors'] = $errors;
                $redirectUrl ='/Facegram/login';
            }
        }else{
            $errors['Log'] = "Incorrect email or password!";
            $_SESSION['errors'] = $errors;
            $redirectUrl ='/Facegram/login';
        }

        if ($redirectUrl !== '/Facegram/login') {
                        
            header("Location: " . $redirectUrl);
            exit();
        }
    
        require '/var/www/html/Facegram/views/login.php';
            

    }
}