<?php 

include "/var/www/html/Facegram/functionality/redirection.php";
include "/var/www/html/Facegram/functionality/template.php";
redir();

    
?>
<!DOCTYPE html>
<title>Register!</title>
<?php echo $head; ?>
<body>

<?php echo $registerNav ; ?>

<div class="logreg">

    <div class="center">

        <form action="/Facegram/functionality/create.php" method="POST">
            <h1>Register</h1>
        
            <div class="txt_field">
                <label>Name </label>

                <?php 
                if(isset($_SESSION['errors']['Name'])){
                    echo "<p class='error'>" . $_SESSION['errors']['Name'] . "</p>";
                 }
                ?>
                <input type="text" name="name">
            
            </div>

            <div class="txt_field">

                <label>Email </label>

                <?php 
                if(isset($_SESSION['errors']['Email'])){
                    echo "<p class='error'>" . $_SESSION['errors']['Email'] . "</p>";
                
                }
                if(isset($_SESSION['errors']['EmU'])){
                    echo "<p class='error'>" . $_SESSION['errors']['EmU'] . "</p>";
                
                }
            
                ?>
                <input type="text" name="email">
            
            </div>

            <div class="txt_field">
                <label>Password </label>
                <?php 
                if(isset($_SESSION['errors']['Password'])){
                    echo "<p class='error'>" . $_SESSION['errors']['Password'] . "</p>";
                    unset($_SESSION['errors']);
                }
                ?>
                <input type="password" name="password">
            
            </div>
           

            <div class="bttns">
                <button class="bttns1" type="submit">Register</button>
            </div>
        </form><br><br><br>
        
    </div>   

    </div>   
</body>