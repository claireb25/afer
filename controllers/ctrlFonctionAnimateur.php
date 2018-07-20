<?php 

require("models/models.php");


require 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader, array(
    'cache'=> false
));


$action= $_GET['action'];
    if (isset($action)){

    switch ($action) {

        case 'list':
            $list = listAll('fonction_animateur');
            break;

        case 'new':
            if (isset($_POST['fonction_nom'])){
                addNew($_POST['fonction_nom']);
            }
            else {
                $template = $twig->load('newFonctionAnim.html.twig');
                echo $template->render(array(""));
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

function addNew($valeur){
    $template = $twig->load('listFonctionAnim.html.twig');
    echo $template->render(array(""));
}
