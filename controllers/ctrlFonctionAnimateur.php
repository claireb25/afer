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

$template = $twig->load('indexStatutAnim.html.twig');
echo $template->render(array('images'=>$posts,'categories'=>$tags));
