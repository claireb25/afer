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
                addNew($_POST['tribunal'], $_POST['date_infraction'], $_POST['heure_infraction'], $_POST['lieu_infraction'], $_POST['numero_parquet'], $_POST['stagiaire']);
                addNewLiaison($_POST['numero_parquet']);
                //redirectList();
            } 
            else {
                showNew();
            }
            break; 

        case 'edit':
            if (count($_POST) > 0){  
                update($_POST['tribunal'], $_POST['date_infraction'], $_POST['heure_infraction'], $_POST['lieu_infraction'], $_POST['numero_parquet'], $_POST['conduite_sans_permis'], $_POST['conduite_sans_assurance'], $_GET['id']); 
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
            delete($_GET['id']);
            //redirectList();
            break;
    }
}

// LIST
function makeList(){
    $list = listAll();
    var_dump($list);
    global $twig;
    $template = $twig->load('test.html.twig');
    echo $template->render(array('list'=>$list));
}

// NEW
function addNew($tribunal, $dateInfraction, $heureInfraction, $lieuInfraction, $numeroParquet, $stagiaire){
    $lieuInfraction = htmlentities($lieuInfraction);
    $numeroParquet = htmlentities($numeroParquet);
    create($tribunal, $dateInfraction, $heureInfraction, $lieuInfraction, $numeroParquet, $stagiaire);
}

function addNewLiaison($numeroParquet){
    $typeInfraction = typeInfraction();
    $idInfraction = getIdByNP($numeroParquet);
    foreach($typeInfraction as $value){
        if (isset($_POST[$value['type_infraction_nom']])){
            createLiaisonTypeInfraction($idInfraction['id'], $_POST[$value['type_infraction_nom']]);
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
    $tribunal = tribunal();
    $toEdit = getOne($id);
    global $twig;
    $template = $twig->load('editInfraction.html.twig');
    echo $template->render(array('toEdit'=>$toEdit, 'tribunal'=>$tribunal));
}
function update($tribunal, $dateInfraction, $heureInfraction, $lieuInfraction, $numeroParquet, $csp, $csa, $id){
    $tribunal = htmlentities($tribunal);
    $dateInfraction = htmlentities($dateInfraction);
    $heureInfraction = htmlentities($heureInfraction);
    $lieuInfraction = htmlentities($lieuInfraction);
    $numeroParquet = htmlentities($numeroParquet);
    $csp = htmlentities($csp);
    $csa = htmlentities($csa);
    $id = (int)$id;
    edit($tribunal, $dateInfraction, $heureInfraction, $lieuInfraction, $numeroParquet, $csp, $csa, $id);
   
}

//DELETE
function deleteElement($id){
    $id = (int)$id;
    delete($id);
}

// REDIRECTIONS
function redirectList(){
    header('Location: /afer-back/infraction/list');
}