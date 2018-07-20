<?php 

$path = $_GET['controller'];

echo($path);

if (isset($path)){

    switch ($path) {

        case "home":
            require('controllers/ctrlHomepage.php');
            break;

        default :
            require('controllers/ctrl404.php');
            break;
        }
}

else {
    require('controllers/ctrlHomepage.php');
}