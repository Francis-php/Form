<!DOCTYPE html>
<title>Register!</title>
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

    <div class="center">


        <form action="create.php" method="POST">

            <h1>Register</h1>

            <div class="txt_field">
            <label>Name </label>
            <input type="text" name="name">
            </div>

            <div class="txt_field">
            <label>Email </label>
            <input type="text" name="email">
            </div>

            <div class="txt_field">
            <label>Password </label>
            <input type="password" name="password">
            </div>
            <div class="bttns">
            <button class="bttns1" type="submit">Register</button>
            </div>
        </form><br><br><br>
        
    </div>   


</body>