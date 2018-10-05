<?php
// require './vendor/autoload.php';

// use Spipu\Html2Pdf\Html2Pdf;
// use Spipu\Html2Pdf\Exception\Html2PdfException;
// use Spipu\Html2Pdf\Exception\ExceptionFormatter;


// //Pour recueillir le contenu d'un autre fichier
// ob_start();
// require_once 'pdfview_convoc_cas1.html';
// $content = ob_get_clean();
// try{
// 	$pdf = new HTML2PDF('P', 'A4', 'fr');
// 	$pdf->pdf->SetDisplayMode(10);
// 	$pdf->WriteHTML($content);
// 	$pdf->Output('convoc_cas1.pdf');
// }catch(HTML2PDF_exception $e){
// 	die($e);
// }
// $formatter = new ExceptionFormatter($e);
//     echo $formatter->getHtmlMessage();




