
<?php 

include "/var/www/html/Facegram/db/db_conn.php";
include "/var/www/html/Facegram/functionality/redirection.php";
include "/var/www/html/Facegram/functionality/template.php";



?>
<!DOCTYPE html>
<html lang="en">
    <head><?php echo $head; ?><title>Home</title></head>

    <body>
        <?php echo $userNav; ?>

    </body>
    <?php echo $foot ?>
</html>