<?php class AuthenticateController{
    public function handleLogin(){
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $this->getFilteredInput(INPUT_POST, 'email');
            $password = $this->getFilteredInput(INPUT_POST, 'password');
            $redirectUrl = $this->authenticateUser($email, $password);
            
            if ($redirectUrl !== '/Facegram/login') {
                header("Location: " . $redirectUrl);
                exit();
            }
        }

        
        require '/var/www/html/Facegram/views/login.php';
        

    }

    private function getFilteredInput($type,$key,$filter=FILTER_DEFAULT){
        return filter_input($type,$key,$filter);
    }


    private function authenticateUser($email,$password){

        include "/var/www/html/Facegram/db/db_conn.php";
        
        $errors = array();
        
        $sql = "SELECT * FROM users WHERE email='$email' ";
        $result = mysqli_query($conn, $sql);
        $redirectUrl = '';
        if (mysqli_num_rows($result) === 1) {
            
            $row = mysqli_fetch_assoc($result);
            if ($row['email'] === $email && password_verify($password, $row['password'])) {
                
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $email;
                $role = $row['types'];
                
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
        } else {
            $errors['Log'] = "Incorrect email or password!";
            $_SESSION['errors'] = $errors;
             $redirectUrl ='/Facegram/login';
        }
        return $redirectUrl;
    }
}