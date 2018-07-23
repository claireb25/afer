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
                addNew($_POST['autorite_nom']);
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
    echo $template->render(array('list'=>$list));
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
    echo $template->render(array());
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
    // header('Location: /afer-back/autoritetribunal/list');
}

