<?php 
class UsersController{

    public function del(){

        if($_SERVER['REQUEST_METHOD']=== 'POST'){
            $email=$_POST['delete_email'];
            $this->deleter($email);
        }
        require "/var/www/html/Facegram/views/admin.php";

    }
    private function deleter($email){
        include "/var/www/html/Facegram/db/db_conn.php";

        $del="DELETE FROM users WHERE email= '$email'";
        $conn->query($del);
            
    }

    public function create(){
        if($_SERVER['REQUEST_METHOD']=== 'POST') {
            $name= $this->getFilteredInput(INPUT_POST, 'name');
            $email= $this->getFilteredInput(INPUT_POST, 'email');
            $password=$this->getFilteredInput(INPUT_POST, 'password');
            $types=$this->getFilteredInput(INPUT_POST, 'types');
            $role= $this->createUser($name, $email, $password, $types);
            if($role==='admin') {
                require '/var/www/html/Facegram/views/admin.php';
                exit();
            }
            require '/var/www/html/Facegram/views/login.php';
            exit();
        }
        require '/var/www/html/Facegram/views/register.php';
        exit();
    }
    
    private function getFilteredInput($type,$key,$filter=FILTER_DEFAULT){
        return filter_input($type,$key,$filter);
    }
    private function createUser($name,$email,$pass1,$types){
        include "/var/www/html/Facegram/db/db_conn.php";
        session_start();
        $errors = array();
        if(isset($_SESSION['id'])){$id=$_SESSION['id'];
            $sql="SELECT * FROM users WHERE id=$id ";
            $result=mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $role =$row['types'];}
        
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
        if(empty($types)){
            $types='user';
        }
        if(count($errors) > 0){
            $_SESSION['errors'] = $errors;
          
            
        }else{
            $password=password_hash($pass1, PASSWORD_DEFAULT);
            $sql="INSERT INTO users(name,email,password,types) VALUES ('$name','$email','$password','$types');";
            
            $conn->query($sql);
            
            $_SESSION['succ']="Account created succesfully ! You can Login.";
         
        }
        
        return $role;
    }

    public function showdata($id){
        include "/var/www/html/Facegram/db/db_conn.php";
        
        
        $sql="SELECT * FROM users WHERE id='$id'";
        $result=mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $imgs = "SELECT users.id, images.img_url FROM images ,users WHERE images.id_img= users.img AND users.id='$id'";
        $fin = mysqli_query($conn,  $imgs);
        $image = mysqli_fetch_assoc($fin);  

        require '/var/www/html/Facegram/views/edit.php';
        
    }

    public function editInfo(){
        $name=$_POST['name'];
        $email=$_POST['email'];
        $id=$_POST['edit_id'];
        $this->setData($id,$name,$email);        
        $this->showdata($id);
    }
  
    private function setData($id,$name,$email){
        include "/var/www/html/Facegram/db/db_conn.php";
        $errors = array();
        if(empty($name)){
            $errors['Name'] = "Name is required !";
        }
        if(empty($email)){
            $errors['Email'] = "Email is required !";
        }
        if(!empty($email)){
            $sql="SELECT * FROM users WHERE email='$email' AND id !='$id'";
            $result=$conn->query($sql);
        
            if(mysqli_num_rows($result) != 0) {
                $errors['EmU'] = "Email already in use !";
            }
        }
        if(count($errors) > 0) {
            $_SESSION['errors'] = $errors;
            
        }
        else{
            $sql="UPDATE users SET name = '$name', email='$email' WHERE id= $id";
            $conn->query($sql);
        }
    }




    public function editImg(){
        $img=$_FILES["my_image"];
        $id=$_POST['edit_id'];
        $this->setImg($img,$id);
        $this->showdata($id);
    }
    private function setImg($img,$id){
        include "/var/www/html/Facegram/db/db_conn.php";


    $errors = array();
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

    } else {

        $sql = "INSERT INTO images(img_url) VALUES('$img_name')";
        mysqli_query($conn, $sql);
        $sql1="SELECT images.id_img FROM images WHERE img_url='$img_name';";
        $res= mysqli_query($conn, $sql1);
        $row = mysqli_fetch_assoc($res);
        $idm=$row['id_img'];

        $sql2="UPDATE users SET img = '$idm' WHERE id= '$id'";
        $conn->query($sql2);

    }
}
}