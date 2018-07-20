<?php

require("models/users.php");

require 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader, array(
    'cache'=> false
));





$template = $twig->load('login.html.twig');
echo $template->render();