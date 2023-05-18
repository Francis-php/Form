<?php 
class UsersController 
{
    public static function showUsers()
    {
        $users = UserModel::getAllUsers();
        require '/var/www/Facegram/views/admin.php';
    }
    public static function del()
    {
        $success=array();
        $email=$_POST['delete_email'];
        UserModel::deleteUserByEmail($email);
        $success['Delete']="Account deleted succesfully !";
        $_SESSION['success'] = $success;
        self::showUsers();
    }
    public static function register()
    {
        require "/var/www/Facegram/views/register.php";
        exit();
    }
    public static function create()
    {
        $name= $_POST['name'];
        $email= $_POST['email'];
        $pass1=$_POST['password'];
        $types=$_POST['types'];
        $errors = array();
        $success = array();

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
                self::showUsers();
                exit();
            }
            self::register();
            exit();
                
        }else{
            $password=password_hash($pass1, PASSWORD_DEFAULT);
            UserModel::createUser($name, $email, $password, $types); 
            
            $success['Account']="Account created succesfully !";
            
            $_SESSION['success'] = $success;

            
        }
            
        if($role==='admin') {
            self::showUsers();
            exit();
        }
            
        AuthenticateController::handleLogin();
        exit();
        
    }
    public static function showdata()
    {
        $id=$_REQUEST['edit_id'];
        $users = UserModel::getUsersById($id);
        $image = UserModel::getImageById($id); 
        require '/var/www/Facegram/views/edit.php';  
    }
    public static function editInfo()
    {
        $name=$_POST['name'];
        $email=$_POST['email'];
        $id=$_POST['edit_id'];
        self::setData($id,$name,$email);        
        self::showdata();
    }
    private static function setData($id,$name,$email)
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
    public static function editImg()
    {
        $img=$_FILES["my_image"];
        $id=$_POST['edit_id'];
        self::setImg($img,$id);
        self::showdata();
    }
    private static function setImg($img,$id)
    {
        
        $img=$_FILES["my_image"];
        $id=$_SESSION['id'];
        $errors = array();
        $users =UserModel::getUsersById($id);

        $img_name= $img['name'];
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exs = array("jpg", "jpeg", "png"); 

        if(empty($img_name)){
            $errors['Image'] = "Please select an image.";

        } else {

            if (!in_array($img_ex_lc, $allowed_exs)) {
                $errors['Datatype'] = "Only JPG, JPEG, and PNG files are allowed.";
            }
        }

        if(count($errors) > 0) {     
            $_SESSION['errors'] = $errors;  

        }else{
            $upload_directory='/var/www/Facegram/images/';
            
            if(!is_dir($upload_directory)){
                mkdir($upload_directory);
            }

            $target_path= $upload_directory. $img_name;
            
            if(move_uploaded_file($img['tmp_name'],$target_path)){
                
                UserModel::uploadPic($img_name);
                $images=UserModel::getImageByName($img_name);
                $img_id=$images['id_img'];
                UserModel::updateUserPicture($img_id,$id);   

            }else{
                $errors['Upload']= 'Failed to upload the image.';
                $_SESSION['errors']=$errors;

            }
            
        }
        
    }


}