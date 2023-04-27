<?php 
include 'session.php';
checker();

?>
    
<!DOCTYPE html>
<title>Welcome!</title>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <h1 class="pagename">Facegram</h1> 
        <nav>
            <ul>
                <li><a href="register.php">Register</a></li>
                <li><a href="index.php">Login</a></li>
            </ul>
        </nav>
    </header>
    <br>
    <div class="center">
        <form action="login.php" method="post">
            <h1>Login</h1>

            <div class="txt_field">
                <label>Email </label>
                <input type="text" name="email">
            </div>

            <div class="txt_field">
                <label>Password </label>
                <input type="password" name="password">
            </div>

            <div class="bttns">
                <button class="bttns2" type="submit">Login</button>
            </div>

        </form>
        <br><br><br>
        
        
    </div>
   

</body>
 