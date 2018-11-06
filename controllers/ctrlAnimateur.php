<?php
require("utils/security.php");
require_once "models/animateur.php";
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
            $civilite = '';
            $nom = '';
            $prenom = '';
            $adresse = '';
            $code_postal = '';
            $commune = '';
            $region = '';
            $gta = '';
            $raison_sociale = '';
            $fonction_animateur = '';
            $statut_animateur = '';
            $urssaf = '';
            $siret = '';
            $tel_portable = '';
            $tel_fixe = '';
            $email = '';
            $observation = '';


            if( isset( $_POST['tribunal_nom'] ) ){
                if( !empty( $_POST['tribunal_nom'] ) ){
                    $tribunal_nom = htmlentities( trim( $_POST['tribunal_nom'] ) );
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

            if( isset( $_POST['autorite_tribunal'] ) ){
                if( !empty( $_POST['autorite_tribunal'] ) ){
                    $autorite_tribunal = htmlentities( trim( $_POST['autorite_tribunal'] ) );
                    $autorite_tribunal = (int) $autorite_tribunal;
                }
            }

            if( isset( $_POST['service_tribunal'] ) ){
                if( !empty( $_POST['service_tribunal'] ) ){
                    $service_tribunal = htmlentities( trim( $_POST['service_tribunal'] ) );
                    $service_tribunal = (int) $service_tribunal;
                }
            }


            

            if( $autorite_tribunal == "" ){
                $autorite_tribunal = null;
            }

            if( $service_tribunal == "" ){
                $service_tribunal = null;
            }


            
            
            
            
            $reponse = (int) getCountTribunal( $tribunal_nom,  $adresse, $code_postal, $commune, $autorite_tribunal, $service_tribunal);
            
            
            if( $reponse === 0 ){                   
                addNew( $tribunal_nom, $autorite_tribunal, $service_tribunal, $adresse, $code_postal, $commune    );
            }else{
                showExist( $tribunal_nom,  $adresse, $code_postal, $commune, $autorite_tribunal, $service_tribunal );
            }
            
        } else {
            showNew();
        }
            break; 
        case 'edit':
            if (count($_POST) > 0){   
                if (isset($_POST['gta'])){
                    $_POST['gta'] = 1;
                    update($_POST['civilite'], $_POST['nom'], $_POST['prenom'], $_POST['fonction'], $_POST['statut'], $_POST['gta'], $_POST['raison_sociale'], $_POST['adresse'], $_POST['code_postal'], $_POST['ville'], $_POST['region'], $_POST['tel_portable'], $_POST['tel_fixe'], $_POST['email'], $_POST['urssaf'], $_POST['siret'], $_POST['observations'], $_GET['id']);

                } else {
                    $_POST['gta'] = 0;
                    update($_POST['civilite'], $_POST['nom'], $_POST['prenom'], $_POST['fonction'], $_POST['statut'], $_POST['gta'], $_POST['raison_sociale'], $_POST['adresse'], $_POST['code_postal'], $_POST['ville'], $_POST['region'], $_POST['tel_portable'], $_POST['tel_fixe'], $_POST['email'], $_POST['urssaf'], $_POST['siret'],$_POST['observations'], $_GET['id']);
                }
                // redirectAnimateurList(); 
            } else {
                showEdit($_GET['id']);
              
            }
            
            break;
        
        case 'view':
            $view;
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
    $template = $twig->load('indexAnimateur.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ),'list'=>$list));
}
//NEW
function addNew($civilite, $nom, $prenom, $fonction, $statut, $gta, $raison_sociale, $adresse, $code_postal, $ville, $region, $tel_portable, $tel_fixe, $email, $urssaf, $siret, $observations){
    $civilite = (int)$civilite;
    $nom = htmlentities($nom);
    $prenom = htmlentities($prenom);
    $fonction = (int)$fonction;
    $statut = (int)$statut;
    $gta = (bool)$gta;
    $raison_sociale = htmlentities($raison_sociale);
    $adresse = htmlentities($adresse);
    $code_postal = htmlentities($code_postal);
    $ville = htmlentities($ville);
    $region = htmlentities($region);
    $tel_portable = htmlentities($tel_portable);
    $tel_fixe = htmlentities($tel_fixe);
    $email = htmlentities($email);
    $urssaf = htmlentities($urssaf);
    $siret = htmlentities($siret);
    $observations = htmlentities($observations);
    create($civilite, $nom, $prenom, $fonction, $statut, $gta, $raison_sociale, $adresse, $code_postal, $ville, $region, $tel_portable, $tel_fixe, $email, $urssaf, $siret, $observations);
    redirectAnimateurList();
}
function showNew(){
    $civilite = civilite();
    $fonction = fonction();
    $statut = statut();
    global $twig;
    $template = $twig->load('newAnimateur.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ),'civilite'=>$civilite, 'fonction'=> $fonction, 'statut' => $statut));
}
// EDIT 
function showEdit($id){
    $civilite = civilite();
    $fonction = fonction();
    $statut = statut();
    $toEdit = getOne($id);
    global $twig;
    $template = $twig->load('editAnimateur.html.twig');
    echo $template->render(array('toEdit'=>$toEdit, 'civilite'=>$civilite, 'fonction'=> $fonction, 'statut' => $statut));
    // var_dump($toEdit);
    // var_dump($civilite);
}
function update($civilite, $nom, $prenom, $fonction, $statut, $gta, $raison_sociale, $adresse, $code_postal, $ville, $region, $tel_portable, $tel_fixe, $email, $urssaf, $siret, $observations, $id){
    $civilite = (int)$civilite;
    $nom = htmlentities($nom);
    $prenom = htmlentities($prenom);
    $fonction = (int)$fonction;
    $statut = (int)$statut;
    $gta = (bool)$gta;
    $raison_sociale = htmlentities($raison_sociale);
    $adresse = htmlentities($adresse);
    $code_postal = htmlentities($code_postal);
    $ville = htmlentities($ville);
    $region = htmlentities($region);
    $tel_portable = htmlentities($tel_portable);
    $tel_fixe = htmlentities($tel_fixe);
    $email = htmlentities($email);
    $urssaf = htmlentities($urssaf);
    $siret = htmlentities($siret);
    $observations = htmlentities($observations);
    $id = (int)$id;
    
    edit($civilite, $nom, $prenom, $fonction, $statut, $gta, $raison_sociale, $adresse, $code_postal, $ville, $region, $tel_portable, $tel_fixe, $email, $urssaf, $siret, $observations, $id);
   
}


//DELETE
function deleteElement($id){
    $id = (int)$id;
    delete($id);
    redirectAnimateurList();
}

// REDIRECTIONS

function redirectAnimateurList(){
    header('Location: /afer-back/animateur/list');
}