<?php
require("utils/security.php");
require_once "models/stagiaire.php";

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

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
                            $civilite = trim( $_POST['civilite']  );
                            $civilite = (int) $civilite;
                        }
                    }
        
                    if( isset( $_POST['nom'] ) ){
                        if( !empty( $_POST['nom'] ) ){
                            $nom = trim( $_POST['nom']  );
                        }
                    }
        
        
                    if( isset( $_POST['prenom'] ) ){
                        if( !empty( $_POST['prenom'] ) ){
                            $prenom = trim( $_POST['prenom']  );
                        }
                    }
        
                    if( isset( $_POST['adresse'] ) ){
                        if( !empty( $_POST['adresse'] ) ){
                            $adresse = trim( $_POST['adresse']  );
                        }
                    }
        
                    if( isset( $_POST['code_postal'] ) ){
                        if( !empty( $_POST['code_postal'] ) ){
                            $code_postal = trim( $_POST['code_postal']  );
                        }
                    }
        
                    if( isset( $_POST['commune'] ) ){
                        if( !empty( $_POST['commune'] ) ){
                            $commune = trim( $_POST['commune']  );
                        }
                    }
        
                    if( isset( $_POST['region'] ) ){
                        if( !empty( $_POST['region'] ) ){
                            $region = trim( $_POST['region']  );
                        }
                    }
        
        
                    if( isset( $_POST['gta'] ) ){
                        if( !empty( $_POST['gta'] ) ){
                            $gta = true;
                        }
                    }
        
                    if( isset( $_POST['raison_sociale'] ) ){
                        if( !empty( $_POST['raison_sociale'] ) ){
                            $raison_sociale = trim( $_POST['raison_sociale']  );
                        }
                    }
        
                    if( isset( $_POST['fonction_animateur'] ) ){
                        if( !empty( $_POST['fonction_animateur'] ) ){
                            $fonction_animateur = trim( $_POST['fonction_animateur']  );
                            $fonction_animateur = (int) $fonction_animateur;
                        }
                    }
        
                    if( isset( $_POST['statut_animateur'] ) ){
                        if( !empty( $_POST['statut_animateur'] ) ){
                            $statut_animateur = trim( $_POST['statut_animateur']  );
                            $statut_animateur = (int) $statut_animateur;
                        }
                    }
                    
                    if( isset( $_POST['urssaf'] ) ){
                        if( !empty( $_POST['urssaf'] ) ){
                            $urssaf = trim( $_POST['urssaf']  );
                        }
                    }
        
                    if( isset( $_POST['siret'] ) ){
                        if( !empty( $_POST['siret'] ) ){
                            $siret = trim( $_POST['siret']  );
                        }
                    }
        
                    if( isset( $_POST['tel_portable'] ) ){
                        if( !empty( $_POST['tel_portable'] ) ){
                            $tel_portable = trim( $_POST['tel_portable']  );
                        }
                    }
        
                    if( isset( $_POST['tel_fixe'] ) ){
                        if( !empty( $_POST['tel_fixe'] ) ){
                            $tel_fixe = trim( $_POST['tel_fixe']  );
                        }
                    }
                    
                    if( isset( $_POST['email'] ) ){
                        if( !empty( $_POST['email'] ) ){
                            $email = trim( $_POST['email']  );
                        }
                    }
        
                    if( isset( $_POST['observation'] ) ){
                        if( !empty( $_POST['observation'] ) ){
                            $observation = trim( $_POST['observation']  );
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
                if (!isset($_POST['carte_avantages_jeunes'])){
                    $_POST['carte_avantages_jeunes'] = 0;
                }
                if (!isset($_POST['partenaires'])){
                    $_POST['partenaires'] = 0;
                }
                if (!isset($_POST['adherents'])){
                    $_POST['adherents'] = 0;
                }  
                update($_POST['civilite'], $_POST['nom'], $_POST['nom_naissance'], $_POST['prenom'], $_POST['date_naissance'], $_POST['lieu_naissance'], $_POST['adresse'], $_POST['code_postal'], $_POST['commune'], $_POST['pays'], $_POST['tel_portable'], $_POST['tel_fixe'], $_POST['email'], $_POST['carte_avantages_jeunes'], $_POST['partenaires'], $_POST['adherents'], $_GET['id']); 
                redirectList();
            } 
            else {
                showEdit($_GET['id']);
            }
            break;

        case 'query':
            $keyword = $_POST['keyword'];
            autoCompleteStagiaire($keyword);
            break;
        
        case 'view':
            
            if( isset( $_GET['id'] ) ){
                showView( $_GET['id'] );
            }

            break;

        case 'delete':
            deleteElement($_GET['id']);
            redirectList();
            break;
        case 'facturepdf':
        generatePdfFacture($_GET['id']);
        break;

        case 'convocpdf':
        generatePdfConvoc($_GET['id']);
        break;
    }
}

