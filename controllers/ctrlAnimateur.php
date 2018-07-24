<?php
require("utils/security.php");
require_once "models/animateur.php";
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
            if (isset($_POST['civilite']) && (!empty($_POST['civilite'])) && isset($_POST['nom']) && (!empty($_POST['nom'])) && isset($_POST['prenom']) && (!empty($_POST['prenom'])) && isset($_POST['fonction']) && (!empty($_POST['fonction'])) && isset($_POST['statut']) && (!empty($_POST['statut']))&& isset($_POST['gta']) && isset($_POST['raison_sociale']) && (!empty($_POST['raison_sociale'])) && isset($_POST['adresse']) && isset($_POST['code_postal']) && isset($_POST['ville']) && isset($_POST['region']) && isset($_POST['tel_portable'])&& isset($_POST['tel_fixe'])&& isset($_POST['email'])){
                addNew($_POST['civilite'], $_POST['nom'], $_POST['prenom'], $_POST['fonction'], $_POST['statut'], $_POST['gta'], $_POST['raison_sociale'], $_POST['adresse'], $_POST['code_postal'], $_POST['ville'], $_POST['region'], $_POST['tel_portable'], $_POST['tel_fixe'], $_POST['email']);
            } else {
                showNew();
            }
            break; 
        case 'edit':
            
            if (count($_POST) > 0){
                if((isset($_POST['edit_prefecture_nom']) && (!empty($_POST['edit_prefecture_nom'])) && isset($_POST['edit_nature_prefecture']) && (!empty($_POST['edit_nature_prefecture'])) && isset($_POST['edit_autorite_prefecture']) && (!empty($_POST['edit_autorite_prefecture'])) && isset($_POST['service_prefecture']) && (!empty($_POST['service_prefecture'])) && isset($_POST['adresse']) && (!empty($_POST['adresse'])) && isset($_POST['code_postal']) && (!empty($_POST['code_postal']))&& isset($_POST['commune']) && (!empty($_POST['commune'])))
                    )
                {  
                    update($_POST['edit_prefecture_nom'], $_POST['edit_nature_prefecture'], $_POST['edit_autorite_prefecture'], $_POST['service_prefecture'], $_POST['adresse'], $_POST['code_postal'], $_POST['commune'], $_GET['id']); 
                    redirectPrefectureList();
            }
            } else {
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
    $template = $twig->load('indexAnimateur.html.twig');
    echo $template->render(array('list'=>$list));
}
//NEW
function addNew($civilite, $nom, $prenom, $fonction, $statut, $gta, $raison_sociale, $adresse, $code_postal, $ville, $region, $tel_portable, $tel_fixe, $email){
    $civilite = (int)$civilite;
    $nom = htmlentities($nom);
    $prenom = htmlentities($prenom);
    $fonction = (int)$fonction;
    $statut = (int)$statut;
    $gta = (bool)$gta;
    $raison_sociale = htmlentities($raison_sociale);
    $adresse = htmlentities($adresse);
    $code_postal = htmlentities($code_postal);
    $ville = htmlentities($ville);
    $region = htmlentities($region);
    $tel_portable = htmlentities($tel_portable);
    $tel_fixe = htmlentities($tel_fixe);
    $email = htmlentities($email);
    create($civilite, $nom, $prenom, $fonction, $statut, $gta, $raison_sociale, $adresse, $code_postal, $ville, $region, $tel_portable, $tel_fixe, $email);
    redirectAnimateurList();
}
function showNew(){
    $civilite = civilite();
    $fonction = fonction();
    $statut = statut();
    global $twig;
    $template = $twig->load('newAnimateur.html.twig');
    echo $template->render(array('civilite'=>$civilite, 'fonction'=> $fonction, 'statut' => $statut));
}
// EDIT 
function showEdit($id){
    $civilite = civilite();
    $fonction = fonction();
    $statut = statut();
    $toEdit = getOne($id);
    global $twig;
    $template = $twig->load('editAnimateur.html.twig');
    echo $template->render(array('toEdit'=>$toEdit, 'civilite'=>$civilite, 'fonction'=> $fonction, 'statut' => $statut));
}
function update($prefecture_nom, $nature_prefecture, $autorite_prefecture, $service_prefecture, $adresse, $code_postal, $commune, $id){
    $nom = htmlentities($prefecture_nom);
    $nature = (int)$nature_prefecture;
    $autorite = (int)$autorite_prefecture;
    $service = (int)$service_prefecture;
    $adr = htmlentities($adresse);
    $cp = htmlentities($code_postal);
    $ville = htmlentities($commune);
    $id = (int)$id;
    edit($nom, $nature, $autorite, $service, $adr, $cp, $ville, $id);
   
}


//DELETE
function deleteElement($id){
    $id = (int)$id;
    delete($id);
    redirectAnimateurList();
}

// REDIRECTIONS

function redirectAnimateurList(){
    header('Location: /afer-back/animateur/list');
}