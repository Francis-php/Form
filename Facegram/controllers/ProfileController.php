<?php 


class ProfileController 
{
    public function edit($type)
    {  
        if($_SERVER['REQUEST_METHOD']=== 'POST'){
            
            if(isset($_POST['formName'])){
                
                $formName=$_POST['formName'];

                switch($formName){
                    case 'pictureForm':
                        $img=$_FILES["my_image"];
                        $this->editPic($img);
                        break;
                    case 'infoForm':
                        $name=$_POST['name'];
                        $email=$_POST['email'];
                        $this->editInfo($name,$email);
                        break;
                    case 'passwordForm':
                        $password=$_POST['password'];
                        $newpassword=$_POST['newpass'];
                        $confirmpassword=$_POST['newpass1'];
                        $this->editPass($password,$newpassword,$confirmpassword);
                        break;
                }
                  
            }

        }

        if($type==='user'){
            $id=$_SESSION['id'];
            $image =UserModel::getImageById($id);
            
            require "/var/www/html/Facegram/views/user.php";
            
        }else{
            $id=$_SESSION['id'];
            $image = UserModel::getImageById($id);
            require '/var/www/html/Facegram/views/admin_profile.php';
            
        }
        
    }

    public function editPic($img)
    {
        $id=$_SESSION['id'];
        $errors = array();
        $users =UserModel::getUsersById($id);

        $img_name= $img['name'];
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exs = array("jpg", "jpeg", "png"); 

        if (empty($img_name)) {
            $errors['Image'] = "Please select an image.";
        } else {

            if (!in_array($img_ex_lc, $allowed_exs)) {
                $errors['Datatype'] = "Only JPG, JPEG, and PNG files are allowed.";
            }
        }
        if(count($errors) > 0) {     
            $_SESSION['errors'] = $errors;   
        }else{
            UserModel::uploadPic($img_name);
            $images=UserModel::getImageByName($img_name);
            $img_id=$images['id_img'];
            UserModel::updateUserPicture($img_id,$id);   
        }

    }

    private function editInfo($name,$email)
    {
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

        if(!empty($email)) {
            $result=UserModel::getUserByEmailAndId($email,$id);

            if(!empty($result)) {
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

    }

    private function editPass($password,$npassword,$cnpassword)
    {
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
        
        if(count($errors) > 0) {
            $_SESSION['errors'] = $errors;

        }else{
            $newpassword=password_hash($npassword, PASSWORD_DEFAULT);
            UserModel::updateUserPass($newpassword,$id);
        }

    }

    
}