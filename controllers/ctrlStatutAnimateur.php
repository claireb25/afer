<?php 
require("utils/security.php");
require_once "models/statutAnimateur.php";

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
            if (isset($_POST['statut_nom']) && (!empty($_POST['statut_nom']))){
                            
                $statut_nom = htmlentities( trim( $_POST['statut_nom'] ) );               
                $reponse = getStatutNom( $statut_nom );
                
                if( $reponse === false ){   
                    addNew($statut_nom);
                }else{
                    showExist( $statut_nom );
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
                        if( isset( $_POST['statut_nom'] ) ){
                            $statut_nom = htmlentities( trim( $_POST['statut_nom'] ) );               
                            $reponse = getStatutNom( $statut_nom );
                
                            if( $reponse === false ){
                                edit($_POST['statut_nom'], $id );
                                header('Location: /afer-back/statutanimateur/list');
                            }else{
                                showExistEdit( $statut_nom, $id );
                            }                            
                            
                        }else{
                            header('Location: /afer-back/statutanimateur/list');
                        }
                        
                    }else{
                        showEdit($_GET['id']);
                    }
                }else{
                    header('Location: /afer-back/statutanimateur/list');
                }
            }else{
                header('Location: /afer-back/statutanimateur/list');
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
                $statutAnimateur_nom = trim( $_POST['nom']);               
                $reponse = getStatutNom( $statutAnimateur_nom );                    
                if( $reponse === false ){                   
                    create($statutAnimateur_nom);
                    $lastRow = lastRow();
                    $lastRow['status_nom'] = html_entity_decode( $lastRow['status_nom'] );
                    $data = array('error' => 'add', 'data' => $lastRow );
                    echo json_encode( $data );
                }else{
                    $data = array( 'error' => 'exist' );
                    echo json_encode( $data );
                }                            
                
            }else{
                header('Location: /statutanimateur/list');
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
    $template = $twig->load('indexStatutAnim.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ),'list'=>$list));
}

// NEW
function addNew($valeur){
    $status_nom = $valeur;
    create($status_nom);
    header('Location: /afer-back/statutanimateur/list');
}

function showNew(){
    global $twig;
    $template = $twig->load('newStatutAnim.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] )));
}

function showNewJson(){
    global $twig;
    $template = $twig->load('newJsonStatutAnimateur.html.twig');
    $form = $template->render();
    $data = array('error' => '', 'data' => $form );
    echo json_encode( $data );
    
}

function showExist( $statut_nom ){
    global $twig;
    $template = $twig->load('newStatutAnim.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ), 'error' => 'exist', 'statut_nom' => $statut_nom ) );
}

//EDIT 
function showEdit($id){
    global $twig;
    $statuttoEdit = getOne($id);
    $template = $twig->load('editStatutAnim.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ),'statuttoEdit'=>$statuttoEdit));
}

function showExistEdit( $statut_nom , $id){
    global $twig;
    $template = $twig->load('editStatutAnim.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ), 'error' => 'exist', 'statuttoEdit'=>array('id' => $id, 'fonction_nom' => $statut_nom ) ) );
}

function showDeleteError( $id ){
    global $twig;
    $template = $twig->load('deleteStatutAnim.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] )));
}


//DELETE
function deleteElement($id){
    $id = (int)$id;
    $count = nombreRelationStatutAnimateur( $id );
    if( $count == 0 ){
        delete($id);
        header('Location: /afer-back/statutanimateur/list');
    }else{
        showDeleteError( $id );
    }    
}

function updateStatut($data, $id){
    $status_nom = $data;
    $id = (int)$id;
    edit($status_nom, $id);
    header('Location: /afer-back/statutanimateur/list');
   
}