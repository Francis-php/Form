<?php  
session_start();
   
        $headerNav="<header class='my-header' >
        <div class='navbar-toggle'>
        <span onclick='toggleNav()'' class='toggle-icon' >&#9776;</span>
      </div><h1 style='margin-left:-80%;'>Facegram</h1> 
            <nav>
                <ul class='ad-ul'>
                    <li ><a >". $_SESSION['name']." /</a></li>
                    <li ><a href='/Facegram/functionality/logout.php' class='text-white text-decoration-none'>Logout</a></li>
                </ul>
            </nav>
        </header>";

        $registerNav="    <header class='my-header'>
        <h1 >Facegram</h1> 
        <nav>
            <ul class='ad-ul'>
                <li><a href='/Facegram/register' class='text-white text-decoration-none'>Register</a></li>
                <li><a href='/Facegram/login' class='text-white text-decoration-none'>Login</a></li>
            </ul>
        </nav>
    </header>";

    $head="<head>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>   
    <link rel='stylesheet' type='text/css' href='/Facegram/views/style.css'>
</head>";







        $sidebar1="<div class='all-container'>
        
        <div id='content-all' class='content-all'>
        ". $headerNav;



       $sidebar2=" </div>
        <div id='mySidenav' class='sidebar'>
            <ul>
            <li><a href='#'>Link 1</a></li>
            <li><a href='#'>Link 2</a></li>
            <li><a href='#'>Link 3</a></li>
            <li><a href='#'>Link 4</a></li>
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
            }</script>";