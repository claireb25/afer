<?php
require("utils/security.php");
require_once "models/stage.php";
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
                if (isset($_POST['hpo'])){
                    $_POST['hpo'] = 1;
                } else {
                    $_POST['hpo'] = 0;
                }
                if ($_POST['lieu_stage_id'] !== ''){
                    $idStage = addNew($_POST['lieu_stage_id'], $_POST['stage_numero'], $_POST['date_debut'], $_POST['date_fin'], $_POST['hpo']);
                    updateLieuxStage($_POST['lieu_stage_id'], $_POST['lieu_stage_nom'], $_POST['etablissement_nom'], $_POST['adresse'], $_POST['code_postal'], $_POST['commune'], $_POST['tel'], $_POST['latitude'], $_POST['longitude'], $_POST['divers'], $_POST['numero_agrement']);
                    addAnimsToStage($_POST['animateur_nom_id'], $idStage);
                    redirectStageList();
                } else {
                    $lieuId = addLieuxStage($_POST['lieu_stage_nom'], $_POST['etablissement_nom'], $_POST['adresse'], $_POST['code_postal'], $_POST['commune'], $_POST['tel'], $_POST['latitude'], $_POST['longitude'], $_POST['divers'], $_POST['numero_agrement']);
                    $stageId = addNew($lieuId, $_POST['stage_numero'], $_POST['date_debut'], $_POST['date_fin'], $_POST['hpo']);
                    addAnimsToStage($_POST['animateur_nom_id'], $stageId);
                    redirectStageList();
                }
            } else {
                showNew();     
            }
            break; 
        case 'edit':
            if (count($_POST) > 0){   
                if (isset($_POST['hpo'])){
                    $_POST['hpo'] = 1;
                } else {
                    $_POST['hpo'] = 0;
                }
                if ($_POST['lieu_stage_id'] !== ''){
                    updateStage($_POST['edit_stage_numero'], $_POST['lieu_stage_id'], $_POST['edit_date_debut'], $_POST['edit_date_fin'], $_POST['hpo'], $_GET['id']);
                    redirectStageList(); 
                } else {
                    echo 'wrong';
                    $lieuId = addLieuxStage($_POST['lieu_stage_nom'], $_POST['etablissement_nom'], $_POST['adresse'], $_POST['code_postal'], $_POST['commune'], $_POST['tel'], $_POST['latitude'], $_POST['longitude'], $_POST['divers'], $_POST['numero_agrement']);
                    updateStage($_POST['edit_stage_numero'], $lieuId, $_POST['edit_date_debut'], $_POST['edit_date_fin'], $_POST['hpo'], $_GET['id']);
                }
            } else {
                showEdit($_GET['id']);
            }
            break;
        case 'view':
            $view;
            break;
        case 'query':
            if (isset($_POST['keyword'])){
                $keyword = $_POST['keyword'];
                autoCompleteLieu($keyword);
            } else if (isset($_POST['animateur'])){
                $animateur = $_POST['animateur'];
                autoCompleteAnim($animateur);
            }
            break;
        case 'delete':
            deleteElement($_GET['id']);
            redirectStageList();
            break;
    }
}
// LIST
function makeList(){
    $list = listAll();
    global $twig;
    $template = $twig->load('indexStage.html.twig');
    echo $template->render(array('list'=>$list));
}

//NEW

// when adding a new stage 
function addNew($lieu_stage, $stage_numero, $date_debut, $date_fin, $stage_hpo){
    $lieu_stage = (int)$lieu_stage;
    $stage_numero = trim(htmlentities($stage_numero));
    $date_debut = trim(htmlentities($date_debut));
    $date_fin = trim(htmlentities($date_fin));
    $stage_hpo = (bool)$stage_hpo;
    $idStage = create($lieu_stage, $stage_numero, $date_debut, $date_fin, $stage_hpo);
    return $idStage;
}


