<?php 

session_start();

if (isset($_SESSION['id']) && isset($_SESSION['name'])) {

 ?>

<!DOCTYPE html>

<title>HOME</title>
<head>

    

    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>

    <header>
        <h1 class="pagename">Facegram</h1> 
        <nav>
            <ul id="il">
                <li ><a>Admin Mode</a></li>
                <li ><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>



    <div class="admin">

        <h1>Hello, <?php echo $_SESSION['name']; ?></h1>
        <div class="add-u"><form></form></div>
        <div class="remove-u"><form></form></div>
        
        
    
    </div>


     

</body>

</html>

<?php 

}else{

     header("Location: index.php");

     exit();

}

 ?>