<?php 
include "/var/www/html/Facegram/db/db_conn.php";
include "/var/www/html/Facegram/functionality/template.php";
session_start();
$id=$_GET['edit_id'];

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
        header("Location:/Facegram/views/edit.php?edit_id=$id");
    }
    else{
        $sql="UPDATE users SET name = '$name', email='$email' WHERE id= $id";
        $conn->query($sql);

        header("Location: /Facegram/admin");
    }
}


$sql="SELECT * FROM users WHERE id=$id ";
$result=mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


?>
<html>
<?php echo $head; ?>


<body>
<?php echo $sidebar1; ?>


    <div class="editt">
        <form action="" method="POST" class="ed-form">
            <h1>Update</h1><br><br>
            <label>Name</label>
            <input type="text" name="name" value="<?= $row['name']; ?>"><br>
            <?php 
                                    if(isset($_SESSION['errors']['Name'])){
                                        echo "<p class='error'>" . $_SESSION['errors']['Name'] . "</p>";
                                    }
                                ?>
            <label>Email</label>
            
            <input type="text" name="email" value="<?= $row['email']; ?>">
            <?php 
                    if(isset($_SESSION['errors']['Email'])){
                        echo "<p class='error'>" . $_SESSION['errors']['Email'] . "</p>";
                    
                    }
                    if(isset($_SESSION['errors']['EmU'])){
                        echo "<p class='error'>" . $_SESSION['errors']['EmU'] . "</p>";
                        
                    }
                   
                
                    ?><br>

                    
            <button type="submit" name="submit" class="ad-btn">Edit</button>
            

        </form><br><br><br><br>

        <a href="/Facegram/views/admin.php" style="color:black;font-size:26px;" >Back</a>
    </div>
    <?php 
    echo $sidebar2; ?>
</body>
<?php echo $sidebar3; ?>
</html>




