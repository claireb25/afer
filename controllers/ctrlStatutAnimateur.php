<?php 

require("models/statutAnimateur.php");


require 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader, array(
    'cache'=> false
));




$action= $_GET['action'];
    if (isset($action)){

    switch ($action) {
       
        case 'list':
            $list = listAll('statut_animateur');
            break;
        case 'new':
            if (isset($_POST['new_statut'])){
                $valeur = htmlentities($_POST['new_statut']);
                $new = create('statut_animateur', $valeur);
            }
           
           
            $template = $twig->load('newStatutAnim.html.twig');
            echo $template->render(array());
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

function main(){

};



$template = $twig->load('indexStatutAnim.html.twig');
echo $template->render(array());
