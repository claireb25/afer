<?php 

require("models/statutAnimateur.php");
$new;
$create ;
$view ;
$list ;

function main(){

};

require 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader, array(
    'cache'=> false
));

$template = $twig->load('views/statutAnimateur/index.html.twig');
echo $template->render(array('images'=>$posts,'categories'=>$tags));
