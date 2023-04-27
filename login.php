<?php 
session_start();
include "db_conn.php";

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email' ";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 1) {

    $row = mysqli_fetch_assoc($result);

    if ($row['email'] === $email && password_verify($password, $row['password']) ) {

        if($row['type']=== 'admin'){

            echo "Logged in Admin!";

            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];

            header("Location: admin.php");
            exit();
        
        }
        else{

            echo "Logged in!";

            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];

            header("Location: home.php");
            exit();
        }
    }else{
        
        header("Location: index.php?error=Incorect User name or password");
        exit();
    }

}else{

header("Location: index.php?error=Incorect User name or password");
exit();
}

    



?>