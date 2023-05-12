<?php  

$head="
<meta charset='utf-8'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>
<link rel='stylesheet' type='text/css' href='/Facegram/views/nav_bar.css'>
<link rel='stylesheet' type='text/css' href='/Facegram/views/style.css'>
<link href='https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/datatables.min.css' rel='stylesheet'/>
";

$foot="

<script src='https://code.jquery.com/jquery-3.6.4.min.js' integrity='sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8='crossorigin='anonymous'></script>
<script src='https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/datatables.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js' integrity='sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM' crossorigin='anonymous'></script>
<script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
<script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js' integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>";

// HEADER NAV-BARS//
   
$headerNav="<header class='my-header' >
<div class='navbar-toggle'>
<span onclick='toggleNav()'' class='toggle-icon' >&#9776;</span>
</div><a href='/Facegram/user' class='logo-nav' style='margin-left:-85%;'>
<h1>Facegram</h1>

</a>
<div class>
<button class='btn-nav' type='button' tabindex='1'>
". $_SESSION['name']."<div class='arrow-down'></div>
</button>
<div class='drop-nav' '>
<a href='/Facegram/admin' class='link-nav'>Home</a>
<a href='/Facegram/admin/profile' class='link-nav'>Profile</a>
<a href='/Facegram/logout' class='link-nav'>Logout</a>
</div>
</div>
</header>";

$registerNav="<header class='my-header'>
<h1 >Facegram</h1> 
<nav>
<ul class='ad-ul'>
<li class='ad-ul'><a href='/Facegram/register' class='text-white text-decoration-none'  class='ad-ul'>Register</a></li>
<li class='ad-ul'><a href='/Facegram/login' class='text-white text-decoration-none'  class='ad-ul'>Login</a></li>
</ul>
</nav>
</header>";

 

$userNav="<header class='my-header'>
<a href='/Facegram/user' class='logo-nav'>
<h1>Facegram</h1>
</a>
<div class>
<button class='btn-nav' type='button' tabindex='1'>
". $_SESSION['name']."<div class='arrow-down1'></div>
</button>
<div class='drop-nav'>
<a href='/Facegram/user' class='link-nav'>Home</a>
<a href='/Facegram/user/profile' class='link-nav'>Profile</a>
<a href='/Facegram/logout' class='link-nav'>Logout</a>
</div>
</div>
</header>";




// SIDEBAR ADMIN//

$sidebar1="<div class='all-container'>

<div id='content-all' class='content-all'>
". $headerNav;

$request = $_SERVER['REQUEST_URI'];

$sidebar2=" </div>
<div id='mySidenav' class='sidebar'>
<ul>
<li><a href='/Facegram/admin/users' " . (($request === '/Facegram/admin/users') ? "class='active'" : '') . " >Users</a></li>
<li><a href='/Facegram/admin/profile' " . (($request === '/Facegram/admin/profile') ? "class='active'" : '') . ">Posts</a></li>

</ul>
</div>
</div>";


$sidebar3="<script>function toggleNav() {
var sidenav = document.getElementById('mySidenav');
var contentAll = document.getElementById('content-all');
var navIcon = document.getElementById('nav-icon');
if (sidenav.style.width === '0px') {
sidenav.style.width = '200px';
contentAll.style.width = 'calc(100% - 200px)';
contentAll.style.transform = 'translateX(200px)';
navIcon.classList.add('open');
} else {
sidenav.style.width = '0';
contentAll.style.width = '100%';
contentAll.style.transform = 'translateX(0)';
navIcon.classList.remove('open');
}
}
</script>"
;

$errName="";
$errEmail="";
$errEmU="";
$errName="";
