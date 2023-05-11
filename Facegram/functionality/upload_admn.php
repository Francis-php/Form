<?php   
session_start();

include "/var/www/html/Facegram/db/db_conn.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
$errors = array();

$id=$_POST['edit_id'];


$img_name = $_FILES['my_image']['name'];
$tmp_name = $_FILES['my_image']['tmp_name'];


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
    
    header("Location:/Facegram/admin/edit?edit_id=$id");
    exit();
}
else{


    $sql = "INSERT INTO images(img_url) VALUES('$img_name')";
    mysqli_query($conn, $sql);
    $sql1="SELECT images.id_img FROM images WHERE img_url='$img_name';";
    $res= mysqli_query($conn, $sql1);
    $row = mysqli_fetch_assoc($res);
    $idm=$row['id_img'];

    $sql2="UPDATE users SET img = '$idm' WHERE id= '$id'";
    $conn->query($sql2);


    header("Location:/Facegram/admin/edit?edit_id=$id");
}
?>