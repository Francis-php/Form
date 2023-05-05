<?php 

include "/var/www/html/Facegram/functionality/redirection.php";
include "/var/www/html/Facegram/functionality/template.php";
include "/var/www/html/Facegram/functionality/index.php";

redir();




?>
    
<!DOCTYPE html>
    <title>Welcome!</title>
    <?php echo $head; ?>
    <body>


        <?php echo $registerNav ; ?>


        <div class="logreg">

            <div class="center">

                <?php if(isset($_SESSION['succ'])) { ?>
            
                    <p class='succ'><?php echo $_SESSION['succ']; ?></p><br>

                <?php unset($_SESSION['succ']); } ?>

                <form action="/Facegram/functionality/authenticate.php" method="post">
                    <h1>Login</h1>

                    <div class="txt_field">
                        <label>Email </label>
                        <input type="text" name="email">
                    </div>

                    <div class="txt_field">
                        <label>Password </label>
                        <input type="password" name="password">
                    </div>
                    <?php if(isset($_SESSION['errors']['Log'])) { ?>
                        <p class='error'><?php echo $_SESSION['errors']['Log']; ?></p><br>
                    <?php unset($_SESSION['errors']); } ?>

                    <div class="bttns">
                        <button class="bttns2" type="submit">Login</button>
                    </div>

                </form>
                <br><br><br>
                
                
            </div>
        
        </div>

    </body>
</htlml>