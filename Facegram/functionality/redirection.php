<?php 


function redir(){


    include "/var/www/html/Facegram/db/db_conn.php";
    session_start();

    $roles = include '/var/www/html/Facegram/functionality/roles.php';


    $uriSegments = parse_url($_SERVER['REQUEST_URI']);
    $lastUriSegment = array_pop($uriSegments);

    



    if (isset($_SESSION['id'])) {

        $id=$_SESSION['id'];
        $sql = "SELECT * FROM users WHERE id='$id'";
        $result = mysqli_query($conn, $sql);
        


        if(mysqli_num_rows($result) === 1) {

            $row= mysqli_fetch_assoc($result);
            $user_role= $row['types'];

            foreach($roles as $role){
                if($user_role=== $role['role']){
                    $redirect=$role['redirects'];
                    if (!($lastUriSegment === $redirect)) {
                        header("Location: $redirect");
                    }
                }
            }

        } 
    } 
    else {

        if(!($lastUriSegment=="/Facegram/login")&&!($lastUriSegment=="/Facegram/register")) {

            header("Location: /Facegram/login");
        }
        return;
    }
}

function finderr($name,$email,$pass1,){

    include "/var/www/html/Facegram/db/db_conn.php";
    session_start();
    $errors = array();
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

    return $errors ;
}

