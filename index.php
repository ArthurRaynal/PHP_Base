<?php

if(isset($_GET['page'])){
    $requested_page = $_GET['page'];
} else
{
    $requested_page = 'home';
}

require 'header.php';

switch ($requested_page) {
    case 'home':
        include 'main_page.php';
        break;
    case 'contact':
        include 'contact.php';
        break;
    case 'about':
        include 'about.php';
        break;
    case 'menu':
        include 'menu.php';
        break;
    default:
        include '404.php';
        break;
}
require 'footer.php';
