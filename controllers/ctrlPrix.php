<?php

require("utils/security.php");
require_once "models/prix.php";

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
            if (isset($_POST['prix_montant']) && (!empty($_POST['prix_montant']))){
                addNew($_POST['prix_montant']);
            } else {
                showNew();
            }
            break; 
        case 'edit':
            if (isset($_GET['id'])){
                showEdit($_GET['id']);
               
            }
            if (isset($_POST['edit_prix_montant']) && (!empty($_POST['edit_prix_montant']))){
                update($_POST['edit_prix_montant'], $_GET['id']);
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
    $template = $twig->load('indexPrix.html.twig');
    echo $template->render(array('list'=>$list));
}

// NEW
function addNew($prix_montant){
    $prix = htmlentities($prix_montant);
    create($prix);
    header('Location: /afer-back/prix/list');
}

function showNew(){
    global $twig;
    $template = $twig->load('newPrix.html.twig');
    echo $template->render(array());
}

//EDIT 
function showEdit($id){
    $toEdit = getOne($id);
    global $twig;
    $template = $twig->load('editPrix.html.twig');
    echo $template->render(array('toEdit'=>$toEdit));
}

function update($prix_montant, $id){
    $prix = htmlentities($prix_montant);
    $id = (int)$id;
    edit($prix, $id);
    header('Location: /afer-back/prix/list');
   
}
//DELETE
function deleteElement($id){
    $id = (int)$id;
    delete($id);
    header('Location: /afer-back/prix/list');
}

