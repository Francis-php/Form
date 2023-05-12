<?php 
 
include "/var/www/html/Facegram/db/db_conn.php";
include "/var/www/html/Facegram/functionality/template.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$id=$_SESSION['id'];


$imgs = "SELECT users.id, images.img_url FROM images ,users WHERE images.id_img= users.img AND users.id=$id";
$fin = mysqli_query($conn,  $imgs);
$image = mysqli_fetch_assoc($fin);


 ?>

<!DOCTYPE html>
    <html lang="en">
    <head><?php echo $head; ?><title>Profile</title></head>
    
    
    <body>




        <?php echo $sidebar1 ?>
        
        <div class="editt">
        
        <div class="left-edit">
            <div class="pinfo">
                <div class="personal-info">
                    <div class="profile-image">
                        <img src="/Facegram/images/<?php echo $image['img_url']; ?>" alt="Profile Image">
                    </div>
                    
                    <div class="user-info">
                        <h2>Personal Information</h2>
                        <p><strong>Username:</strong> <?php echo $_SESSION['name']; ?></p>
                        <p><strong>E-mail:</strong> <?php echo $_SESSION['email']; ?></p>
                    </div>
                    
                </div>
                <br>
                <button class="ad-btn" onclick="showForm()">Update profile picture</button><br>
                <div id="uploadimg" style="display:none;">            
                    <br>
                    <form method="POST" enctype="multipart/form-data" class="my-form">
                        <input type="file" name="my_image" style="color:black;">
                        <input type="submit" name="submitpic" value="Upload">    
                        <input type="hidden" name="formName" value="pictureForm">
                    </form>
            
                </div>
                <p class='error'><?php echo $_SESSION['errors']['Image'] ?? ''; ?></p>
                    <p class='error'><?php echo $_SESSION['errors']['Datatype'] ?? ''; ?></p>
                <br>
                <form  method="POST" class="my-form">
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" name="name" class="form-control" value="<?= $_SESSION['name']; ?>"><br>
                        <p class='error'><?php echo $_SESSION['errors']['Name'] ?? ''; ?></p>
                        <label>Email:</label>               
                        <input type="email" class="form-control" name="email" value="<?= $_SESSION['email']; ?>">
                        <p class='error'><?php echo $_SESSION['errors']['Email'] ?? ''; echo $_SESSION['errors']['EmU'] ?? '' ; ?></p><br>    
                        <button type="submit" name="submit" class="ad-btn">Edit</button>
                        <input type="hidden" name="formName" value="infoForm">
                    </div>
                </form>
                </div>
                
        </div>

        <div class="right-edit">
        
            <div class="pinfo" >
                <h2>Security</h2>
                <form  method="POST" class="my-form">
                    <div class="form-group">
                        <label>Password:</label>
                        <input type="password" class="form-control" name="password" >
                        <p class='error'><?php echo $_SESSION['errors']['Password'] ?? '' ; echo $_SESSION['errors']['Wrong'] ?? '' ; ?></p><br>
                        <label>New Password:</label>
                    
                        <input type="password" class="form-control" name="newpass" >
                        <p class='error'><?php echo $_SESSION['errors']['Newp'] ?? ''; ?></p><br>
                        <label>Confirm New Password:</label>
                        <input type="hidden" name="formName" value="passwordForm">
                        <input type="password" class="form-control" name="newpass1" >
                        <p class='error'><?php echo $_SESSION['errors']['Conf'] ?? '';  echo $_SESSION['errors']['Match'] ?? ''; unset($_SESSION['errors']); ?></p><br>


                            
                        <button type="submit" name="submitpass" class="ad-btn">Edit</button>
                    
                    </div> 
                </form>
            
            </div>
        </div>
    </div>

          
    <?php echo $sidebar2 ?>
    <script>function showForm() {$('#uploadimg').toggle();}</script>  
    <?php echo $sidebar3,$foot; ?>

    </body>
   

</html>

