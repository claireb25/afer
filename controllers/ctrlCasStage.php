<?php

require("utils/security.php");
require_once "models/casStage.php";

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
            if (isset($_POST['cas_nom']) && (!empty($_POST['cas_nom'])) && isset($_POST['cas_prix']) && (!empty($_POST['cas_prix'])) && isset($_POST['cas_description']) && (!empty($_POST['cas_description']))  ){
                addNew($_POST['cas_nom'], $_POST['cas_prix'], $_POST['cas_description']);
            } else {
                showNew();
            }
            break; 
        case 'edit':
            if (isset($_GET['id'])){
                showEdit($_GET['id']);
               
            }
            if (isset($_POST['edit_nom']) && (!empty($_POST['edit_nom'])) && isset($_POST['edit_prix']) && (!empty($_POST['edit_prix'])) && isset($_POST['edit_description']) && (!empty($_POST['edit_description']))  ){
                update($_POST['edit_nom'], $_POST['edit_prix'], $_POST['edit_description'], $_GET['id']);
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
    $template = $twig->load('indexCasStage.html.twig');
    echo $template->render(array('list'=>$list));
}

// NEW
function addNew($cas_nom, $cas_prix, $cas_description){
    $nom = htmlentities($cas_nom);
    $prix = htmlentities($cas_prix);
    $description = htmlentities($cas_description);
    create($nom, $prix, $description);
    header('Location: /afer-back/casstage/list');
}

function showNew(){
    global $twig;
    $template = $twig->load('newCasStage.html.twig');
    echo $template->render(array());
}

//EDIT 
function showEdit($id){
    $toEdit = getOne($id);
    global $twig;
    $template = $twig->load('editCasStage.html.twig');
    echo $template->render(array('toEdit'=>$toEdit));
}

function update($cas_nom, $cas_prix, $cas_description, $id){
    $nom = htmlentities($cas_nom);
    $prix = htmlentities($cas_prix);
    $description = htmlentities($cas_description);
    $id = (int)$id;
    edit($nom, $prix, $description, $id);
    header('Location: /afer-back/casstage/list');
   
}
//DELETE
function deleteElement($id){
    $id = (int)$id;
    delete($id);
    header('Location: /afer-back/casstage/list');
}

