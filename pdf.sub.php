<?php
// Noticeエラー非表示
error_reporting(E_ALL & ~E_NOTICE);

$address = $_GET['q'];

 
// PDFインスタンス作成
include_once('../drupal/fpdf/fpdf.php');
//$pdf = new PDF_Japanese('P', 'mm', 'A4');
//$pdf->AddPage(); //ページを追加
 
// UTF-16フォントロード
//$pdf->AddUniJISFont('MS-Mincho','UniJIS_Mincho');
//$pdf->AddUniJISFont('MS-Gothic','UniJIS_Gothic');

$content = file_get_contents($address);

//Load PHP DOM
$doc = new DOMDocument();

//load HTML in PHP DOM
@$doc->loadHTML($content);

//extract the text of a DIV element for PDF
$text_for_pdf = $doc->getElementById('page_content')->nodeValue;  
//テンプレートPDF読み込み
//$pageno = $pdf->setSourceFile($text_for_pdf);
//$tplidx = $pdf->ImportPage(1);
//$pdf->useTemplate($tplidx);
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->Multicell(190,10, $text_for_pdf);  
// 文字書き込み：明朝体
//$pdf->SetFont('UniJIS_Mincho', '', 20);
//$pdf->SetTextColor(255,0,0);
//$str = mb_convert_encoding('あいうえお　一期一会　明朝体',"unicode","utf-8"); // UTF8 -> UTF16変換
//$pdf->Text(5, 10, $str);
 
// 文字書き込み：ゴシック体
//$pdf->SetFont('UniJIS_Gothic', '', 20);
//$pdf->SetTextColor(0,0,255);
//$str = mb_convert_encoding('あいうえお　一期一会　ゴシック体',"unicode","utf-8"); // UTF8 -> UTF16変換
//$pdf->Text(5, 20, $str);
  
// PDF出力
// $pdf->Output('sample.pdf', "F"); // ファイルに出力する場合
//$pdf->Output($address . '.pdf', "I"); // 画面に出力する場合
$pdf->Output();
// PDFクローズ
$pdf->Close();
  
exit;

/*
//include fpdf
require('../drupal/fpdf/fpdf.php');

//read the contents of a url you want to convert to PDF
$content = file_get_contents($address);

//Load PHP DOM
$doc = new DOMDocument();

//load HTML in PHP DOM
@$doc->loadHTML($content);

//extract the text of a DIV element for PDF
$text_for_pdf = $doc->getElementById('page_content')->nodeValue;

//use FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);

//specify width and height of the cell Multicell(width, height, string)
//load extracted text into FPDF
$pdf->Multicell(190,10, $text_for_pdf);

$pdf->Output(); //output the file
*/
?>