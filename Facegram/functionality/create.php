<?php 
session_start();

include "/var/www/html/Facegram/functionality/redirection.php";
include "/var/www/html/Facegram/db/db_conn.php";



$name=$_POST['name'];
$email=$_POST['email'];
$pass1=$_POST['password'];


$errors = finderr($name,$email,$pass1);


if(count($errors) > 0){
    $_SESSION['errors'] = $errors;
    header("Location: /Facegram/register");
}else{
    $password=password_hash($pass1, PASSWORD_DEFAULT);
    $sql="INSERT INTO users(name,email,password) VALUES ('$name','$email','$password');";
    
    $conn->query($sql);
    
    $_SESSION['succ']="Account created succesfully ! You can Login.";
    header("Location: /Facegram/login");
}
?>
