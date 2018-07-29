<?php

require("utils/security.php");
require_once "models/serviceTribunal.php";

if (isset($_GET['action'])){
       
    $action= $_GET['action'];

    require 'vendor/autoload.php';
    $loader = new Twig_Loader_Filesystem('views');
    $twig = new Twig_Environment($loader, array(
        'cache'=> false
    ));

    switch ($action) {
        case 'list':
            makeList();            
            break;
        case 'new':
            if (isset($_POST['service_nom']) && (!empty($_POST['service_nom']))){
                
                $service_nom = htmlentities( trim( $_POST['service_nom'] ) );               
                $reponse = getServiceNom( $service_nom );
                
                if( $reponse === false ){   
                    addNew($service_nom);
                }else{
                    showExist( $service_nom );
                }
                
            } else {
                showNew();
            }
            break; 
        case 'edit':
            if (isset($_GET['id'])){
                showEdit($_GET['id']);
               
            }
            if (isset($_POST['edit_service']) && (!empty($_POST['edit_service']))){
                updateService($_POST['edit_service'], $_GET['id']);
            }
           
            break;
        
        case 'view':
            $view;
            break;
        case 'delete':
            deleteElement($_GET['id']);
            break;
    }
}
// LIST
function makeList(){
    $list = listAll();
    global $twig;
    $template = $twig->load('indexServiceTribunal.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ), 'list'=>$list));
}

// NEW
function addNew($valeur){
    $service_nom = htmlentities($valeur);
    create($service_nom);
    header('Location: /afer-back/servicetribunal/list');
}

function showNew(){
    global $twig;
    $template = $twig->load('newServiceTribunal.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ) ));
}

function showExist( $service_nom ){
    global $twig;
    $template = $twig->load('newServiceTribunal.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ), 'error' => 'exist', 'service_nom' => $service_nom ) );
}

//EDIT 
function showEdit($id){
    $servicetoEdit = getOne($id);
    global $twig;
    $template = $twig->load('editServiceTribunal.html.twig');
    echo $template->render(array('servicetoEdit'=>$servicetoEdit));
}

function updateService($data, $id){
    $service_nom = htmlentities($data);
    $id = (int)$id;
    edit($service_nom, $id);
    header('Location: /afer-back/servicetribunal/list');
   
}



function showDeleteError( $id ){
    global $twig;
    $template = $twig->load('deleteServiceTribunal.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] )));
}



//DELETE
function deleteElement($id){
    $id = (int)$id;
    $count = nombreRelationServiceTribunal( $id );
    if( $count == 0 ){
        delete($id);
        header('Location: /afer-back/servicetribunal/list');
    }else{
        showDeleteError( $id );
    }    
}


