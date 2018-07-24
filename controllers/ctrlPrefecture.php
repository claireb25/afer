<?php
require("utils/security.php");
require_once "models/prefecture.php";
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
            if (isset($_POST['prefecture_nom']) && (!empty($_POST['prefecture_nom'])) && isset($_POST['nature_prefecture']) && (!empty($_POST['nature_prefecture'])) && isset($_POST['autorite_prefecture']) && (!empty($_POST['autorite_prefecture'])) && isset($_POST['service_prefecture']) && (!empty($_POST['service_prefecture'])) && isset($_POST['adresse']) && (!empty($_POST['adresse']))&& isset($_POST['code_postal']) && (!empty($_POST['code_postal']))&& isset($_POST['commune']) && (!empty($_POST['commune']))){
                addNew($_POST['prefecture_nom'], $_POST['nature_prefecture'], $_POST['autorite_prefecture'], $_POST['service_prefecture'], $_POST['adresse'], $_POST['code_postal'], $_POST['commune']);
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
    $template = $twig->load('indexPrefecture.html.twig');
    echo $template->render(array('list'=>$list));
}
// NEW
function addNew($prefecture_nom, $nature_prefecture, $autorite_prefecture, $service_prefecture, $adresse, $code_postal, $commune){
    $nom = htmlentities($prefecture_nom);
    $nature = (int)$nature_prefecture;
    $autorite = (int)$autorite_prefecture;
    $service = (int)$service_prefecture;
    $adr = htmlentities($adresse);
    $cp = htmlentities($code_postal);
    $ville = htmlentities($commune);
    create($nom, $nature, $autorite, $service, $adr, $cp, $ville);
    redirectPrefectureList();
}
function showNew(){
    $autorite = autorite();
    $service = service();
    $nature = nature();
    global $twig;
    $template = $twig->load('newPrefecture.html.twig');
    echo $template->render(array('autorite'=>$autorite, 'service'=>$service, 'nature'=>$nature));
}
//EDIT 
function showEdit($id){
    $autorite = autorite();
    $service = service();
    $nature = nature();
    $toEdit = getOne($id);
    global $twig;
    $template = $twig->load('editPrefecture.html.twig');
    echo $template->render(array('toEdit'=>$toEdit, 'autorite'=>$autorite, 'service'=>$service, 'nature'=>$nature));
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
    redirectPrefectureList();
}

// REDIRECTIONS

function redirectPrefectureList(){
    header('Location: /afer-back/prefecture/list');
}