// LIST
function makeList(){
    $list = listAll();
    global $twig;
    $template = $twig->load('indexStagiaire.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ),'list'=>$list));
}

// QUERY
function autoCompleteStagiaire($keyword){
    listStagiaire($keyword);
}


// NEW
function addNew($civilite, $nom, $nomNaissance, $prenom, $dateNaissance, $lieuNaissance, $adresse, $codePostal, $commune, $pays, $telPortable, $telFixe, $email, $carteAvantagesJeunes, $partenaires, $adherents){
    $nom = $nom;
    $nomNaissance = $nomNaissance;
    $prenom = $prenom;
    $lieuNaissance = $lieuNaissance;
    $adresse = $adresse;
    $commune = $commune;
    $pays = $pays;
    create($civilite, $nom, $nomNaissance, $prenom, $dateNaissance, $lieuNaissance, $adresse, $codePostal, $commune, $pays, $telPortable, $telFixe, $email, $carteAvantagesJeunes, $partenaires, $adherents);
}

function showNew(){
    global $twig;
    $civilite = civilite();
    $template = $twig->load('newStagiaire.html.twig');
    echo $template->render(array('civilite'=>$civilite));
}


function showView( $id ){  
    $id = (int) $id;  
    $toEdit = getOne($id);
    $stages = getStageByIdStagiaire($id);
    global $twig;
    $template = $twig->load('viewStagiaire.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ),'toEdit'=>$toEdit, 'stages' => $stages ) );
}

//EDIT 
function showEdit($id){
    global $twig;
    $template = $twig->load('editStagiaire.html.twig');
    $civilite = civilite();
    $stagiaire = stagiaireById($id);
    echo $template->render(array('civilite'=>$civilite, 'stagiaire'=>$stagiaire));
}

function update($civilite, $nom, $nomNaissance, $prenom, $dateNaissance, $lieuNaissance, $adresse, $codePostal, $commune, $pays, $telPortable, $telFixe, $email, $carteAvantagesJeunes, $partenaires, $adherents, $id){
    $nom = $nom;
    $nomNaissance =$nomNaissance;
    $prenom = $prenom;
    $lieuNaissance = $lieuNaissance;
    $adresse = $adresse;
    $commune = $commune;
    $pays = $pays;
    editStagiaire($civilite, $nom, $nomNaissance, $prenom, $dateNaissance, $lieuNaissance, $adresse, $codePostal, $commune, $pays, $telPortable, $telFixe, $email, $carteAvantagesJeunes, $partenaires, $adherents, $id);
}

//DELETE
function deleteElement($id){
    $id = (int)$id;
    deleteStagiaire($id);
}

// REDIRECTIONS
function redirectList(){
    header('Location: /stagiaire/list');
}

//PDF_FACTURE
function generatePdfFacture($id){
    global $twig;
    $id = (int)$id;
    $template = $twig->load('pdf_facture.html.twig');

    ob_start();
//require_once 'pdfview_facture.html.twig';
$civilite = civilite();
$stagiaire = stagiaireById($id);
echo $template->render(array('civilite'=>$civilite, 'stagiaire'=>$stagiaire));
//exit;
$content = ob_get_clean();
try{
	$pdf = new HTML2PDF('P', 'A4', 'fr');
	$pdf->pdf->SetDisplayMode(10);
	$pdf->WriteHTML($content);
	$pdf->Output('facture_stagiaire.pdf');
}catch(HTML2PDF_exception $e){
	die($e);
}
$formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
    
}

//PDF_CONVOC
function generatePdfConvoc($id){
    global $twig;
    $id = (int)$id;
    $template = $twig->load('pdf_convoc_cas1.html.twig');
    ob_start();
//require_once 'pdfview_facture.html.twig';
echo $template->render();
//exit;
$content = ob_get_clean();
try{
	$pdf = new HTML2PDF('P', 'A4', 'fr');
	$pdf->pdf->SetDisplayMode(10);
	$pdf->WriteHTML($content);
	$pdf->Output('convoc_cas1_stagiaire.pdf');
}catch(HTML2PDF_exception $e){
	die($e);
}
$formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
    
}