<?php 

require("models/models.php");


require 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader, array(
    'cache'=> false
));

$template = $twig->load('template.html.twig');
echo $template->render(array(""));