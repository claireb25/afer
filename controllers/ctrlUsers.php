<?php

require('utils/security.php');
require("models/users.php");
require('vendor/autoload.php');



function twig(){
    $loader = new Twig_Loader_Filesystem('views');
    $twig = new Twig_Environment($loader, array(
        'cache'=> false
    ));

    return $twig;
}


function edit( $id ){

    if( count( $_POST ) > 0 ){
        validForm( $i );
    }else{
        if( !empty( $id ) ){
            $id = ( int ) $id;
            displayViewUser( array( "user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ) ) );
        }else{
            showError();
        }      
    }  
}

function validForm( $id ){
    function validForm(){
        if( testForm( $id ) ){
            showError();
        }else{
            redirectListUser();
        }
    }
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

 function testForm( $id ){
     $identifiant = '';
     $mdp = '';
     $nom = '';
     $prenom = '';
     $test = true;


    $identifiant = validChamp('identifiant');
    $mdp = validChamp('mdp');
    $nom = validChamp('nom');
    $prenom = validChamp('prenom');
    
    if( strlen( $identifiant ) == 0 ){
        $test = false;
    }

    if( strlen( $nom ) == 0 ){
        $test = false;
    }

    if( strlen( $prenom ) == 0 ){
        $test = false;
    }
    
    

    if( $test ){        
        $test = edit(  $id,  $identifiant,  $mdp,  $prenom, $nom  ); 
        if( $test === true ){
            $_SESSION['user'] = array('id' => $id, 'identifiant' => $identifiant, 'prenom' => $prenom, 'nom' => $prenom );
        }       
    }

   
    return $test;
}

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


function redirectListUser(){
    header('Location: users/view');
}


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
            }else{
                redirectListUser();
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