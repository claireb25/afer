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
            if (isset($_POST['civilite']) && (!empty($_POST['civilite']))){
                addNew($_POST['civilite']);
            } else {
                showNew();
            }
            break; 
        case 'edit':
            if (isset($_GET['id'])){
                showEdit($_GET['id']);
               
            }
            if (isset($_POST['edit_civilite']) && (!empty($_POST['edit_civilite']))){
                update($_POST['edit_civilite'], $_GET['id']);
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
    $template = $twig->load('indexCivilite.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ),'list'=>$list));
}

// NEW
function addNew($valeur){
    $service_nom = htmlentities($valeur);
    create($service_nom);
    header('Location: /afer-back/civilite/list');
}

function showNew(){
    global $twig;
    $template = $twig->load('newCivilite.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ) ) );
}

//EDIT 
function showEdit($id){
    $toEdit = getOne($id);
    global $twig;
    $template = $twig->load('editCivilite.html.twig');
    echo $template->render(array('toEdit'=>$toEdit));
}

function update($data, $id){
    $civilite = htmlentities($data);
    $id = (int)$id;
    edit($civilite, $id);
    header('Location: /afer-back/civilite/list');
   
}
//DELETE
function deleteElement($id){
    $id = (int)$id;
    delete($id);
    // header('Location: /afer-back/civilite/list');
}

