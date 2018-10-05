<?php

require("utils/security.php");
require_once "models/modeenvoiconvoc.php";

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
            if (isset($_POST['mode_envoi_convoc']) && (!empty($_POST['mode_envoi_convoc']))){
                addNew($_POST['mode_envoi_convoc']);
            } else {
                showNew();
            }
            break; 
        case 'edit':
            if (isset($_GET['id'])){
                showEdit($_GET['id']);
               
            }
            if (isset($_POST['edit_mode_envoi_convoc']) && (!empty($_POST['edit_mode_envoi_convoc']))){
                update($_POST['edit_mode_envoi_convoc'], $_GET['id']);
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
    $template = $twig->load('indexModeEnvoiConvoc.html.twig');
    echo $template->render(array('list'=>$list));
}

// NEW
function addNew($valeur){
    $mode_envoi = htmlentities($valeur);
    create($mode_envoi);
    header('Location: /afer-back/modeenvoiconvocation/list');
}

function showNew(){
    global $twig;
    $template = $twig->load('newModeEnvoiConvoc.html.twig');
    echo $template->render(array());
}

//EDIT 
function showEdit($mode_envoi){
    $toEdit = getOne($mode_envoi);
    global $twig;
    $template = $twig->load('editModeEnvoiConvoc.html.twig');
    echo $template->render(array('toEdit'=>$toEdit));
}

function update($data, $id){
    $mode_envoi = htmlentities($data);
    $id = (int)$id;
    edit($mode_envoi, $id);
    header('Location: /afer-back/modeenvoiconvocation/list');
   
}
//DELETE
function deleteElement($nom_col){
    $nom_col = htmlentities($nom_col);
    delete($nom_col);
    header('Location: /afer-back/modeenvoiconvocation/list');
}

