<?php

session_start();

if(isset($_GET['page'])){
    $requested_page = $_GET['page'];
} else
{
    $requested_page = 'home';
}

switch ($requested_page) {
    case 'home':
        include 'main_page.php';
        $_SESSION['page_title'] = "Accueil";
        break;
    case 'contact':
        include 'contact.php';
        $_SESSION['page_title'] = "Contact";
        break;
    case 'about':
        include 'about.php';
        $_SESSION['page_title'] = "About";
        break;
    case 'menu':
        include 'menu.php';
        $_SESSION['page_title'] = "Menu";
        break;
    default:
        include '404.php';
        $_SESSION['page_title'] = "404";
        break;
}
