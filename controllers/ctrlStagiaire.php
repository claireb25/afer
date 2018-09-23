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
                addNew($_POST['civilite'], $_POST['nom'], $_POST['nom_naissance'], $_POST['prenom'], $_POST['date_naissance'], $_POST['lieu_naissance'], $_POST['adresse'], $_POST['code_postal'], $_POST['commune'], $_POST['pays'], $_POST['tel_portable'], $_POST['tel_fixe'], $_POST['email'], $_POST['carte_avantages_jeunes'], $_POST['partenaires'], $_POST['adherents']);
                //redirectList();
            } 
            else {
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
            $view;
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
    echo $template->render(array('list'=>$list));
}

// QUERY
function autoCompleteStagiaire($keyword){
    listStagiaire($keyword);
}


// NEW
function addNew($civilite, $nom, $nomNaissance, $prenom, $dateNaissance, $lieuNaissance, $adresse, $codePostal, $commune, $pays, $telPortable, $telFixe, $email, $carteAvantagesJeunes, $partenaires, $adherents){
    $nom = htmlentities($nom);
    $nomNaissance = htmlentities($nomNaissance);
    $prenom = htmlentities($prenom);
    $lieuNaissance = htmlentities($lieuNaissance);
    $adresse = htmlentities($adresse);
    $commune = htmlentities($commune);
    $pays = htmlentities($pays);
    create($civilite, $nom, $nomNaissance, $prenom, $dateNaissance, $lieuNaissance, $adresse, $codePostal, $commune, $pays, $telPortable, $telFixe, $email, $carteAvantagesJeunes, $partenaires, $adherents);
}

function showNew(){
    global $twig;
    $civilite = civilite();
    $template = $twig->load('newStagiaire.html.twig');
    echo $template->render(array('civilite'=>$civilite));
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
    $nom = htmlentities($nom);
    $nomNaissance = htmlentities($nomNaissance);
    $prenom = htmlentities($prenom);
    $lieuNaissance = htmlentities($lieuNaissance);
    $adresse = htmlentities($adresse);
    $commune = htmlentities($commune);
    $pays = htmlentities($pays);
    editStagiaire($civilite, $nom, $nomNaissance, $prenom, $dateNaissance, $lieuNaissance, $adresse, $codePostal, $commune, $pays, $telPortable, $telFixe, $email, $carteAvantagesJeunes, $partenaires, $adherents, $id);
}

//DELETE
function deleteElement($id){
    $id = (int)$id;
    deleteStagiaire($id);
}

// REDIRECTIONS
function redirectList(){
    header('Location: /afer-back/stagiaire/list');
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