<?php

require('utils/security.php');
require("models/users.php");
require 'vendor/autoload.php';



function twig(){
    $loader = new Twig_Loader_Filesystem('views');
    $twig = new Twig_Environment($loader, array(
        'cache'=> false
    ));

    return $twig;
}


function edit( $id ){

    
    // if( !empty( $id ) ){
    //     $id = ( int ) $id;
    //     $user = getById( $id );
    displayViewUser( array( "user" => array( 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"], 'id' => $_SESSION['user']["id"] ) ) );
    // }else{
    //     showError();
    // }  
   
}


// function validChamp( $champ ){
//     $val = '';

//     if( isset( $_POST[ $champ ] ) ){
//         if( !empty( $_POST[ $champ ] ) ){
//             $val =  htmlentities( trim( $_POST[ $champ ] ) );
//         }
//     }

//     return $val;
// }

// function testForm(){
//     $identifiant = '';
//     $mdp = '';
//     $test = true;


//     $identifiant = validChamp('identifiant');
//     $mdp = validChamp('mdp');
    
//     if( strlen( $identifiant ) == 0 ){
//         $test = false;
//     }
    
//     if( strlen( $identifiant ) == 0 ){
//         $test = false;
//     }

//     if( $test ){
//         $test = verifIdentity( $identifiant, $mdp );
//     }

   
//     return $test;
// }

// function verifIdentity( $identifiant, $mdp ){
//     $state = true;
//     $user = getLogin(  $identifiant, $mdp );
//     if( $user  !== false ){
//         startSession( $user );        
//     }else{
//         $state = false;
//     }
//     return $state;
// }

// function startSession( $user ){
//     session_start();
//     $_SESSION['user'] = $user;
// }

// function validForm(){
//     if( testForm() ){
//         redirectDashboard();
//     }else{
//         displayLogin( array('error' => true ) );
//     }
// }


// function redirectDashboard(){
//     header('Location: users/view');
// }


function displayViewUser( $args = array() ){
    $tpl =  twig();
    $template = $tpl->load('editUser.html.twig');
    echo $template->render( $args );
} 

function main(){
    $error = false;
    if( isset( $_GET['action']) ){
        if( !empty( $_GET['action'] ) ){
            if( $_GET['action'] === 'edit'){
                if(  isset( $_GET['id'] )  ){
                    if( !empty( $_GET['id'] ) ){
                        $id = (int) $_GET['id'];
                        edit( $id );
                    }else{
                        $error = true;
                    }
                }else{
                    $error = true;
                }
            }
        }else{
            $error = true; 
        }
    }else{
        $error = true;        
    }

    if( $error === true ){
        showError();
    }
}




main();