<?php

require("utils/security.php");
require_once "models/lieuStage.php";

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
            if (isset($_POST['km_ar']) && (!empty($_POST['km_ar']))){
                if (isset($_POST['repas'])){
                    addNew('0, 1, '.$_POST['km_ar']);
                }
                else {
                    addNew('0, 0, '.$_POST['km_ar']);
                }
            } 
            else {
                showNew();
            }
            break; 

        case 'edit':
            if (isset($_GET['id'])){
                showEdit($_GET['id']);  
            }
            if (isset($_POST['km_ar']) && (!empty($_POST['km_ar']))){

                updateType('km_ar', $_POST['km_ar'], $_GET['id']);

                if (isset($_POST['repas'])){
                    updateType('repas', 1, $_GET['id']);
                }
                else {
                    updateType('repas', 0, $_GET['id']);
                }
                header('Location: /afer-back/lieustage/list');
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
    $template = $twig->load('indexLieuStage.html.twig');
    echo $template->render(array('list'=>$list));
}

// NEW
function addNew($data){
    var_dump($data);
    $valeur = htmlentities($data);
    create($valeur);
    header('Location: /afer-back/lieustage/list');
}

function showNew(){
    global $twig;
    $template = $twig->load('newLieuStage.html.twig');
    echo $template->render(array());
}

//EDIT 
function showEdit($id){
    $id = (int)$id;
    $elmttoEdit = getOne($id);
    global $twig;
    $template = $twig->load('editLieuStage.html.twig');
    echo $template->render(array('elmttoEdit'=>$elmttoEdit));
}

function updateType($colonne, $data, $id){
    $valeur = htmlentities($data);
    $id = (int)$id;
    edit($colonne, $valeur, $id);   
}

//DELETE
function deleteElement($id){
    $id = (int)$id;
    delete($id);
    header('Location: /afer-back/lieustage/list');
}

