<?php 
include "/var/www/html/Facegram/db/db_conn.php";
include "/var/www/html/Facegram/functionality/template.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


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
                    <form action="/Facegram/admin/user/update/image" method="POST" enctype="multipart/form-data" class="my-form">
                        <input type="file" name="my_image" style="color:black;">
                        <input type="hidden" name="edit_id" value="<?= $id ?>">
                        <input type="submit" name="submitpic" value="Upload">    
                    </form>
            
                </div>
                <p class='error'><?php echo $_SESSION['errors']['Image'] ?? ''; ?></p>
                    <p class='error'><?php echo $_SESSION['errors']['Datatype'] ?? ''; ?></p>
                
            
            </div><br>
            
            <div class="pinfo">
                <form action="/Facegram/admin/user/update/info" method="POST" class="my-form">
                <h2 style="color:black">Update</h2>
                    <label>Name</label>
                    <input type="text" name="name" value="<?= $row['name']; ?> "class="form-control">
                    <p class='error'><?php echo $_SESSION['errors']['Name'] ?? ''; ?></p><br>
                    <label>Email</label>
                    <input type="hidden" name="edit_id" value="<?= $id ?>">
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




