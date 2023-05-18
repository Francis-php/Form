<?php 


include "/var/www/Facegram/views/template.php";



    
?>
<!DOCTYPE html>
<html lang="en">
    <head><?php echo $head; ?><title>Register</title></head>
 
    <body>

        <?php echo $registerNav ; ?>

        <div class="logreg">

            <div class="center">

                <form action="/register/submit" method="POST">
                    <h1>Register</h1>
                
                    <div class="txt_field">
                        <label>Name </label>

                        <p class='error'><?php echo $_SESSION['errors']['Name'] ?? ''; ?></p>
                        <input type="text" name="name">
                    
                    </div>

                    <div class="txt_field">

                        <label>Email </label>

                        <p class='error'><?php echo $_SESSION['errors']['Email'] ?? ''; ?></p>
                        <p class='error'><?php echo $_SESSION['errors']['EmU'] ?? '' ; ?></p>
                        <input type="email" name="email">
                    
                    </div>

                    <div class="txt_field">
                        <label>Password </label>
                        <p class='error'><?php echo $_SESSION['errors']['Password'] ?? '' ;unset($_SESSION['errors']); ?></p>
                        <input type="password" name="password">
                    
                    </div>
                    

                    <div class="bttns">
                        <button class="bttns1" type="submit">Register</button>
                    </div>
                </form><br><br><br>
                
            </div>   

        </div>   
        <?php echo $foot; ?>
    </body>