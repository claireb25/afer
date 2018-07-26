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
                   
                    addNew($_POST['lieu_stage_id'], $_POST['stage_numero'], $_POST['date_debut'], $_POST['date_fin'], $_POST['hpo']);
                } else {
                    $_POST['hpo'] = 0;
                    addNew($_POST['lieu_stage_id'], $_POST['stage_numero'], $_POST['date_debut'], $_POST['date_fin'], $_POST['hpo']); 
                }
            } else {
                showNew();
              
            }

            break; 
        case 'edit':
            if (count($_POST) > 0){   
                if (isset($_POST['hpo'])){
                    $_POST['hpo'] = 1;
                    update($_POST['lieu_stage'], $_POST['stage_numero'], $_POST['date_debut'], $_POST['date_fin'], $_POST['hpo'], $_GET['id']);

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
function addNew($lieu_stage, $stage_numero, $date_debut, $date_fin, $stage_hpo){
    $lieu_stage = (int)$lieu_stage;
    $stage_numero = trim(htmlentities($stage_numero));
    $date_debut = trim(htmlentities($date_debut));
    $date_fin = trim(htmlentities($date_fin));
    $stage_hpo = (bool)$stage_hpo;
   
    create($lieu_stage, $stage_numero, $date_debut, $date_fin, $stage_hpo);
    redirectStageList();
}
function showNew(){
   
    // $lieu_stage = lieu_stage();
    global $twig;
    $template = $twig->load('newStage.html.twig');
    echo $template->render(array());
}

function autoComplete($keyword){

listLieux($keyword);


}

// EDIT 
// function showEdit($id){
//     $civilite = civilite();
//     $fonction = fonction();
//     $statut = statut();
//     $toEdit = getOne($id);
//     global $twig;
//     $template = $twig->load('editAnimateur.html.twig');
//     echo $template->render(array('toEdit'=>$toEdit, 'civilite'=>$civilite, 'fonction'=> $fonction, 'statut' => $statut));
//     // var_dump($toEdit);
//     // var_dump($civilite);
// }
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
    redirectStageList();
}

// REDIRECTIONS

function redirectStageList(){
    header('Location: /afer-back/stage/list');
}