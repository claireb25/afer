<?php 

$path = $_GET['controller'];

if (isset($path)){

switch ($path) {
    case "/afer-back":
    case "/afer-back/":
        require('controllers/ctrlHomepage.php');
        break;
    default :
        require('controllers/ctrl404.php');
        break;
    }
}