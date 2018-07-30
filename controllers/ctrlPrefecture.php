<?php
require("utils/security.php");
require_once "models/prefecture.php";
if (isset($_GET['action'])){ 
    $action= $_GET['action'];

    require 'vendor/autoload.php';
    $loader = new Twig_Loader_Filesystem('views');
    $twig = new Twig_Environment($loader, array(
        'cache'=> false
    ));
    switch ($action) {
        case 'list':
            makeList();            
            break;

        case 'new':            
            if ( count( $_POST )  > 0 ){
                $prefecture_nom = '';
                $adresse = '';
                $code_postal = '';
                $commune = '';
                $service_prefecture = '';
                $autorite_prefecture = '';
                if( isset( $_POST['prefecture_nom'] ) ){
                    if( !empty( $_POST['prefecture_nom'] ) ){
                        $prefecture_nom = htmlentities( trim( $_POST['prefecture_nom'] ) );
                    }
                }

                if( isset( $_POST['adresse'] ) ){
                    if( !empty( $_POST['adresse'] ) ){
                        $adresse = htmlentities( trim( $_POST['adresse'] ) );
                    }
                }


                if( isset( $_POST['code_postal'] ) ){
                    if( !empty( $_POST['code_postal'] ) ){
                        $code_postal = htmlentities( trim( $_POST['code_postal'] ) );
                    }
                }

                if( isset( $_POST['commune'] ) ){
                    if( !empty( $_POST['commune'] ) ){
                        $commune = htmlentities( trim( $_POST['commune'] ) );
                    }
                }

                if( isset( $_POST['autorite_prefecture'] ) ){
                    if( !empty( $_POST['autorite_prefecture'] ) ){
                        $autorite_prefecture = htmlentities( trim( $_POST['autorite_prefecture'] ) );
                        $autorite_prefecture = (int) $autorite_prefecture;
                    }
                }

                if( isset( $_POST['service_prefecture'] ) ){
                    if( !empty( $_POST['service_prefecture'] ) ){
                        $service_prefecture = htmlentities( trim( $_POST['service_prefecture'] ) );
                        $service_prefecture = (int) $service_prefecture;
                    }
                }

                if( $autorite_prefecture == "" ){
                    $autorite_prefecture = null;
                }

                if( $service_prefecture == "" ){
                    $service_prefecture = null;
                }
                               
                $reponse = (int) getCountPrefecture( $prefecture_nom,  $adresse, $code_postal, $commune, $autorite_prefecture, $service_prefecture );
                
                if( $reponse === 0 ){   
                    addNew( $prefecture_nom,  $adresse, $code_postal, $commune, $autorite_prefecture, $service_prefecture );
                }else{
                    showExist( $prefecture_nom, $autorite_prefecture, $service_prefecture, $adresse, $code_postal, $commune );
                }
                
            } else {
                showNew();
            }
            break; 

        case 'edit':
            if (count($_POST) > 0){
                update($_POST['edit_prefecture_nom'], $_POST['edit_autorite_prefecture'], $_POST['service_prefecture'], $_POST['adresse'], $_POST['code_postal'], $_POST['commune'], $_GET['id']); 
                redirectPrefectureList();
            } 
            else {
                showEdit($_GET['id']);
            }
            break;
        
        case 'view':
            if( isset( $_GET['id'] ) ){
                showView( $_GET['id'] );
            }
            break;

        case 'delete':
            deleteElement($_GET['id']);
            break;
    }
}
// LIST
function makeList(){
    $list = listAll();
    global $twig;
    $template = $twig->load('indexPrefecture.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ),'list'=>$list));
}
// NEW
function addNew($prefecture_nom,  $adresse, $code_postal, $commune, $autorite_prefecture, $service_prefecture){
    create($prefecture_nom,  $adresse, $code_postal, $commune, $autorite_prefecture, $service_prefecture);
    redirectPrefectureList();
}

function showView( $id ){  
    $id = (int) $id;  
    $toEdit = getOne($id);
    global $twig;
    $template = $twig->load('viewPrefecture.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ),'toEdit'=>$toEdit ) );
}



function showNew(){
    $autorite = autorite();
    $service = service();
    global $twig;
    $template = $twig->load('newPrefecture.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"]),'autorite'=>$autorite, 'service'=>$service));
}


function showExist( $prefecture_nom, $autorite_prefecture, $service_prefecture, $adresse, $code_postal, $commune ){
    global $twig;
    $autorite = autorite();
    $service = service();
    $template = $twig->load('newPrefecture.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ), 'error' => 'exist', 'prefecture_nom' => $prefecture_nom, 'adresse' => $adresse, "code_postal" => $code_postal, "commune" => $commune, "autorite" => $autorite, "service_prefecture" => $service_prefecture, "autorite_prefecture" => $autorite_prefecture,  "service" => $service ) );
}


//EDIT 
function showEdit($id){
    $autorite = autorite();
    $service = service();
    $toEdit = getOne($id);
    global $twig;
    $template = $twig->load('editPrefecture.html.twig');
    echo $template->render(array('toEdit'=>$toEdit, 'autorite'=>$autorite, 'service'=>$service));
}
function update($prefecture_nom, $autorite_prefecture, $service_prefecture, $adresse, $code_postal, $commune, $id){
    $nom = htmlentities($prefecture_nom);
    $autorite = (int)$autorite_prefecture;
    $service = (int)$service_prefecture;
    $adr = htmlentities($adresse);
    $cp = htmlentities($code_postal);
    $ville = htmlentities($commune);
    $id = (int)$id;
    edit($nom, $autorite, $service, $adr, $cp, $ville, $id);
   
}

function showDeleteError( $id ){
    global $twig;
    $template = $twig->load('deletePrefecture.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] )));
}


//DELETE
function deleteElement($id){
    $id = (int)$id;
    $countPermis = nombreRelationPrefecturePermis( $id );
    $countStage = nombreRelationPrefectureStage( $id );
    if( $countPermis == 0 && countStage == 0 ){
        delete($id);
        header('Location: /afer-back/prefecture/list');
    }else{
        showDeleteError( $id );
    }    
}

// REDIRECTIONS

function redirectPrefectureList(){
    header('Location: /afer-back/prefecture/list');
}