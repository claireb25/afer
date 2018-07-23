<?php

require("utils/security.php");
require_once "models/forfaitAnimateur.php";

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
            if (isset($_POST['forfait']) && (!empty($_POST['forfait']))){
                addNew($_POST['forfait']);
            } else {
                showNew();
            }
            break; 
        case 'edit':
            if (isset($_GET['id'])){
                showEdit($_GET['id']);
               
            }
            if (isset($_POST['edit_forfait']) && (!empty($_POST['edit_forfait']))){
                update($_POST['edit_forfait'], $_GET['id']);
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
    $template = $twig->load('indexForfaitAnimateur.html.twig');
    echo $template->render(array('list'=>$list));
}

// NEW
function addNew($valeur){
    $forfait = htmlentities($valeur);
    create($forfait);
    header('Location: /afer-back/forfaitanimateur/list');
}

function showNew(){
    global $twig;
    $template = $twig->load('newForfaitAnimateur.html.twig');
    echo $template->render(array());
}

//EDIT 
function showEdit($id){
    $toEdit = getOne($id);
    global $twig;
    $template = $twig->load('editForfaitAnimateur.html.twig');
    echo $template->render(array('toEdit'=>$toEdit));
}

function update($data, $id){
    $civilite = htmlentities($data);
    $id = (int)$id;
    edit($civilite, $id);
    header('Location: /afer-back/forfaitanimateur/list');
   
}
//DELETE
function deleteElement($id){
    $id = (int)$id;
    delete($id);
    // header('Location: /afer-back/forfaitanimateur/list');
}
