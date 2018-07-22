<?php

require("utils/security.php");
require_once "models/natureTribunal.php";

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
            if (isset($_POST['nature_nom']) && (!empty($_POST['nature_nom']))){
                addNew($_POST['nature_nom']);
            } else {
                showNew();
            }
            break; 
        case 'edit':
            if (isset($_GET['id'])){
                showEdit($_GET['id']);
               
            }
            if (isset($_POST['edit_nature']) && (!empty($_POST['edit_nature']))){
                updateNature($_POST['edit_nature'], $_GET['id']);
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
    $template = $twig->load('indexNatureTribunal.html.twig');
    echo $template->render(array('list'=>$list));
}

// NEW
function addNew($valeur){
    $autorite_nom = htmlentities($valeur);
    create($autorite_nom);
    header('Location: /afer-back/naturetribunal/list');
}

function showNew(){
    global $twig;
    $template = $twig->load('newNatureTribunal.html.twig');
    echo $template->render(array());
}

//EDIT 
function showEdit($id){
    $naturetoEdit = getOne($id);
    global $twig;
    $template = $twig->load('editNatureTribunal.html.twig');
    echo $template->render(array('naturetoEdit'=>$naturetoEdit));
}

function updateNature($data, $id){
    $nature_nom = htmlentities($data);
    $id = (int)$id;
    edit($nature_nom, $id);
    header('Location: /afer-back/naturetribunal/list');
   
}
//DELETE
function deleteElement($id){
    $id = (int)$id;
    delete($id);
    // header('Location: /afer-back/autoritetribunal/list');
}
