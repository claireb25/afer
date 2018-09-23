<?php
require 'vendor/autoload.php';



function twig(){
    $loader = new Twig_Loader_Filesystem('views');
    $twig = new Twig_Environment($loader, array(
        'cache'=> false
    ));

    return $twig;
}


function displayError404( $args = array() ){
    $tpl =  twig();
    $template = $tpl->load('404.html.twig');
    echo $template->render( $args );
}



   
displayError404();
  

