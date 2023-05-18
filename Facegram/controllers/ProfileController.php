<?php 
class ProfileController 
{
    public static function show()
    {  
        $id=$_SESSION['id'];
        $type=UserModel::getUsersById($id)['types'];

        if($type==='user'){
            $image =UserModel::getImageById($id);
            require "/var/www/Facegram/views/user.php";
            
        }else{
            $image = UserModel::getImageById($id);
            require '/var/www/Facegram/views/admin_profile.php';
            
        }
        
    }
    public static function editPic()
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
            $errors['Image']="Please select an image.";
        }else{

            if(!in_array($img_ex_lc, $allowed_exs)){
                $errors['Datatype']="Only JPG, JPEG, and PNG files are allowed.";
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
        ProfileController::show();

    }
    public static function editInfo()
    {
        $name=$_POST['name'];
        $email=$_POST['email'];
        $errors = array();
        $id=$_SESSION['id'];
        $users = UserModel::getUsersById($id);
        $role=$users['types'];

        if(empty($name)){
            $errors['Name'] = "Name is required !";
        }

        if(empty($email)){
            $errors['Email'] = "Email is required !";
        }

        if(!empty($email)){
            $result=UserModel::getUserByEmailAndId($email,$id);

            if(!empty($result)){
                $errors['EmU'] = "Email already in use !";
            }
        }

        if(count($errors) > 0) {
            $_SESSION['errors'] = $errors;

            
        }else{
            UserModel::updateUserInfo($name,$email,$id);
            $_SESSION['name']= $name;
            $_SESSION['email']= $email;
        
        }
        ProfileController::show();
    }
    public static function editPass()
    {
        $password=$_POST['password'];
        $npassword=$_POST['newpass'];
        $cnpassword=$_POST['newpass1'];
        $errors = array();
        $id=$_SESSION['id'];
        $users = UserModel::getUsersById($id);
        $role=$users['types'];

        if(!empty($password)){

            if(!password_verify($password, $users['password'])) {
                $errors['Wrong'] = "Password is wrong !";
            }
        }

        if(empty($password)){
            $errors['Password'] = "Password is required !";
        }

        if(empty($npassword)){
            $errors['Newp'] = "New Password is required !";
        }

        if(empty($cnpassword)){
            $errors['Conf'] = "Confirmation is required !";  
        }

        if($cnpassword!=$npassword){
            $errors['Match'] = "Passwords don't match !";
        }
        
        if(count($errors) > 0){
            $_SESSION['errors'] = $errors;

        }else{
            $success=array();
            $newpassword=password_hash($npassword, PASSWORD_DEFAULT);
            UserModel::updateUserPass($newpassword,$id);
            $success['Update']="Password updated succesfully !";
            $_SESSION['success'] = $success;
        }
        ProfileController::show();
    }

    
}