<?php
require './vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new Html2Pdf();
$html2pdf->writeHTML('<h1> Feuille d\'émargemement Stage jour n°1 </h1>');
$html2pdf->output();



