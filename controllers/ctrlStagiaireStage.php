<?php
require("utils/security.php");
require_once "models/stagiaireStage.php";
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
                $suivisDossierId = createSuivisDossier($_POST['paye'], $_POST['reception_bulletin_inscription'], $_POST['copie_cni'], $_POST['copie_permis'], $_POST['releve_integral'], $_POST['decision_judiciaire'], $_POST['lettre_48n'], $_POST['observations']);
                create($_POST['stagiaire'], $_POST['stage'], $suivisDossierId, $_POST['cas_stage'], $_POST['tribunal'], $_POST['prefecture']);
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
    $template = $twig->load('indexStagiaireStage.html.twig');
    echo $template->render(array('list'=>$list));
}

// NEW
function addNew($stagiaire, $stage, $suivisDossier, $casStage, $tribunal, $prefecture){
    create($stagiaire, $stage, $suivisDossier, $casStage, $tribunal, $prefecture);
}

function addNewSuivisDossier($paye, $receptionBulletinInscription, $copieCni, $copiePermis, $releveIntegral, $decisionJudiciaire, $lettre48n, $observations){
    createSuivisDossier($paye, $receptionBulletinInscription, $copieCni, $copiePermis, $releveIntegral, $decisionJudiciaire, $lettre48n, $observations);
}

function showNew(){
    $stagiaire = stagiaire();
    $stage = stage();
    $casStage = casStage();
    $tribunal = tribunal();
    $prefecture = prefecture();
    var_dump($stagiaire);echo('</br>');echo('</br>');
    var_dump($stage);echo('</br>');echo('</br>');
    var_dump($casStage);echo('</br>');echo('</br>');
    var_dump($tribunal);echo('</br>');echo('</br>');
    var_dump($prefecture);echo('</br>');echo('</br>');
    global $twig;
    $template = $twig->load('test.html.twig');
    echo $template->render(array('stagiaire'=>$stagiaire, 'stage'=>$stage, 'cas_stage'=>$casStage,'tribunal'=>$tribunal, 'prefecture'=>$prefecture));
}

//EDIT 
function showEdit($id){
    $stagiaire = stagiaire();
    $stage = stage();
    $casStage = casStage();
    $tribunal = tribunal();
    $prefecture = prefecture();
    global $twig;
    $template = $twig->load('editStagiaireStage.html.twig');
    echo $template->render(array('stagiaire'=>$stagiaire, 'stage'=>$stage, 'cas_stage'=>$casStage,'tribunal'=>$tribunal, 'prefecture'=>$prefecture));
}

function update($tribunal, $dateInfraction, $heureInfraction, $lieuInfraction, $numeroParquet, $stagiaire, $id){
    $lieuInfraction = htmlentities($lieuInfraction);
    $numeroParquet = htmlentities($numeroParquet);
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
    header('Location: /afer-back/stagiairestage/list');
}