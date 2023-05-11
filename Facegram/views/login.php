<?php 

include "/var/www/html/Facegram/functionality/template.php";
include "/var/www/html/Facegram/db/db_conn.php";
// include "/var/www/html/Facegram/functionality/redirection.php";

// redir();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




  



?>
    
<!DOCTYPE html>
<html lang="en">
    <head><?php echo $head; ?><title>Login</title></head>
 
    <body>


        <?php echo $registerNav ; ?>


        <div class="logreg">

            <div class="center">

                

                <form  method="post">
                    <h1>Login</h1>

                    <div class="txt_field">
                        <label>Email </label>
                        <input type="email" name="email">
                    </div>

                    <div class="txt_field">
                        <label>Password </label>
                        <input type="password" name="password">
                    </div>
                    <p class='error'><?php echo $_SESSION['errors']['Log'] ?? '' ;unset($_SESSION['errors']);?></p>

                    <div class="bttns">
                        <button class="bttns2" type="submit">Login</button>
                    </div>

                </form>
                <br><br><br>
                
                
            </div>
        
        </div>
        <?php echo $foot; ?>            
    </body>
</html>