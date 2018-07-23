<?php
    $path = '';

    if( isset( $_GET['controller'] ) ){
        $path = $_GET['controller']; 
    }
    
    $path = ( $path== '' )? 'afer-back' : $path;

    switch ($path) {
        case "afer-back":
        case "login":
            require('controllers/ctrlLoginpage.php');
            break;

        case "dashboard":
            require('controllers/ctrlHomepage.php');
            break;
        
        case "casstage":
            require('controllers/ctrlCasStage.php');
            break;
            
        case "forfaitanimateur":
            require('controllers/ctrlForfaitAnimateur.php');
            break;

        case "statutanimateur":
            require('controllers/ctrlStatutAnimateur.php');
            break;

        case "fonctionanimateur":
            require('controllers/ctrlFonctionAnimateur.php');
            break;

        case "autoritetribunal":
            require('controllers/ctrlAutoriteTribunal.php');
            break;

        case "naturetribunal":
            require('controllers/ctrlNatureTribunal.php');
            break;
        
        case "servicetribunal":
            require('controllers/ctrlServiceTribunal.php');
            break;

        case "autoriteprefecture":
            require('controllers/ctrlAutoritePrefecture.php');
            break;

        case "civilite":
        require('controllers/ctrlCivilite.php');
            break; 
            
        case "typeinfraction":
            require('controllers/ctrlTypeInfraction.php');
            break;  
        
        case "natureprefecture":
            require('controllers/ctrlNaturePrefecture.php');
            break;    

        default :
            require('controllers/ctrl404.php');
            break;
    }

?>
