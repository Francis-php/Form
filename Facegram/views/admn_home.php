<?php 

include "/var/www/html/Facegram/db/db_conn.php";
include "/var/www/html/Facegram/functionality/redirection.php";
include "/var/www/html/Facegram/functionality/template.php";
redir();

 ?>

<!DOCTYPE html>
<html lang="en">
    <head><?php echo $head; ?><title>Home</title></head>
 
    <body>
        <?php echo $sidebar1 ?>
        
             
        




        <?php echo $sidebar2 ?>
        <?php echo $sidebar3,$foot; ?>

    </body>
   

</html>

