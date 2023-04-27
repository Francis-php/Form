<?php 
include "db_conn.php";

$name=$_POST['name'];
$email=$_POST['email'];
$pass1=$_POST['password'];

$password=password_hash($pass1, PASSWORD_DEFAULT);

$sql="INSERT INTO users(name,email,password) VALUES ('$name','$email','$password');";


$conn->query($sql);
   
header("Location:http://localhost/index.php");
    

?>