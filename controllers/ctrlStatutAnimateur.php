<?php 

require("models/statutAnimateur.php");

$action= $_GET['action'];
    if (isset($action)){

    switch ($action) {
        case 'list':
            $list = listAll('statut_animateur');
            break;
        case 'new':
            $new ;
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

require 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader, array(
    'cache'=> false
));

$template = $twig->load('views/statutAnimateur/index.html.twig');
echo $template->render(array('images'=>$posts,'categories'=>$tags));
