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

// ページ読み込み
$tmp = file_get_contents($filename);

// 日本語化 ja+aCJK
// フォーマット A4は縦、A4-Lは横
// 左マージン 15、右マージン 15、上マージン 16、下マージン 16、ヘッダマージン 9、フッタマージン 9
$mpdf = new mPDF();
// ウォーターマークを入れる
$mpdf->SetWatermarkText('http://pdf-output.xyz/');
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->showWatermarkText = true;
$mpdf->WriteHTML($tmp);
// PDF表示
$mpdf->Output($address . '.pdf' , 'I');
// PDF保存
// $mpdf->Output('create.pdf', 'F');
exit;


/*
$pdf = new tFPDF();
$pdf->AddPage();

// フォントの追加（第4引数をtrueにしてUTF-8を有効にする）
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
$pdf->SetFont('DejaVu','',14);

// 例としてUTF-8で作成されたファイルをロードして表示
$txt = file_get_contents($filename);
$pdf->Write(8,$txt);
// Select a standard font (uses windows-1252)
//$pdf->SetFont('Arial','',14);
//$pdf->Ln(10);
//$pdf->Write(5,'The file size of this PDF is only 12 KB.');

$pdf->Output();

*/
?>