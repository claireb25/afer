<?php
require './vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;


//Pour recueillir le contenu d'un autre fichier

ob_start();
require_once 'pdfview_facture.html';
$content = ob_get_clean();
try{
	$pdf = new HTML2PDF('P', 'A4', 'fr');
	$pdf->pdf->SetDisplayMode(10);
	$pdf->WriteHTML($content);
	$pdf->Output('facture.pdf');
}catch(HTML2PDF_exception $e){
	die($e);
}
$formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();






// ob_start();
// require_once 'pdfview_facture.html';
// $content = ob_get_clean();


// $mpdf = new Html2Pdf('P','A4','fr','true','UTF-8'); // paramètrer pour l'impression du PDF
// $mpdf->pdf->SetDisplayMode(10); //paramètrer l'affichage
// $mpdf->writeHTML($content); // argument appelle le contenu du require_once
// $mpdf->output('facture-stagiaire.pdf');



