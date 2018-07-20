<?php
    $path = '';

    if( isset( $_GET['controller'] ) ){
        $path = $_GET['controller']; 
    }
    
    $path = ( $path== '' )? 'afer-back' : $path;

    switch ($path) {
        case "afer-back":
            require('controllers/ctrlLoginpage.php');
            break;

        case "statutanimateur":
            require('controllers/ctrlStatutAnimateur.php');
            break;

        case "fonctionanimateur":
            require('controllers/ctrlFonctionAnimateur.php');
            break;
        default :
            require('controllers/ctrl404.php');
            break;
    }

?>
