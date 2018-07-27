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
                    addNew($_POST['lieu_stage_id'], $_POST['stage_numero'], $_POST['date_debut'], $_POST['date_fin'], $_POST['hpo']);
                    updateLieuxStage($_POST['lieu_stage_id'], $_POST['lieu_stage_nom'], $_POST['etablissement_nom'], $_POST['adresse'], $_POST['code_postal'], $_POST['commune'], $_POST['tel'], $_POST['latitude'], $_POST['longitude'], $_POST['divers']);
                    redirectStageList();
                } else {
                    $lieuId = addLieuxStage($_POST['lieu_stage_nom'], $_POST['etablissement_nom'], $_POST['adresse'], $_POST['code_postal'], $_POST['commune'], $_POST['tel'], $_POST['latitude'], $_POST['longitude'], $_POST['divers']);
                    addNewStage($_POST['stage_numero'], $lieuId, $_POST['date_debut'], $_POST['date_fin'], $_POST['hpo']);
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
                    update($id, $_POST['stage_numero'], $_POST['date_debut'], $_POST['date_fin'], $_POST['hpo'], $_GET['id']);

                } else {
                    $_POST['hpo'] = 0;
                    update($_POST['lieu_stage'], $_POST['stage_numero'], $_POST['date_debut'], $_POST['date_fin'], $_POST['hpo'], $_GET['id']);
                }
                // redirectStageList(); 
            } else {
                showEdit($_GET['id']);
            }
            break;
        case 'view':
            $view;
            break;
        case 'query':
            $keyword = $_POST['keyword'];
            autoComplete($keyword);
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
    create($lieu_stage, $stage_numero, $date_debut, $date_fin, $stage_hpo);
    // redirectStageList();
}


// when adding a new stage and lieu doesn't exist
function addLieuxStage($lieu_stage_nom, $etablissement_nom, $adresse, $code_postal, $commune, $tel, $latitude, $longitude, $divers){
    $lieu_stage_nom = trim(htmlentities($lieu_stage_nom));
    $etablissement_nom = trim(htmlentities($etablissement_nom));
    $adresse = trim(htmlentities($adresse));
    $code_postale = trim(htmlentities($code_postal));
    $commune = trim(htmlentities($commune));
    $tel = trim(htmlentities($tel));
    $latitude = trim(htmlentities($latitude));
    $longitude = trim(htmlentities($longitude));
    $divers = trim(htmlentities($divers));
    $lieuId = createLieu($lieu_stage_nom, $etablissement_nom, $adresse, $code_postal, $commune, $tel, $latitude, $longitude, $divers);
    return $lieuId;
}

// adding a new stage after creating a lieu and getting the lastInsertId
function addNewStage($stage_numero, $lieuId, $date_debut, $date_fin, $stage_hpo){
    $lieuId = (int)$lieuId;
    $stage_numero = trim(htmlentities($stage_numero));
    $date_debut = trim(htmlentities($date_debut));
    $date_fin = trim(htmlentities($date_fin));
    $stage_hpo = (bool)$stage_hpo;
    createNewStage($stage_numero, $lieuId, $date_debut, $date_fin, $stage_hpo);
}

// display new stage page
function showNew(){
    global $twig;
    $template = $twig->load('newStage.html.twig');
    echo $template->render(array());
}

// when creating a new stage, enabeling autocomplete for lieu de stage
function autoComplete($keyword){
    listLieux($keyword); // keyword sent with AJAX in stage.js
}

// EDIT 

// when creating a new stage, update of all preselected data from lieu_stage in case of change by user
function updateLieuxStage($lieu_id, $lieu_stage, $etablissement_nom, $adresse, $code_postal, $commune, $tel, $latitude, $longitude, $divers){
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
    updateLieux($lieu_id, $lieu_stage, $etablissement_nom, $adresse, $code_postal, $commune, $tel, $latitude, $longitude, $divers);
}


function showEdit($id){
    $toEdit = getOne($id);
    global $twig;
    $template = $twig->load('editStage.html.twig');
    echo $template->render(array('toEdit'=>$toEdit));
    // var_dump($toEdit);
  
}
// function update($civilite, $nom, $prenom, $fonction, $statut, $gta, $raison_sociale, $adresse, $code_postal, $ville, $region, $tel_portable, $tel_fixe, $email, $urssaf, $siret, $observations, $id){
//     $civilite = (int)$civilite;
//     $nom = htmlentities($nom);
//     $prenom = htmlentities($prenom);
//     $fonction = (int)$fonction;
//     $statut = (int)$statut;
//     $gta = (bool)$gta;
//     $raison_sociale = htmlentities($raison_sociale);
//     $adresse = htmlentities($adresse);
//     $code_postal = htmlentities($code_postal);
//     $ville = htmlentities($ville);
//     $region = htmlentities($region);
//     $tel_portable = htmlentities($tel_portable);
//     $tel_fixe = htmlentities($tel_fixe);
//     $email = htmlentities($email);
//     $urssaf = htmlentities($urssaf);
//     $siret = htmlentities($siret);
//     $observations = htmlentities($observations);
//     $id = (int)$id;
    
//     edit($civilite, $nom, $prenom, $fonction, $statut, $gta, $raison_sociale, $adresse, $code_postal, $ville, $region, $tel_portable, $tel_fixe, $email, $urssaf, $siret, $observations, $id);
   
// }


//DELETE
function deleteElement($id){
    $id = (int)$id;
    delete($id);
}

// REDIRECTIONS

function redirectStageList(){
    header('Location: /afer-back/stage/list');
}