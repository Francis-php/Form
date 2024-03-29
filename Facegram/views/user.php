<?php 

include "/var/www/Facegram/views/template.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


?>

<!DOCTYPE html>
<html lang="en">
    <head><?php echo $head; ?><title>Home</title></head>
    
    <body>

    
        <?php echo  $userNav ; ?>

    

        <div class="editt">
            
            <div class="left-edit">
                <div class="pinfo">
                    <div class="personal-info">
                        <div class="profile-image">
                            <img src="/images/<?php echo $image['img_url']; ?>" alt="Profile Image">
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
                        <form action="/user/profile/updateimg" method="POST" name="pictureForm" enctype="multipart/form-data" class="my-form">
                            <input type="file" name="my_image" style="color:black;">
                            <input type="submit" name="submitpic" value="Upload">  
                            <input type="hidden" name="formName" value="pictureForm">
                        </form>
                        
                
                    </div>
                    <p class='error'><?php echo $_SESSION['errors']['Image'] ?? ''; ?></p>
                        <p class='error'><?php echo $_SESSION['errors']['Datatype'] ?? ''; ?></p>
                    <br>
                    <form action="/user/profile/updateinfo" name="infoForm" method="POST" class="my-form">
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" name="name" class="form-control" value="<?= $_SESSION['name']; ?>">
                            <p class='error'><?php echo $_SESSION['errors']['Name'] ?? ''; ?></p><br>
                            <label>Email:</label>               
                            <input type="email" class="form-control" name="email" value="<?= $_SESSION['email']; ?>">
                            <p class='error'><?php echo $_SESSION['errors']['Email'] ?? ''; echo $_SESSION['errors']['EmU'] ?? '' ; ?></p><br> 
                            <input type="hidden" name="formName" value="infoForm">   
                            <button type="submit" name="submit" class="ad-btn">Edit</button>
                        </div>
                    </form>
                    </div>
                    
            </div>

            <div class="right-edit">
            
                <div class="pinfo" >
                    <h2>Security</h2>
                    <form action="/user/profile/updatepass" name="passwordForm" method="POST" class="my-form">
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
                            <p class='success1'><?php echo $_SESSION['success']['Update'] ?? ''; unset($_SESSION['success']); ?></p>

                                
                            <button type="submit" name="submitpass" class="ad-btn">Edit</button>
                        
                        </div> 
                    </form>
                
                </div>
            </div>
        </div>


        <script>function showForm() {$('#uploadimg').toggle();}</script>
        <?php echo $foot; ?>
    </body>

  

    
</html>

