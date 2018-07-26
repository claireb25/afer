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


function editUser( $id ){

    if( count( $_POST ) > 0 ){
        validForm( $i );
    }else{
        if( !empty( $id ) ){
            $id = ( int ) $id;
            $user = getById( $id );
            displayEditUser( array( "user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ), "users" => $user ) );
        }else{
            redirectDashboardUser();
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

function testForm( $action, $id ){
    $identifiant = '';
    $mdp = '';
    $nom = '';
    $prenom = '';
    $test = true;


    $identifiant = validChamp('identifiant');

    if( $action === 'create'){
        $mdp = validChamp('mdp');
    }
    
    $nom = validChamp('nom');
    $prenom = validChamp('prenom');
    
    if( strlen( $identifiant ) == 0 ){
        $test = false;
    }

    if( $action === 'create'){
        if( strlen( $mdp ) == 0 ){
            $test = false;
        }
    }

    if( strlen( $nom ) == 0 ){
        $test = false;
    }

    if( strlen( $prenom ) == 0 ){
        $test = false;
    }

    if( $test === true ){

        $user = getByIdentifiant( $identifiant );
            if (isset($user[0])){
                $count = count( $user[0] );
            }else {
                $count = count( $user );
        }


        if( $action === 'create' ){
            
            if( $count === 0 ){
                $test = create( $identifiant, $mdp, $prenom, $nom );
            }else{
                $test = 'exist';
            }
        }else{
            if( $count === 0 ){
                $test = edit( $id, $identifiant, $mdp, $prenom, $nom );
            }else{
                $test = 'exist';
            }         
            
        }
        
    }   
    
    return $test;
}

function deleteUser( $id ){
    delete( $id );   
    redirectDashboardUser();
    
}

function validForm( $action, $id = '' ){
    $test = testForm( $action, $id );
    $identifiant =  validChamp('identifiant') ;
    $mdp =  validChamp('mdp') ;
    $nom =  validChamp('nom') ;
    $prenom =  validChamp('prenom') ;

    if( $test === true ){
        redirectDashboardUser();
    }else if( $test === 'exist' ){
        if( $action === 'create' ){
            displayNewUser( array( "user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ), 'error' => 'exist', 'users' => array( 'identifiant' => '', 'mdp' => $mdp, 'prenom' => $prenom, 'nom' => $nom ) ) );
        }else{
            displayEditUser( array( "user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ), 'error' => 'exist', 'users' => array( 'identifiant' => '', 'mdp' => $mdp, 'prenom' => $prenom, 'nom' => $nom ) ) );
        }        
       
    }else{
        displayNewUser( array( "user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ), 'error' => 'blank', 'users' => array( 'identifiant' => $identifiant, 'mdp' => $mdp, 'prenom' => $prenom, 'nom' => $nom ) ) );
    }
}

function listUser(){
    $user = getList();

    displayViewUser( array( "user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ), "users" => $user ) );
}


function displayNewUser( $args ){    
    $tpl =  twig();
    $template = $tpl->load('newUsers.html.twig');
    echo $template->render( $args );
}

function redirectDashboardUser(){
    if( ! isset( $_GET['id'] ) ){
        header('Location: ../users/view');
    }else{
        header('Location: ../../users/view');
    }
    
}


function displayEditUser( $args = array() ){
    $tpl =  twig();
    $template = $tpl->load('editUser.html.twig');
    echo $template->render( $args );
} 

function displayViewUser( $args = array() ){
    $tpl =  twig();
    $template = $tpl->load('indexUsers.html.twig');
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
                        if( count( $_POST ) > 0 ){
                            validForm( 'edit', $id);
                        }else{
                            editUser( $id );
                        }
                    }else{
                        $error = true;
                    }
                }else{
                    $error = true;
                }
            }else if( $_GET['action'] === 'view' ){
                listUser();
            }else if( $_GET['action'] === 'new' ){
                if( count( $_POST ) > 0 ){
                    validForm('create');
                }else{
                    displayNewUser(( array( "user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ) ) ) );
                }
                
            }else if( $_GET['action'] === 'delete'){
                if(  isset( $_GET['id'] )  ){
                    if( !empty( $_GET['id'] ) ){
                        $id = (int) $_GET['id'];
                        deleteUser( $id );
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
        redirectDashboardUser();
    }
}




main();