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
            if (isset($_POST['lieu_nom']) && (!empty($_POST['lieu_nom']))){
                addNew($_POST['lieu_nom'], $_POST['etablissement_nom'], $_POST['adresse'], $_POST['code_postal'], $_POST['commune'], $_POST['tel'], $_POST['latitude'], $_POST['longitude'], $_POST['divers']);
            } 
            else {
                showNew();
            }
            break; 

        case 'edit':
            if (count($_POST) > 0){
                updateType($_POST['lieu_nom'], $_POST['etablissement_nom'], $_POST['adresse'], $_POST['code_postal'], $_POST['commune'], $_POST['tel'], $_POST['latitude'], $_POST['longitude'], $_POST['divers'], $_GET['id']);
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
    $template = $twig->load('indexLieuStage.html.twig');
    echo $template->render(array('list'=>$list));
}

// NEW
function addNew($lieuNom, $etablissementNom, $adresse, $codePostal, $commune, $tel, $latitude, $longitude, $divers){
    $lieuNom = htmlentities($lieuNom);
    $etablissementNom = htmlentities($etablissementNom);
    $adresse = htmlentities($adresse);
    $codePostal = htmlentities($codePostal);
    $commune = htmlentities($commune);
    $tel = htmlentities($tel);
    $latitude = htmlentities($latitude);
    $longitude = htmlentities($longitude);
    $divers = htmlentities($divers);
    create($lieuNom, $etablissementNom, $adresse, $codePostal, $commune, $tel, $latitude, $longitude, $divers);
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

function updateType($lieuNom, $etablissementNom, $adresse, $codePostal, $commune, $tel, $latitude, $longitude, $divers, $id){
    $lieuNom = htmlentities($lieuNom);
    $etablissementNom = htmlentities($etablissementNom);
    $adresse = htmlentities($adresse);
    $codePostal = htmlentities($codePostal);
    $commune = htmlentities($commune);
    $tel = htmlentities($tel);
    $latitude = htmlentities($latitude);
    $longitude = htmlentities($longitude);
    $divers = htmlentities($divers);
    edit($lieuNom, $etablissementNom, $adresse, $codePostal, $commune, $tel, $latitude, $longitude, $divers, $id);
    header('Location: /afer-back/lieustage/list');   
}

//DELETE
function deleteElement($id){
    $id = (int)$id;
    delete($id);
    header('Location: /afer-back/lieustage/list');
}

