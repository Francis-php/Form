<?php 

class Register{

    public function create(){
        if($_SERVER['REQUEST_METHOD']=== 'POST'){
            $name= $this->getFilteredInput(INPUT_POST,'name');
            $email= $this->getFilteredInput(INPUT_POST,'email');
            $password=$this->getFilteredInput(INPUT_POST,'password');
            $this->createUser($name,$email,$password);
            
            
            exit();
       }

       require '/var/www/html/Facegram/views/register.php';
       

    }
    private function getFilteredInput($type,$key,$filter=FILTER_DEFAULT){
        return filter_input($type,$key,$filter);
    }
    private function createUser($name,$email,$pass1){
        include "/var/www/html/Facegram/db/db_conn.php";
        session_start();
        $errors = array();
        
        if(empty($name)){
            $errors['Name'] = "Name is required !";
        }
        
        if(empty($email)){
            $errors['Email'] = "Email is required !";
        }
        
        if(empty($pass1)){
            $errors['Password'] = "Password is required !";
        }
        
        if(!empty($email)){
            $sql="SELECT * FROM users WHERE email='$email'";
            $result=$conn->query($sql);
        
            if(mysqli_num_rows($result) != 0) {
                $errors['EmU'] = "Email already in use !";
            }
        }
        if(count($errors) > 0){
            $_SESSION['errors'] = $errors;
            header("Location: /Facegram/register");
            exit();
        }else{
            $password=password_hash($pass1, PASSWORD_DEFAULT);
            $sql="INSERT INTO users(name,email,password) VALUES ('$name','$email','$password');";
            
            $conn->query($sql);
            
            $_SESSION['succ']="Account created succesfully ! You can Login.";
            header("Location: /Facegram/login");
            exit();
        }
        
    }
}

?>