<?php

require("utils/security.php");
require_once "models/typeInfraction.php";

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
            if (isset($_POST['type_infraction']) && (!empty($_POST['type_infraction']))){
                addNew($_POST['type_infraction']);
            } else {
                showNew();
            }
            break; 
        case 'edit':
            if (isset($_GET['id'])){
                showEdit($_GET['id']);
               
            }
            if (isset($_POST['type_infraction']) && (!empty($_POST['type_infraction']))){
                updateType($_POST['type_infraction'], $_GET['id']);
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
    $template = $twig->load('indexTypeInfraction.html.twig');
    echo $template->render(array('list'=>$list));
}

// NEW
function addNew($valeur){
    $type_infraction = $valeur;
    create('type_infraction(type_infraction_nom)', $type_infraction);
    header('Location: /afer-back/typeinfraction/list');
}

function showNew(){
    global $twig;
    $template = $twig->load('newTypeInfraction.html.twig');
    echo $template->render(array());
}

//EDIT 
function showEdit($id){
    $typetoEdit = getOne($id);
    global $twig;
    $template = $twig->load('editTypeInfraction.html.twig');
    echo $template->render(array('typetoEdit'=>$typetoEdit));
}

function updateType($data, $id){
    $type_infraction = $data;
    $id = (int)$id;
    edit($type_infraction, $id);
    header('Location: /afer-back/typeinfraction/list');
   
}
//DELETE
function deleteElement($id){
    $id = (int)$id;
    delete($id);
    header('Location: /afer-back/typeinfraction/list');
}

