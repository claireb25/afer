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


function showList(){
    global $twig;
    $list = listAll('fonction_animateur');
    $list = htmlentities($list);
    var_dump($list);
    $template = $twig->load('indexFonctionAnim.html.twig');
    echo $template->render(array('list' => $list));
}

function addNew($valeur){
    global $twig;
    htmlentities($valeur);
    create('fonction_animateur(fonction_nom)', $valeur);
    header("Location: /afer-back/fonctionanim/list");
}

function showNew(){
    global $twig;
    $template = $twig->load('newFonctionAnim.html.twig');
    echo $template->render(array());
}