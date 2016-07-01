<?php
include_once("analyticstracking.php");
require_once("../drupal/fpdf/japanese.php");

$address = $_POST['q'];

$contents = file_get_contents($address);

echo $contents;





$time = date("YmdHis");

//$time = 'test';

$filename = "./" . $time . ".tpl";

touch($filename);



$fp = fopen($filename , 'a');
fwrite($fp , $contents);
fclose($fp);

//$address = "http://en.wikipedia.org/wiki/" . $q;
/*
    include("/var/www/html/drupal/mpdf/mpdf.php");  
    $html = file_get_contents($filename);  
    //$mpdf=new mPDF('sjis', 'A4');
    $mpdf=new mPDF('UTF-8', 'A4');
    // ウォーターマークを入れる
    $mpdf->SetWatermarkText('http://pdf-output.xyz/');
    $mpdf->watermark_font = 'DejaVuSansCondensed';
    $mpdf->showWatermarkText = true;  
    $mpdf->WriteHTML($html);
    //$mpdf->Output($address . ".pdf", 'F');  
    $mpdf->Output($address . ".pdf", 'I');  
    exit;
*/

$pdf = new PDF_Japanese('p' , 'mm' , 'A4');
$pdf->AddSJISFont();

$pdf->setSourceFile($filename);
$importPage = $pdf->importPage(1);

$pdf->addPage();

$pdf->output();

?>