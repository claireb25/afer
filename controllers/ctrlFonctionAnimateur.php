<?php 
require("utils/security.php");
require("models/fonctionAnimateur.php");

require 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader, array(
    'cache'=> false
));

if (isset($_GET['action'])){

    $action= $_GET['action'];
    
    switch ($action) {

        case 'list':
            showList();
            break;

        case 'new':
            if (isset($_POST['fonction_nom']) && (!empty($_POST['fonction_nom']))){
                        
                $fonction_nom = trim( $_POST['fonction_nom']  );               
                $reponse = getFonctionNom( $fonction_nom );
                
                if( $reponse === false ){   
                    addNew($fonction_nom);
                }else{
                    showExist( $fonction_nom );
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
                        if( isset( $_POST['fonction_nom'] ) ){
                            $fonction_nom =  trim( $_POST['fonction_nom']  );               
                            $reponse = getFonctionNom( $fonction_nom );
                
                            if( $reponse === false ){
                                edit($_POST['fonction_nom'], $id );
                                header('Location: /afer-back/fonctionanimateur/list');
                            }else{
                                showExistEdit( $fonction_nom, $id );
                            }                            
                            
                        }else{
                            header('Location: /afer-back/fonctionanimateur/list');
                        }
                        
                    }else{
                        showOne($_GET['id']);
                    }
                }else{
                    header('Location: /afer-back/fonctionanimateur/list');
                }
            }else{
                header('Location: /afer-back/fonctionanimateur/list');
            }
            break;

        case 'view':
            $view;
            break;
            
        case 'delete':
            if (isset($_GET['id'])){
                deleteElement($_GET['id']);
            }
            break;

        case 'newjson' :
        if( count( $_POST ) > 0 ){
            if( isset( $_POST['nom'] ) ){
                $fonctionAnimateur_nom = trim( $_POST['nom']);               
                $reponse = getFonctionNom( $fonctionAnimateur_nom );                    
                if( $reponse === false ){                   
                    create($fonctionAnimateur_nom);
                    $lastRow = lastRow();
                    $lastRow['fonction_nom'] =  $lastRow['fonction_nom'] ;
                    $data = array('error' => 'add', 'data' => $lastRow );
                    echo json_encode( $data );
                }else{
                    $data = array( 'error' => 'exist' );
                    echo json_encode( $data );
                }                            
                
            }else{
                header('Location: /fonctionanimateur/list');
            }
        }else{
            showNewJson();
        }
                
        break;
    }
}

function showOne($id){
    global $twig;
    $list = listOne('fonction_animateur', $id);
    $template = $twig->load('editFonctionAnim.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ),'list' => $list));
}

function showExistEdit( $fonction_nom , $id){
    global $twig;
    $template = $twig->load('editFonctionAnim.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ), 'error' => 'exist', 'list'=>array('id' => $id, 'fonction_nom' => $fonction_nom ) ) );
}

function showList(){
    global $twig;
    $list = listAll('fonction_animateur');
    $template = $twig->load('indexFonctionAnim.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ),'list' => $list));
}

function addNew($valeur){
    global $twig;    
    create('fonction_animateur(fonction_nom)', $valeur);
    header("Location: /afer-back/fonctionanimateur/list");
}


function showNewJson(){
    global $twig;
    $template = $twig->load('newJsonFonctionAnimateur.html.twig');
    $form = $template->render();
    $data = array('error' => '', 'data' => $form );
    echo json_encode( $data );
    
}

function showExist( $fonction_nom ){
    global $twig;
    $template = $twig->load('newFonctionAnim.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ), 'error' => 'exist', 'fonction_nom' => $fonction_nom ) );
}

function showNew(){
    global $twig;
    $template = $twig->load('newFonctionAnim.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] )));
}

function showDeleteError( $id ){
    global $twig;
    $template = $twig->load('deleteFonctionAnimateur.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] )));
}


//DELETE
function deleteElement($id){
    $id = (int)$id;
    $count = nombreRelationFonctionAnimateur( $id );
    if( $count == 0 ){
        delete($id);
        header('Location: /afer-back/fonctionanimateur/list');
    }else{
        showDeleteError( $id );
    }    
}