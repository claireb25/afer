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
            if (isset($_POST['status_nom']) && (!empty($_POST['status_nom']))){
                addNew($_POST['status_nom']);
            } else {
                showNew();
            }
            break; 
        case 'edit':
            if (isset($_GET['id'])){
                showEdit($_GET['id']);
               
            }
            if (isset($_POST['edit_statut']) && (!empty($_POST['edit_statut']))){
                updateStatut($_POST['edit_statut'], $_GET['id']);
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
    $template = $twig->load('indexStatutAnim.html.twig');
    echo $template->render(array('list'=>$list));
}

// NEW
function addNew($valeur){
    $status_nom = htmlentities($valeur);
    create($status_nom);
    header('Location: /afer-back/statutanimateur/list');
}

function showNew(){
    global $twig;
    $template = $twig->load('newStatutAnim.html.twig');
    echo $template->render(array());
}

//EDIT 
function showEdit($id){
    $statuttoEdit = getOne($id);
    global $twig;
    $template = $twig->load('editStatutAnim.html.twig');
    echo $template->render(array('statuttoEdit'=>$statuttoEdit));
}
//DELETE
function deleteElement($id){
    $id = (int)$id;
    delete($id);
}

function updateStatut($data, $id){
    $status_nom = htmlentities($data);
    $id = (int)$id;
    edit($status_nom, $id);
    header('Location: /afer-back/statutanimateur/list');
   
}