<?php

require("models/users.php");


require 'vendor/autoload.php';



function twig(){
    $loader = new Twig_Loader_Filesystem('views');
    $twig = new Twig_Environment($loader, array(
        'cache'=> false
    ));

    return $twig;
}


function displayLogin( $args = array() ){
    $tpl =  twig();
    $template = $tpl->load('login.html.twig');
    echo $template->render( $args );
}


function validChamp( $champ ){
    $val = '';

    if( isset( $_POST[ $champ ] ) ){
        if( !empty( $_POST[ $champ ] ) ){
            $val =  htmlentities( trim( $_POST[ $champ ] ) );
        }
    }

    return $val;
}

function testForm(){
    $identifiant = '';
    $mdp = '';
    $test = true;


    $identifiant = validChamp('identifiant');
    $mdp = validChamp('mdp');
    
    if( strlen( $identifiant ) == 0 ){
        $test = false;
    }
    
    if( strlen( $identifiant ) == 0 ){
        $test = false;
    }

    if( $test ){
        $test = verifIdentity( $identifiant, $mdp );
    }

   
    return $test;
}

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

function startSession( $user ){
    session_start();
    $_SESSION['user'] = $user;
}

function validForm(){
    if( testForm() ){
        redirectDashboard();
    }else{
        displayLogin( array('error' => true ) );
    }
}


function redirectDashboard(){
    header('Location: dashboard/view');
}

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




main();