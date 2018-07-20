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
        $error = false;
    }
    
    if( strlen( $identifiant ) == 0 ){
        $error = false;
    }

   
    return $error;
}

function validForm(){
    if( testForm() ){
        redirectDashboard();
    }else{
        displayLogin( array('error' => true ) );
    }
}

function main(){
    if( count( $_POST ) > 0 ){
        validForm();
    }else{
        displayLogin();
    }
}








main();