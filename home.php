<?php 

session_start();

if (isset($_SESSION['id']) && isset($_SESSION['name'])) {

 ?>

<!DOCTYPE html>

<html>

<head>

    <title>HOME</title>

    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<header>
        <h1 class="pagename">Facegram</h1> 
        <nav>
            <ul>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

<body>

     <h1>Hello, <?php echo $_SESSION['name'],' ',$_SESSION['id']; ?></h1>

     

</body>

</html>

<?php 

}else{

     header("Location: index.php");

     exit();

}

 ?>