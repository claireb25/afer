<?php 
require_once "models/statutAnimateur.php";

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
            if (isset($_POST['new_statut']) && (!empty($_POST['new_statut']))){
                addNew($_POST['new_statut']);
            } else {
                showNew();
            }
            break; 
        case 'edit':
            $edit ;
            break;
        case 'view':
            $view;
            break;
        case 'delete':
            $delete;
            break;
    }
}

function makeList(){
    $list = listAll();
    global $twig;
    $template = $twig->load('indexStatutAnim.html.twig');
    echo $template->render(array('list'=>$list));
}

    



function addNew($valeur){
        $status_nom = htmlentities($valeur);
        create('statut_animateur(status_nom)', $status_nom);
        header('Location: /afer-back/statutanimateur/list');
}

function showNew(){
    global $twig;
    $template = $twig->load('newStatutAnim.html.twig');
    echo $template->render(array());
}