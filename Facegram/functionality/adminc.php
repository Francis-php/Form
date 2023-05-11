<?php 
session_start();

include "/var/www/html/Facegram/db/db_conn.php";
include "/var/www/html/Facegram/functionality/redirection.php";

$name=$_POST['name'];
$email=$_POST['email'];
$pass1=$_POST['password'];
$types=$_POST['types'];

$errors = finderr($name,$email,$pass1);
if(count($errors) > 0){
    $_SESSION['errors'] = $errors;
    header("/Facegram/admin/users");
}
else{

    $password=password_hash($pass1, PASSWORD_DEFAULT);
    $sql="INSERT INTO users(name,email,password, types) VALUES ('$name','$email','$password','$types');";
    $conn->query($sql);

    header("Location: /Facegram/admin/users");
}
?>