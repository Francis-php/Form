<?php 
include "/var/www/html/Facegram/db/db_conn.php";
include "/var/www/html/Facegram/functionality/redirection.php";
include "/var/www/html/Facegram/functionality/template.php";
redir();
if(isset($_POST['submit'])){
    $email=$_POST['email'];
    $name=$_POST['name'];
    $id=$_SESSION['id'];
    if(empty($name)){
        $errors['Name'] = "Name is required !";
    }
    if(empty($email)){
        $errors['Email'] = "Email is required !";
    }
    if(count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        header("Location:/Facegram/views/edit.php?edit_id=$id");
    }
    else{
        $sql="UPDATE users SET name = '$name', email='$email' WHERE id= $id";
        $conn->query($sql);

        header("Location: /Facegram/user");
    }
}
if(isset($_POST['submitpass'])){
    $password=$_POST['password'];
    $newpass=$_POST['newpass'];
    $newpass1=$_POST['newpass1'];
    $id=$_SESSION['id'];

    $sql = "SELECT password FROM users WHERE id='$id' ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
    if(empty($password)){
        $errors['Password'] = "Password is required !";
    }
    if(empty($newpass)){
        $errors['Newp'] = "New Password is required !";
    }
    if(empty($newpass1)){
        $errors['Conf'] = "Confirmation is required !";
        
    }
    if($newpass1!=$newpass){
        $errors['Match'] = "Passwords don't match !";
    }
    if(!password_verify($password, $row['password'])) {
        $errors['Wrong'] = "Password is wrong !";
    }
    
    if(count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        header("Location:/Facegram/user");
    }

    else{
        
        $newpassword=password_hash($newpass, PASSWORD_DEFAULT);
        $sql="UPDATE users SET password = '$newpassword' WHERE id= $id";
        $conn->query($sql);

        header("Location: /Facegram/user");
        
        
            
        }

        
    }

?>

<!DOCTYPE html>

<title>HOME</title>
<?php echo $head; ?>


<body>

    <?php echo $sidebar1; ?>

    

    <div class="editt">
        
        <div class="pedit">
            <form action="" method="POST" class="ed-form">
                <h1>Update</h1><br><br>
                <label>Name:</label>
                <input type="text" name="name" value="<?= $_SESSION['name']; ?>"><br>
                <?php 
                                        if(isset($_SESSION['errors']['Name'])){
                                            echo "<p class='error'>" . $_SESSION['errors']['Name'] . "</p>";
                                        }
                                    ?>
                <label>Email:</label>
                
                <input type="text" name="email" value="<?= $_SESSION['email']; ?>">
                <?php 
                        if(isset($_SESSION['errors']['Email'])){
                            echo "<p class='error'>" . $_SESSION['errors']['Email'] . "</p>";
                        
                        }
                        if(isset($_SESSION['errors']['EmU'])){
                            echo "<p class='error'>" . $_SESSION['errors']['EmU'] . "</p>";
                            
                        }
                    
                    
                        ?><br>

                        
                <button type="submit" name="submit" class="ad-btn">Edit</button>
                

            </form>
        
            <form action="" method="POST" class="ed-form">
             
                <label>Password:</label>
                <input type="password" name="password" ><br>
                <?php 
                                        if(isset($_SESSION['errors']['Name'])){
                                            echo "<p class='error'>" . $_SESSION['errors']['Name'] . "</p>";
                                        }
                                    ?>
                <label>New Password:</label>
                
                <input type="password" name="newpass" >
                <?php 
                        if(isset($_SESSION['errors']['Email'])){
                            echo "<p class='error'>" . $_SESSION['errors']['Email'] . "</p>";
                        
                        }
                        ?><br>
                        <label>Confirm New Password:</label>
                
                <input type="password" name="newpass1" >
                <?php 
                        if(isset($_SESSION['errors']['Email'])){
                            echo "<p class='error'>" . $_SESSION['errors']['Email'] . "</p>";
                        
                        }
                        ?><br>


                        
                <button type="submit" name="submitpass" class="ad-btn">Edit</button>
                

            </form>
            <br><br><br><br>
        
            <a href="/Facegram/views/admin.php" style="color:black;font-size:26px;" >Back</a>
        
            
        </div>
        <div class="pinfo">
            <form action="">
                <fieldset>
                    <legend><h1>Personal Information</h1></legend>
                    <label>Username:</label>
                    <h4><?php echo $_SESSION['name']; ?></h4>
                    <br>
                    <label>E-mail:</label>
                    <h4><?php echo $_SESSION['email']; ?></h4>
                </fieldset>
            </form>
        </div>
    </div>


    <?php echo $sidebar2; ?>

</body>
<?php echo $sidebar3; ?>
</html>


