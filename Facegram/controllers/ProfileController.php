<?php 

class ProfileController{

    public function edit($type){
      
        
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
            
            require "/var/www/html/Facegram/views/user.php";
            
        }else{
            
            require '/var/www/html/Facegram/views/admin_profile.php';
            
        }
        
        
        

    }
    private function editPic($img){
        include "/var/www/html/Facegram/db/db_conn.php";
        $errors = array();

    $id=$_SESSION['id'];

    $sql="SELECT * FROM users WHERE id=$id ";
    $result=mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $role=$row['types'];

    $img_name = $img['name'];
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
        
        
    }
    else{


        $sql = "INSERT INTO images(img_url) VALUES('$img_name')";
        mysqli_query($conn, $sql);
        $sql1="SELECT images.id_img FROM images WHERE img_url='$img_name';";
        $res= mysqli_query($conn, $sql1);
        $row = mysqli_fetch_assoc($res);
        $idm=$row['id_img'];
        $id= $_SESSION['id'];
        $sql2="UPDATE users SET img = '$idm' WHERE id= $id";
        $conn->query($sql2);

      
    }

    }
    private function editInfo($name,$email){
    include "/var/www/html/Facegram/db/db_conn.php";

    $errors = array();
    
    $id=$_SESSION['id'];

    $sql="SELECT * FROM users WHERE id=$id ";
    $result=mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $role=$row['types'];

    if(empty($name)){
        $errors['Name'] = "Name is required !";
    }
    if(empty($email)){
        $errors['Email'] = "Email is required !";
    }
    if(!empty($email)) {
        $sql="SELECT * FROM users WHERE email='$email' AND id !='$id'";
        $result=$conn->query($sql);
    
        if(mysqli_num_rows($result) != 0) {
            $errors['EmU'] = "Email already in use !";
        }
    }

    if(count($errors) > 0) {
        
        $_SESSION['errors'] = $errors;

        
    }else{
        
        $sql="UPDATE users SET name = '$name', email='$email' WHERE id= $id";
        $conn->query($sql);

        $_SESSION['name']= $name;
        $_SESSION['email']= $email;
       
        
        
    }

    }
    private function editPass($password,$npassword,$cnpassword){

        include "/var/www/html/Facegram/db/db_conn.php";
        $errors = array();
        $id=$_SESSION['id'];

        $sql="SELECT * FROM users WHERE id=$id ";
        $result=mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $role=$row['types'];
        $sql = "SELECT password FROM users WHERE id='$id' ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if(!empty($password)){
            if(!password_verify($password, $row['password'])) {
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

        }
    
        else{
            
            $newpassword=password_hash($npassword, PASSWORD_DEFAULT);
            $sql="UPDATE users SET password = '$newpassword' WHERE id= $id";
            $conn->query($sql);
    
         
            
            }

    }

    
}