<?php 

require("models/fonctionAnimateur.php");

require 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader, array(
    'cache'=> false
));

if (isset($_GET['action'])){

    $action= $_GET['action'];
    
    switch ($action) {

        case 'list':
            showList();
            break;

        case 'new':
            if (isset($_POST['fonction_nom']) && (!empty($_POST['fonction_nom']))){
                addNew($_POST['fonction_nom']);
            }
            else {
                showNew();
            }
            break;

        case 'edit':
            if (isset($_GET['id'])){
                showOne($_GET['id']);

            }
            if (isset($_POST['fonction_nom']) && (!empty($_POST['fonction_nom']))){
                edit($_POST['fonction_nom'], intval($_GET['id']));
                header("Location: /afer-back/fonctionanimateur/list");
            }
            break;

        case 'view':
            $view;
            break;
            
        case 'delete':
            if (isset($_GET['id'])){
                delete(intval($_GET['id']));
                header("Location: /afer-back/fonctionanimateur/list");
            }
            break;
    }
}

function showOne($id){
    global $twig;
    $list = listOne('fonction_animateur', $id);
    $template = $twig->load('editFonctionAnim.html.twig');
    echo $template->render(array('list' => $list));
}

function showList(){
    global $twig;
    $list = listAll('fonction_animateur');
    $template = $twig->load('indexFonctionAnim.html.twig');
    echo $template->render(array('list' => $list));
}

function addNew($valeur){
    global $twig;
    htmlentities($valeur);
    create('fonction_animateur(fonction_nom)', $valeur);
    header("Location: /afer-back/fonctionanimateur/list");
}

function showNew(){
    global $twig;
    $template = $twig->load('newFonctionAnim.html.twig');
    echo $template->render(array());
}