<?php 

class UsersController 
{
    public function showUsers()
    {
        $users = UserModel::getAllUsers();

        require '/var/www/html/Facegram/views/admin.php';
    }

    public function del()
    {
        $email=$_POST['delete_email'];
        UserModel::deleteUserByEmail($email);
        $this->showUsers();
    }
   
    public function create()
    {
        if($_SERVER['REQUEST_METHOD']=== 'POST') {
            $name= $_POST['name'];
            $email= $_POST['email'];
            $pass1=$_POST['password'];
            $types=$_POST['types'];
            $errors = array();

            if(isset($_SESSION['id'])){
                $role='admin';
            }
            
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
                $result=UserModel::getUsersByEmail($email);

                if(!empty($result)){
                    $errors['EmU'] = "Email already in use !";
                }
            }
            if(empty($types)){
                $types='user';
            }

            if(count($errors) > 0){
                $_SESSION['errors'] = $errors;

                if($role==='admin'){
                    $this->showUsers();
                    exit();
                }

                require '/var/www/html/Facegram/views/register.php';
                exit();
                
            }else{
                $password=password_hash($pass1, PASSWORD_DEFAULT);
                UserModel::createUser($name, $email, $password, $types);
                
                $_SESSION['succ']="Account created succesfully ! You can Login.";
            
            }
            
                if($role==='admin') {
                    $this->showUsers();
                    exit();
                }
                require '/var/www/html/Facegram/views/login.php';
                exit();
        }
        require '/var/www/html/Facegram/views/register.php';
        exit();
    }
    
    public function showdata($id)
    {
        $users = UserModel::getUsersById($id);
        $image = UserModel::getImageById($id); 
        require '/var/www/html/Facegram/views/edit.php';  
    }

    public function editInfo()
    {
        $name=$_POST['name'];
        $email=$_POST['email'];
        $id=$_POST['edit_id'];
        $this->setData($id,$name,$email);        
        $this->showdata($id);
    }
  
    private function setData($id,$name,$email)
    {
        $errors = array();
        if(empty($name)){
            $errors['Name'] = "Name is required !";
        }

        if(empty($email)){
            $errors['Email'] = "Email is required !";
        }
        
        if(!empty($email)){
            $result=UserModel::getUserByEmailAndId($email,$id);
        
            if(!empty($result)) {
                $errors['EmU'] = "Email already in use !";
            }
        }

        if(count($errors) > 0) {
            $_SESSION['errors'] = $errors; 
        }

        else{
            UserModel::updateUserInfo($name,$email,$id);
        }
    }

    public function editImg()
    {
        $img=$_FILES["my_image"];
        $id=$_POST['edit_id'];
        $this->setImg($img,$id);
        $this->showdata($id);
    }

    private function setImg($img,$id)
    {
        
        $errors = array();
        $img_name = $img['name'];
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exs = array("jpg", "jpeg", "png");
        if (empty($img_name)) {
            $errors['Image'] = "Please select an image.";
        }else{

            if (!in_array($img_ex_lc, $allowed_exs)) {
                $errors['Datatype'] = "Only JPG, JPEG, and PNG files are allowed.";
            }
        }

        if(count($errors) > 0) {

            $_SESSION['errors'] = $errors;

        }else{

            
            UserModel::uploadPic($img_name);
            $image= UserModel::getImageByName($img_name);
            $idm=$image['id_img'];
            UserModel::updateUserPicture($idm,$id);

        }
        
    }


}