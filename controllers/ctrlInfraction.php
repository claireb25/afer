<?php
require("utils/security.php");
require_once "models/infraction.php";
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
            if (count($_POST) > 0){
                $infractionId = addNew($_POST['tribunal'], $_POST['date_infraction'], $_POST['heure_infraction'], $_POST['lieu_infraction'], $_POST['numero_parquet'], $_POST['stagiaire']);
                addNewLiaison($infractionId);
                redirectList();
            } 
            else {
                showNew();
            }
            break; 

        case 'edit':
            if (count($_POST) > 0){  
                update($_POST['tribunal'], $_POST['date_infraction'], $_POST['heure_infraction'], $_POST['lieu_infraction'], $_POST['numero_parquet'], $_POST['stagiaire'], $_GET['id']); 
                redirectList();
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
            redirectList();
            break;
    }
}

// LIST
function makeList(){
    $list = listAll();
    global $twig;
    $template = $twig->load('indexInfraction.html.twig');
    echo $template->render(array('list'=>$list));
}

// NEW
function addNew($tribunal, $dateInfraction, $heureInfraction, $lieuInfraction, $numeroParquet, $stagiaire){
    $lieuInfraction = $lieuInfraction;
    $numeroParquet = $numeroParquet;
    $infractionId = create($tribunal, $dateInfraction, $heureInfraction, $lieuInfraction, $numeroParquet, $stagiaire);
    return $infractionId;
}

function addNewLiaison($infractionId){
    $typeInfraction = typeInfraction();
    foreach($typeInfraction as $value){
        if (isset($_POST[$value['type_infraction_nom']])){
            createLiaisonTypeInfraction($infractionId, $_POST[$value['type_infraction_nom']]);
        }
    }
}

function showNew(){
    $stagiaire = stagiaire();
    $tribunal = tribunal();
    $typeInfraction = typeInfraction();
    global $twig;
    $template = $twig->load('newInfraction.html.twig');
    echo $template->render(array('stagiaire'=>$stagiaire, 'tribunal'=>$tribunal, 'typeInfraction'=>$typeInfraction));
}

//EDIT 
function showEdit($id){
    $infraction = infractionByID($id);
    $stagiaire = stagiaire();
    $tribunal = tribunal();
    $typeInfraction = typeInfraction();
    $typeInfractionLiaison = typeInfractionLiaisonByID($id);
    global $twig;
    $template = $twig->load('editInfraction.html.twig');
    echo $template->render(array('infraction'=>$infraction, 'tribunal'=>$tribunal, 'stagiaire'=>$stagiaire, 'typeInfraction'=>$typeInfraction, 'typeInfractionLiaison'=>$typeInfractionLiaison));
}

function update($tribunal, $dateInfraction, $heureInfraction, $lieuInfraction, $numeroParquet, $stagiaire, $id){
    $lieuInfraction = $lieuInfraction;
    $numeroParquet = $numeroParquet;
    $id = (int)$id;
    $typeInfraction = typeInfraction();
    editInfraction($tribunal, $dateInfraction, $heureInfraction, $lieuInfraction, $numeroParquet, $stagiaire, $id);
    deleteTypeInfraction($id);
    foreach($typeInfraction as $value){
        if (isset($_POST[$value['type_infraction_nom']])){
            createLiaisonTypeInfraction($id, $_POST[$value['type_infraction_nom']]);
        }
    }
}

//DELETE
function deleteElement($id){
    $id = (int)$id;
    deleteInfraction($id);
    deleteTypeInfraction($id);
}

// REDIRECTIONS
function redirectList(){
    header('Location: /afer-back/infraction/list');
}