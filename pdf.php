<?php
//include_once("analyticstracking.php");
//require_once("../drupal/fpdf/japanese.php");
//require('../drupal/tfpdf/tfpdf.php');
require_once('../drupal/mpdf/mpdf.php');

$address = $_POST['q'];

$contents = file_get_contents($address);

//echo $contents;





$time = date("YmdHis");

//$time = 'test';

$filename = "./" . $time . ".html";

touch($filename);
chmod($filename , 0777);



$fp = fopen($filename , 'a');
fwrite($fp , $contents);
fclose($fp);

// �y�[�W�ǂݍ���
$tmp = file_get_contents($filename);

// ���{�ꉻ ja+aCJK
// �t�H�[�}�b�g A4�͏c�AA4-L�͉�
// ���}�[�W�� 15�A�E�}�[�W�� 15�A��}�[�W�� 16�A���}�[�W�� 16�A�w�b�_�}�[�W�� 9�A�t�b�^�}�[�W�� 9
$mpdf = new mPDF();
// �E�H�[�^�[�}�[�N������
$mpdf->SetWatermarkText('http://pdf-output.xyz/');
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->showWatermarkText = true;
$mpdf->WriteHTML($tmp);
// PDF�\��
$mpdf->Output($address . '.pdf' , 'I');
// PDF�ۑ�
// $mpdf->Output('create.pdf', 'F');
exit;


/*
$pdf = new tFPDF();
$pdf->AddPage();

// �t�H���g�̒ǉ��i��4������true�ɂ���UTF-8��L���ɂ���j
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
$pdf->SetFont('DejaVu','',14);

// ��Ƃ���UTF-8�ō쐬���ꂽ�t�@�C�������[�h���ĕ\��
$txt = file_get_contents($filename);
$pdf->Write(8,$txt);
// Select a standard font (uses windows-1252)
//$pdf->SetFont('Arial','',14);
//$pdf->Ln(10);
//$pdf->Write(5,'The file size of this PDF is only 12 KB.');

$pdf->Output();

*/
?>