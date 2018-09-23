<?php

require("models/users.php");


require 'vendor/autoload.php';


// Fonction qui va paramétrer le twig
function twig(){
    $loader = new Twig_Loader_Filesystem('views');
    $twig = new Twig_Environment($loader, array(
        'cache'=> false
    ));

    return $twig;
}



//fonction qui appele le twig
//qui permet d'afficher le formulaire
//de login
function displayLogin( $args = array() ){
    $tpl =  twig();
    $template = $tpl->load('login.html.twig');
    echo $template->render( $args );
}


//fonction qui permet de néttoyer
//les champs reçu par post
function validChamp( $champ ){
    $val = '';

    if( isset( $_POST[ $champ ] ) ){
        if( !empty( $_POST[ $champ ] ) ){
            $val =  htmlentities( trim( $_POST[ $champ ] ) );
        }
    }

    return $val;
}


//fonction qui va tester
//si le formulaire est juste ou non
function testForm(){
    $identifiant = '';
    $mdp = '';
    $test = true;


    $identifiant = validChamp('identifiant');
    $mdp = validChamp('mdp');
    
    if( strlen( $identifiant ) == 0 ){
        $test = false;
    }
    
    if( strlen( $mdp ) == 0 ){
        $test = false;
    }

    if( $test ){
        $test = verifIdentity( $identifiant, $mdp );
    }

   
    return $test;
}


//fonction qui est appelé
//pour vérifier si la, personne existe
function verifIdentity( $identifiant, $mdp ){
    $state = true;
    $user = getLogin(  $identifiant, $mdp );
    if( $user  !== false ){
        startSession( $user );        
    }else{
        $state = false;
    }
    return $state;
}


//si la personne existe,
//fonction qui va démarrer la session
//est stocker le user connecté
function startSession( $user ){
    session_start();
    $_SESSION['user'] = $user;
}


//fonction qui appelé et qui vérifie si tout est ok
//si c'est ok on redirige la personne vers le tableau de bord
//sinon on affiche les erreurs
function validForm(){
    if( testForm() ){
        redirectDashboard();
    }else{
        displayLogin( array('error' => true ) );
    }
}

//redirection vers le tableau de bord
function redirectDashboard(){
    header('Location: dashboard/view');
}


//fonction qui vérifie si on reçois la variable get[action]
//si c'est le cas alors on déconnecte la personne
//sinon on charge le formulaire de login
function main(){
    if( count( $_POST ) > 0 ){        
        validForm();
    }else{      
        if( isset( $_GET['action']) ){            
            if( !empty( $_GET['action'] ) ){
                session_start();
                unset( $_SESSION['user'] );
                session_destroy();
                header("Location: /afer-back");
            }
        }else{
            displayLogin();
        }
    }
}



//fonction qui est appelé au chargement de la page
main();