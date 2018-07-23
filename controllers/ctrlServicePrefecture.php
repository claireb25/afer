<?php

require("utils/security.php");
require_once "models/servicePrefecture.php";

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
            if (isset($_POST['service_nom']) && (!empty($_POST['service_nom']))){
                addNew($_POST['service_nom']);
            } else {
                showNew();
            }
            break; 
        case 'edit':
            if (isset($_GET['id'])){
                showEdit($_GET['id']);
               
            }
            if (isset($_POST['edit_service']) && (!empty($_POST['edit_service']))){
                updateService($_POST['edit_service'], $_GET['id']);
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
    $template = $twig->load('indexServicePrefecture.html.twig');
    echo $template->render(array('list'=>$list));
}

// NEW
function addNew($valeur){
    $service_nom = htmlentities($valeur);
    create($service_nom);
    header('Location: /afer-back/serviceprefecture/list');
}

function showNew(){
    global $twig;
    $template = $twig->load('newServicePrefecture.html.twig');
    echo $template->render(array());
}

//EDIT 
function showEdit($id){
    $servicetoEdit = getOne($id);
    global $twig;
    $template = $twig->load('editServicePrefecture.html.twig');
    echo $template->render(array('servicetoEdit'=>$servicetoEdit));
}

function updateService($data, $id){
    $service_nom = htmlentities($data);
    $id = (int)$id;
    edit($service_nom, $id);
    header('Location: /afer-back/serviceprefecture/list');
   
}
//DELETE
function deleteElement($id){
    $id = (int)$id;
    delete($id);
    header('Location: /afer-back/serviceprefecture/list');
}

