<?php

require("utils/security.php");
require_once "models/tribunal.php";

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
            if (isset($_POST['tribunal_nom']) && (!empty($_POST['tribunal_nom'])) && isset($_POST['nature_tribunal']) && (!empty($_POST['nature_tribunal'])) && isset($_POST['autorite_tribunal']) && (!empty($_POST['autorite_tribunal'])) && isset($_POST['service_tribunal']) && (!empty($_POST['service_tribunal'])) && isset($_POST['adresse']) && (!empty($_POST['adresse']))&& isset($_POST['code_postal']) && (!empty($_POST['code_postal']))&& isset($_POST['commune']) && (!empty($_POST['commune']))){
                addNew($_POST['tribunal_nom'], $_POST['nature_tribunal'], $_POST['autorite_tribunal'], $_POST['service_tribunal'], $_POST['adresse'], $_POST['code_postal'], $_POST['commune']);
            } else {
                showNew();
            }
            break; 
        case 'edit':
            if (isset($_GET['id'])){
                showEdit($_GET['id']);
            }
            if (isset($_POST['edit_tribunal_nom']) 
            && (!empty($_POST['edit_tribunal_nom'])) 
            && isset($_POST['edit_nature_tribunal']) 
            && (!empty($_POST['edit_nature_tribunal'])) 
            && isset($_POST['edit_autorite_tribunal']) 
            && (!empty($_POST['edit_autorite_tribunal'])) 
            && isset($_POST['service_tribunal']) 
            && (!empty($_POST['service_tribunal'])) 
            && isset($_POST['adresse']) 
            && (!empty($_POST['adresse'])) 
            && isset($_POST['code_postal']) 
            && (!empty($_POST['code_postal']))
            && isset($_POST['commune']) && (!empty($_POST['commune']))
            ){  
               
                update($_POST['edit_tribunal_nom'], $_POST['edit_nature_tribunal'], $_POST['edit_autorite_tribunal'], $_POST['service_tribunal'], $_POST['adresse'], $_POST['code_postal'], $_POST['commune'], $_GET['id']); 
               
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
    $template = $twig->load('indexTribunal.html.twig');
    echo $template->render(array('list'=>$list));
}



// NEW
function addNew($tribunal_nom, $nature_tribunal, $autorite_tribunal, $service_tribunal, $adresse, $code_postal, $commune){
    $nom = htmlentities($tribunal_nom);
    $nature = (int)$nature_tribunal;
    $autorite = (int)$autorite_tribunal;
    $service = (int)$service_tribunal;
    $adr = htmlentities($adresse);
    $cp = htmlentities($code_postal);
    $ville = htmlentities($commune);
    create($nom, $nature, $autorite, $service, $adr, $cp, $ville);
    header('Location: /afer-back/tribunal/list');
}

function showNew(){
    $autorite = autorite();
    $service = service();
    $nature = nature();
    global $twig;
    $template = $twig->load('newTribunal.html.twig');
    echo $template->render(array('autorite'=>$autorite, 'service'=>$service, 'nature'=>$nature));
}
//EDIT 
function showEdit($id){
    $autorite = autorite();
    $service = service();
    $nature = nature();
    $toEdit = getOne($id);
    global $twig;
    $template = $twig->load('editTribunal.html.twig');
    echo $template->render(array('toEdit'=>$toEdit, 'autorite'=>$autorite, 'service'=>$service, 'nature'=>$nature));
}

function update($tribunal_nom, $nature_tribunal, $autorite_tribunal, $service_tribunal, $adresse, $code_postal, $commune, $id){
    $nom = htmlentities($tribunal_nom);
    $nature = (int)$nature_tribunal;
    $autorite = (int)$autorite_tribunal;
    $service = (int)$service_tribunal;
    $adr = htmlentities($adresse);
    $cp = htmlentities($code_postal);
    $ville = htmlentities($commune);
    $id = (int)$id;
    edit($nom, $nature, $autorite, $service, $adr, $cp, $ville, $id);
    // var_dump($nom);
    // var_dump($nature);
    // header('Location: /afer-back/tribunal/list');
   
}
//DELETE
function deleteElement($id){
    $id = (int)$id;
    delete($id);
    header('Location: /afer-back/tribunal/list');
}

