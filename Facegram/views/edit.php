<?php 
include "/var/www/html/Facegram/db/db_conn.php";
include "/var/www/html/Facegram/functionality/template.php";
include "/var/www/html/Facegram/functionality/redirection.php";
session_start();
$id = $_GET['edit_id'];


$errors = array();
if(isset($_POST['submit'])){
    $email=$_POST['email'];
    $name=$_POST['name'];
    
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
        var_dump($_SESSION['errors']);
        header("Location:/Facegram/admin/edit?edit_id={$id}");
        exit();
    }
    else{
        $sql="UPDATE users SET name = '$name', email='$email' WHERE id= $id";
        $conn->query($sql);

        header("Location:/Facegram/admin/edit?edit_id={$id}");
        exit();
    }
}




$sql="SELECT * FROM users WHERE id='$id'";
$result=mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$imgs = "SELECT users.id, images.img_url FROM images ,users WHERE images.id_img= users.img AND users.id='$id'";
$fin = mysqli_query($conn,  $imgs);
$image = mysqli_fetch_assoc($fin);



?>
<!DOCTYPE html>
<html lang="en">
    <head><?php echo $head; ?><title>Edit</title></head>
 
    <body>
        <?php echo $sidebar1; ?>
        <div class="contain-admin">
            <div class="pinfo">
                <div class="personal-info">
                    <div class="profile-image">
                        <img src="/Facegram/images/<?php echo $image['img_url']; ?>" alt="Profile Image">
                    </div>
                    <div class="user-info">
                        <h2>Personal Information</h2>
                        <p><strong>Username:</strong> <?php echo $row['name']; ?></p>
                        <p><strong>E-mail:</strong> <?php echo $row['email']; ?></p>
                    </div>
                    
                </div>
                
                <br>
                <button class="ad-btn" onclick="showForm()">Change profile picture</button><br>
                <div id="uploadimg" style="display:none;">            
                    <br>
                    <form action="/Facegram/functionality/upload_admn.php" method="POST" enctype="multipart/form-data" class="my-form">
                        <input type="file" name="my_image" style="color:black;">
                        <input type="hidden" name="edit_id" value="<?= $id ?>">
                        <input type="submit" name="submitpic" value="Upload">    
                    </form>
            
                </div>
                <p class='error'><?php echo $_SESSION['errors']['Image'] ?? ''; ?></p>
                    <p class='error'><?php echo $_SESSION['errors']['Datatype'] ?? ''; ?></p>
                
            
            </div><br>
            
            <div class="pinfo">
                <form action="" method="POST" class="my-form">
                <h2 style="color:black">Update</h2>
                    <label>Name</label>
                    <input type="text" name="name" value="<?= $row['name']; ?> "class="form-control">
                    <p class='error'><?php echo $_SESSION['errors']['Name'] ?? ''; ?></p><br>
                    <label>Email</label>
                    
                    <input type="text" name="email" value="<?= $row['email']; ?>" class="form-control">
                    <p class='error'><?php echo $_SESSION['errors']['Email'] ?? ''; ?></p>
                    <p class='error'><?php echo $_SESSION['errors']['EmU'] ?? '' ;unset($_SESSION['errors']); ?></p><br>

                            
                    <button type="submit" name="submit" class="ad-btn">Edit</button>
                

                </form>
            </div>

            
        </div>
        


        
        <a href="/Facegram/admin/users" style="color:black;font-size:30px;font-weight:bold; text-decoration:none;margin-left:50%;" >Back</a>
        <?php 
        echo $sidebar2; ?>

        <?php echo $sidebar3; ?>
        <script>function showForm() {$('#uploadimg').toggle();}</script>
        <?php echo $foot; ?>
    </body>

</html>




