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
            $gta = false;
            $raison_sociale = '';
            $fonction_animateur = '';
            $statut_animateur = '';
            $urssaf = '';
            $siret = '';
            $tel_portable = '';
            $tel_fixe = '';
            $email = '';
            $observation = '';


            if( isset( $_POST['civilite'] ) ){
                if( !empty( $_POST['civilite'] ) ){
                    $civilite = htmlentities( trim( $_POST['civilite'] ) );
                    $civilite = (int) $civilite;
                }
            }

            if( isset( $_POST['nom'] ) ){
                if( !empty( $_POST['nom'] ) ){
                    $nom = htmlentities( trim( $_POST['nom'] ) );
                }
            }


            if( isset( $_POST['prenom'] ) ){
                if( !empty( $_POST['prenom'] ) ){
                    $prenom = htmlentities( trim( $_POST['prenom'] ) );
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

            if( isset( $_POST['region'] ) ){
                if( !empty( $_POST['region'] ) ){
                    $region = htmlentities( trim( $_POST['region'] ) );
                }
            }


            if( isset( $_POST['gta'] ) ){
                if( !empty( $_POST['gta'] ) ){
                    $gta = true;
                }
            }

            if( isset( $_POST['raison_sociale'] ) ){
                if( !empty( $_POST['raison_sociale'] ) ){
                    $raison_sociale = htmlentities( trim( $_POST['raison_sociale'] ) );
                }
            }

            if( isset( $_POST['fonction_animateur'] ) ){
                if( !empty( $_POST['fonction_animateur'] ) ){
                    $fonction_animateur = htmlentities( trim( $_POST['fonction_animateur'] ) );
                    $fonction_animateur = (int) $fonction_animateur;
                }
            }

            if( isset( $_POST['statut_animateur'] ) ){
                if( !empty( $_POST['statut_animateur'] ) ){
                    $statut_animateur = htmlentities( trim( $_POST['statut_animateur'] ) );
                    $statut_animateur = (int) $statut_animateur;
                }
            }
            
            if( isset( $_POST['urssaf'] ) ){
                if( !empty( $_POST['urssaf'] ) ){
                    $urssaf = htmlentities( trim( $_POST['urssaf'] ) );
                }
            }

            if( isset( $_POST['siret'] ) ){
                if( !empty( $_POST['siret'] ) ){
                    $siret = htmlentities( trim( $_POST['siret'] ) );
                }
            }

            if( isset( $_POST['tel_portable'] ) ){
                if( !empty( $_POST['tel_portable'] ) ){
                    $tel_portable = htmlentities( trim( $_POST['tel_portable'] ) );
                }
            }

            if( isset( $_POST['tel_fixe'] ) ){
                if( !empty( $_POST['tel_fixe'] ) ){
                    $tel_fixe = htmlentities( trim( $_POST['tel_fixe'] ) );
                }
            }
            
            if( isset( $_POST['email'] ) ){
                if( !empty( $_POST['email'] ) ){
                    $email = htmlentities( trim( $_POST['email'] ) );
                }
            }

            if( isset( $_POST['observation'] ) ){
                if( !empty( $_POST['observation'] ) ){
                    $observation = htmlentities( trim( $_POST['observation'] ) );
                }
            }

           
            
            

            if( $civilite == "" ){
                $civilite = null;
            }

            if( $fonction_animateur == "" ){
                $fonction_animateur = null;
            }

            if( $statut_animateur == "" ){
                $statut_animateur = null;
            }


            
            
            
            
            $reponse = (int) getCountAnimateur( $nom,  $prenom, $adresse, $code_postal, $commune );
            
            
            if( $reponse === 0 ){                   
                addNew( $civilite, $nom, $prenom, $adresse, $code_postal, $commune, $region, $gta, $raison_sociale, $fonction_animateur, $statut_animateur, $urssaf, $siret, $tel_portable, $tel_fixe, $email, $observation );
            }else{
                showExist( $civilite, $nom, $prenom, $adresse, $code_postal, $commune, $region, $gta, $raison_sociale, $fonction_animateur, $statut_animateur, $urssaf, $siret, $tel_portable, $tel_fixe, $email, $observation );
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
function addNew($civilite, $nom, $prenom, $adresse, $code_postal, $commune, $region, $gta, $raison_sociale, $fonction_animateur, $statut_animateur, $urssaf, $siret, $tel_portable, $tel_fixe, $email, $observation){
    create($civilite, $nom, $prenom, $adresse, $code_postal, $commune, $region, $gta, $raison_sociale, $fonction_animateur, $statut_animateur, $urssaf, $siret, $tel_portable, $tel_fixe, $email, $observation);
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
    header('Location: /animateur/list');
}