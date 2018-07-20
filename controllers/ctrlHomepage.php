<?php 
<<<<<<< HEAD

require("models/models.php");


require 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader, array(
    'cache'=> false
));

$template = $twig->load('template.html.twig');
echo $template->render(array(""));
=======
>>>>>>> 4c2cab10f4019ca98476b36401fe971df2aaadd2
