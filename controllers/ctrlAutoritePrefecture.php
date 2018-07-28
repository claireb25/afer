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
                showEdit($_GET['id']);
               
            }
            if (isset($_POST['edit_autorite']) && (!empty($_POST['edit_autorite']))){
                updateAutorite($_POST['edit_autorite'], $_GET['id']);
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
    $template = $twig->load('indexAutoritePrefecture.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ),'list'=>$list));
}

// NEW
function addNew($valeur){
    $autorite_nom = htmlentities($valeur);
    create($autorite_nom);
    header('Location: /afer-back/autoriteprefecture/list');
}

function showNew(){
    global $twig;
    $template = $twig->load('newAutoritePrefecture.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] )));
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
    echo $template->render(array('autoritetoEdit'=>$autoritetoEdit));
}

function updateAutorite($data, $id){
    $autorite_nom = htmlentities($data);
    $id = (int)$id;
    edit($autorite_nom, $id);
    header('Location: /afer-back/autoriteprefecture/list');
   
}
//DELETE
function deleteElement($id){
    $id = (int)$id;
    delete($id);
    header('Location: /afer-back/autoriteprefecture/list');
}

