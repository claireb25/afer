<?php

require("utils/security.php");
require_once "models/civilite.php";

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
            if (isset($_POST['nom']) && (!empty($_POST['nom']))){
                $nom = htmlentities( trim( $_POST['nom'] ) );               
                $reponse = getNom( $nom );
                
                if( $reponse === false ){   
                    addNew($nom);
                }else{
                    showExist( $nom );
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
                    if( isset( $_POST['nom'] ) ){
                        $nom = htmlentities( trim( $_POST['nom'] ) );               
                        $reponse = getNom( $nom );
            
                        if( $reponse === false ){   
                            update($_POST['nom'], $id );
                        }else{
                            showExistEdit( $nom, $id );
                        }                            
                        
                    }else{
                        header('Location: /civilite/list');
                    }
                    
                }else{
                    showEdit($_GET['id']);
                }
            }else{
                header('Location: /civilite/list');
            }
        }else{
            header('Location: /civilite/list');
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
            if( isset( $_POST['nom'] ) ){
                $nom = htmlentities( trim( $_POST['nom'] ) );               
                $reponse = getNom( $nom );                    
                if( $reponse === false ){                   
                    create($nom);
                    $lastRow = lastRow();
                    $lastRow['nom'] = html_entity_decode( $lastRow['nom'] );
                    $data = array('error' => 'add', 'data' => $lastRow );
                    echo json_encode( $data );
                }else{
                    $data = array( 'error' => 'exist' );
                    echo json_encode( $data );
                }                            
                
            }else{
                header('Location: /civilite/list');
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
    $template = $twig->load('indexCivilite.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ),'list'=>$list));
}

// NEW
function addNew($valeur){
    $nom = htmlentities($valeur);
    create($nom);
    header('Location: /civilite/list');
}

function showNew(){
    global $twig;
    $template = $twig->load('newCivilite.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ) ) );
}

function showExist( $nom ){
    global $twig;
    $template = $twig->load('newCivilite.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ), 'error' => 'exist', 'nom' => $nom ) );
}

function showNewJson(){
    global $twig;
    $template = $twig->load('newJsonCivilite.html.twig');
    $form = $template->render();
    $data = array('error' => '', 'data' => $form );
    echo json_encode( $data );
    
}

//EDIT 
function showEdit($id){
    $toEdit = getOne($id);
    global $twig;
    $template = $twig->load('editCivilite.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ),'civilitetoEdit'=>$toEdit));
}

function showExistEdit( $nom , $id){
    global $twig;
    $template = $twig->load('editCivilite.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ), 'error' => 'exist', 'civilitetoEdit'=>array('id' => $id, 'nom' => $nom ) ) );
}

function update($data, $id){
    $civilite = htmlentities($data);
    $id = (int)$id;
    edit($civilite, $id);
    header('Location: /civilite/list');
   
}

function showDeleteError( $id ){
    global $twig;
    $template = $twig->load('deleteCivilite.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] )));
}


//DELETE
function deleteElement($id){
    $id = (int)$id;
    $count = nombreRelationCiviliteAnimateur( $id );
    if( $count == 0 ){
        delete($id);
        header('Location: /civilite/list');
    }else{
        showDeleteError( $id );
    }    
}

