<?php

require("utils/security.php");
require_once "models/defraiement.php";

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
                    addNew(1, $_POST['km_ar']);
                }
                else {
                    addNew(0, $_POST['km_ar']);
                }
            } 
            else {
                showNew();
            }
            break; 

        case 'edit':
            if (count($_POST) > 0){
                if (isset($_POST['repas'])){
                    updateType(1, $_POST['km_ar'], $_GET['id']);
                }
                else {
                    updateType(0, $_POST['km_ar'], $_GET['id']);
                }
                header('Location: /afer-back/defraiement/list');  
            }
            else {
                showEdit($_GET['id']);
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
    $template = $twig->load('indexDefraiement.html.twig');
    echo $template->render(array('list'=>$list));
}

// NEW
function addNew($repas, $kmar){
    $repas = $repas;
    $kmar = $kmar;
    create($repas, $kmar);
    header('Location: /afer-back/defraiement/list');
}

function showNew(){
    global $twig;
    $template = $twig->load('newDefraiement.html.twig');
    echo $template->render(array());
}

//EDIT 
function showEdit($id){
    $id = (int)$id;
    $elmttoEdit = getOne($id);
    global $twig;
    $template = $twig->load('editDefraiement.html.twig');
    echo $template->render(array('elmttoEdit'=>$elmttoEdit));
}

function updateType($repas, $kmar, $id){
    $repas = $repas;
    $kmar = $kmar;
    $id = (int)$id;
    edit($repas, $kmar, $id);   
}

//DELETE
function deleteElement($id){
    $id = (int)$id;
    delete($id);
    header('Location: /afer-back/defraiement/list');
}

