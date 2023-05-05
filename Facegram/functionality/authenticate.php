<?php 
    session_start();
    
    include "/var/www/html/Facegram/db/db_conn.php";

    $errors = array();
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' ";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['email'] === $email && password_verify($password, $row['password'])) {
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['email']= $email;
            if($row['types']=== 'admin') {
                header("Location: /Facegram/admin");
            } else {
                header("Location: /Facegram/user");
            }
        } else {
            $errors['Log'] = "Incorrect email or password!";
            $_SESSION['errors'] = $errors;
            header("Location: /Facegram/login");
            exit();
        }
    } else {
        $errors['Log'] = "Incorrect email or password!";
        $_SESSION['errors'] = $errors;
        header("Location: /Facegram/login");
        exit();
    }
?>