// when adding a new stage and lieu doesn't exist
function addLieuxStage($lieu_stage_nom, $etablissement_nom, $adresse, $code_postal, $commune, $tel, $latitude, $longitude, $divers, $numero_agrement){
    $lieu_stage_nom = trim(htmlentities($lieu_stage_nom));
    $etablissement_nom = trim(htmlentities($etablissement_nom));
    $adresse = trim(htmlentities($adresse));
    $code_postale = trim(htmlentities($code_postal));
    $commune = trim(htmlentities($commune));
    $tel = trim(htmlentities($tel));
    $latitude = trim(htmlentities($latitude));
    $longitude = trim(htmlentities($longitude));
    $divers = trim(htmlentities($divers));
    $numero_agrement = trim(htmlentities($numero_agrement));
    $lieuId = createLieu($lieu_stage_nom, $etablissement_nom, $adresse, $code_postal, $commune, $tel, $latitude, $longitude, $divers, $numero_agrement);
    return $lieuId;
}

// adding a new stage after creating a lieu and getting the lastInsertId
// function addNewStage($stage_numero, $lieuId, $date_debut, $date_fin, $stage_hpo){
//     $lieuId = (int)$lieuId;
//     $stage_numero = trim(htmlentities($stage_numero));
//     $date_debut = trim(htmlentities($date_debut));
//     $date_fin = trim(htmlentities($date_fin));
//     $stage_hpo = (bool)$stage_hpo;
//     createNewStage($stage_numero, $lieuId, $date_debut, $date_fin, $stage_hpo);
// }

function addAnimsToStage($anims, $idStage){
    $anims = (int)$anims;
    $idStage = (int)$idStage;
    if (isset($_POST['animateur_nom_id'])){
        $animateurs_id = $_POST['animateur_nom_id'];
        foreach($animateurs_id as $anims){
            createLinkAnimStage($anims, $idStage);
        }
    }
}

// display new stage page
function showNew(){
    $civilite = civilite();
    $fonction = fonction();
    $statut = statut();
    global $twig;
    $template = $twig->load('newStage.html.twig');
    echo $template->render(array('civilite' => $civilite, 'fonction'=>$fonction, 'statut'=> $statut));
}

// when creating a new stage, enabeling autocomplete for lieu de stage
function autoCompleteLieu($keyword){
    listLieux($keyword); // keyword sent with AJAX in stage.js
}

function autoCompleteAnim($animateur){
    listAnim($animateur); // keyword sent with AJAX in stage.js
}


// EDIT 

// when creating a new stage, update of all preselected data from lieu_stage in case of change by user
function updateLieuxStage($lieu_id, $lieu_stage, $etablissement_nom, $adresse, $code_postal, $commune, $tel, $latitude, $longitude, $divers, $numero_agrement){
    $lieu_id = (int)$lieu_id;
    $lieu_stage = trim(htmlentities($lieu_stage));
    $etablissement_nom = trim(htmlentities($etablissement_nom));
    $adresse = trim(htmlentities($adresse));
    $code_postal = trim(htmlentities($code_postal));
    $commune = trim(htmlentities($commune));
    $tel = trim(htmlentities($tel));
    $latitude = trim(htmlentities($latitude));
    $longitude = trim(htmlentities($longitude));
    $divers = trim(htmlentities($divers));   
    $numero_agrement = trim(htmlentities($numero_agrement)); 
    updateLieux($lieu_id, $lieu_stage, $etablissement_nom, $adresse, $code_postal, $commune, $tel, $latitude, $longitude, $divers, $numero_agrement);
}

// displays the view to edit stage
function showEdit($id){
    $toEdit = getOne($id);
    global $twig;
    $template = $twig->load('editStage.html.twig');
    echo $template->render(array('toEdit'=>$toEdit));
}

// update a stage 
function updateStage($stage_numero, $lieu_stage_id, $date_debut, $date_fin, $hpo, $id){
    $lieu_stage_id = (int)$lieu_stage_id;
    $stage_numero = trim(htmlentities($stage_numero));
    $hpo = (bool)$hpo;
    $id = (int)$id;
    editStage($stage_numero, $lieu_stage_id, $date_debut, $date_fin, $hpo, $id);
    
   
}


//DELETE
function deleteElement($id){
    $id = (int)$id;
    delete($id);
}

// REDIRECTIONS

function redirectStageList(){
    header('Location: /afer-back/stage/list');
}