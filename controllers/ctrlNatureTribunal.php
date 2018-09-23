<?php

require("utils/security.php");
require_once "models/natureTribunal.php";

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
            if (isset($_POST['nature_nom']) && (!empty($_POST['nature_nom']))){
                    
                $nature_nom = htmlentities( trim( $_POST['nature_nom'] ) );               
                $reponse = getNatureNom( $nature_nom );
                
                if( $reponse === false ){   
                    addNew($nature_nom);
                }else{
                    showExist( $nature_nom );
                }
                
            } else {
                showNew();
            }
            break; 
        case 'edit':
        if (isset($_GET['id'])){
            if( !empty( $_GET['id'] ) ){
                $id = (int) $_GET['id'];
                if( count( $_POST ) > 0 ){
                    if( isset( $_POST['nature_nom'] ) ){
                        $nature_nom = htmlentities( trim( $_POST['nature_nom'] ) );               
                        $reponse = getNatureNom( $nature_nom );
            
                        if( $reponse === false ){   
                            updateNature($_POST['nature_nom'], $id );
                        }else{
                            showExistEdit( $nature_nom, $id );
                        }                            
                        
                    }else{
                        header('Location: /afer-back/naturetribunal/list');
                    }
                    
                }else{
                    showEdit($_GET['id']);
                }
            }else{
                header('Location: /afer-back/naturetribunal/list');
            }
        }else{
            header('Location: /afer-back/naturetribunal/list');
        }
           
            break;
        
        case 'view':
            $view;
            break;
        case 'delete':
            deleteElement($_GET['id']);
            break;

        case 'newjson' :
        if( count( $_POST ) > 0 ){
            if( isset( $_POST['nature_nom'] ) ){
                $nature_nom = htmlentities( trim( $_POST['nature_nom'] ) );               
                $reponse = getNatureNom( $nature_nom );                    
                if( $reponse === false ){                   
                    create($nature_nom);
                    $lastRow = lastRow();
                    $lastRow['nature_nom'] = html_entity_decode( $lastRow['nature_nom'] );
                    $data = array('error' => 'add', 'data' => $lastRow );
                    echo json_encode( $data );
                }else{
                    $data = array( 'error' => 'exist' );
                    echo json_encode( $data );
                }                            
                
            }else{
                header('Location: /afer-back/naturetribunal/list');
            }
        }else{
            showNewJson();
        }
            
    break;
    }
}
// LIST
function makeList(){
    $list = listAll();
    global $twig;
    $template = $twig->load('indexNatureTribunal.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ),'list'=>$list));
}

// NEW
function addNew($valeur){
    $nature_nom = $valeur;
    create($nature_nom);
    header('Location: /afer-back/naturetribunal/list');
}

function showNew(){
    global $twig;
    $template = $twig->load('newNatureTribunal.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] )));
}

function showExist( $nature_nom ){
    global $twig;
    $template = $twig->load('newNatureTribunal.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ), 'error' => 'exist', 'nature_nom' => $nature_nom ) );
}

function showNewJson(){
    global $twig;
    $template = $twig->load('newJsonNatureTribunal.html.twig');
    $form = $template->render();
    $data = array('error' => '', 'data' => $form );
    echo json_encode( $data );
    
}

//EDIT 
function showEdit($id){
    $naturetoEdit = getOne($id);
    global $twig;
    $template = $twig->load('editNatureTribunal.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ),'naturetoEdit'=>$naturetoEdit));
}

function showExistEdit( $nature_nom , $id){
    global $twig;
    $template = $twig->load('editNatureTribunal.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ), 'error' => 'exist', 'naturetoEdit'=>array('id' => $id, 'nature_nom' => $nature_nom ) ) );
}

function updateNature($data, $id){
    $nature_nom = $data;
    $id = (int)$id;
    edit($nature_nom, $id);
    header('Location: /afer-back/naturetribunal/list');
   
}

function showDeleteError( $id ){
    global $twig;
    $template = $twig->load('deleteNatureTribunal.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] )));
}

//DELETE
function deleteElement($id){
    $id = (int)$id;
    $count = nombreRelationNatureTribunal( $id );
    if( $count == 0 ){
        delete($id);
        header('Location: /afer-back/naturetribunal/list');
    }else{
        showDeleteError( $id );
    }    
}

