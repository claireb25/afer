<?php

require("utils/security.php");
require_once "models/autoritePrefecture.php";

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
            if (isset($_POST['autorite_nom']) && (!empty($_POST['autorite_nom']))){
                $autorite_nom = htmlentities( trim( $_POST['autorite_nom'] ) );               
                $reponse = getAutoriteNom( $autorite_nom );
                
                if( $reponse === false ){   
                    addNew($autorite_nom);
                }else{
                    showExist( $autorite_nom );
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
                    if( isset( $_POST['autorite_nom'] ) ){
                        $autorite_nom = htmlentities( trim( $_POST['autorite_nom'] ) );               
                        $reponse = getAutoriteNom( $autorite_nom );
            
                        if( $reponse === false ){   
                            updateAutorite($_POST['autorite_nom'], $id );
                        }else{
                            showExistEdit( $autorite_nom, $id );
                        }                            
                        
                    }else{
                        header('Location: /autoriteprefecture/list');
                    }
                    
                }else{
                    showEdit($_GET['id']);
                }
            }else{
                header('Location: /autoriteprefecture/list');
            }
        }else{
            header('Location: /autoriteprefecture/list');
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
                if( isset( $_POST['autorite_nom'] ) ){
                    $autorite_nom = trim( $_POST['autorite_nom'] );               
                    $reponse = getAutoriteNom( $autorite_nom );                    
                   if( $reponse === false ){                   
                        create($autorite_nom);
                        $lastRow = lastRow();
                        $lastRow['autorite_nom'] = html_entity_decode( $lastRow['autorite_nom'] );
                        $data = array('error' => 'add', 'data' => $lastRow );
                        echo json_encode( $data );
                    }else{
                        $data = array( 'error' => 'exist' );
                        echo json_encode( $data );
                    }                            
                    
                }else{
                    header('Location: /autoriteprefecture/list');
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
    $template = $twig->load('indexAutoritePrefecture.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ),'list'=>$list));
}

// NEW
function addNew($valeur){
    $autorite_nom = $valeur;
    create($autorite_nom);
    header('Location: /autoriteprefecture/list');
}

function showNew(){
    global $twig;
    $template = $twig->load('newAutoritePrefecture.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] )));
}

function showNewJson(){
    global $twig;
    $template = $twig->load('newJsonAutoritePrefecture.html.twig');
    $form = $template->render();
    $data = array('error' => '', 'data' => $form );
    echo json_encode( $data );
    
}

function showExist( $autorite_nom ){
    global $twig;
    $template = $twig->load('newAutoritePrefecture.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ), 'error' => 'exist', 'autorite_nom' => $autorite_nom ) );
}

//EDIT 
function showEdit($id){
    $autoritetoEdit = getOne($id);
    global $twig;
    $template = $twig->load('editAutoritePrefecture.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ),'autoritetoEdit'=>$autoritetoEdit));
}

function showExistEdit( $autorite_nom , $id){
    global $twig;
    $template = $twig->load('editAutoritePrefecture.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ), 'error' => 'exist', 'autoritetoEdit'=>array('id' => $id, 'autorite_nom' => $autorite_nom ) ) );
}

function updateAutorite($data, $id){
    $autorite_nom = $data;
    $id = (int)$id;
    edit($autorite_nom, $id);
    header('Location: /autoriteprefecture/list');
   
}

function showDeleteError( $id ){
    global $twig;
    $template = $twig->load('deleteAutoritePrefecture.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] )));
}

//DELETE
function deleteElement($id){
    $id = (int)$id;
    $count = nombreRelationAutoritePrefecture( $id );
    if( $count == 0 ){
        delete($id);
        header('Location: /autoriteprefecture/list');
    }else{
        showDeleteError( $id );
    }    
}

