<?php


include "/var/www/html/Facegram/db/db_conn.php";


$email=$_POST['delete_email'];

$del="DELETE FROM users WHERE email = '$email'";



if($conn->query($del)){

    header("Location: /Facegram/admin/users");

}





?>
