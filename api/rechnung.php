<?php
require_once('fpdf/fpdf.php');
require_once("service/DatabaseUtil.php");
require_once("model/Employee.php");
require_once("model/berechnung.php");

function rechnung($mitID, $chipID, $einID){
	date_default_timezone_set("Europe/Berlin");  
	$mitObj = DatabaseUtil::fetchEmployee($mitID);
	$einObj = DatabaseUtil::fetchEntrance($einID);
	
	$pdf = new FPDF();
	$pdf->AddPage();
	//SetFont(schriftart,bold/kursiv/unterstrichen, schriftgröße)
	$pdf->SetFont('Arial','',10);
	//Cell(schriftgröße, höhenabstand, text)
	$pdf->Cell(10,0,'******************************');
	//Linebreak
	$pdf->Ln();
	$pdf->Cell(10,5,'*Empfang EG  '.time().'*');
	$pdf->Ln();
	$pdf->Cell(10,5,'*bon-rg-Nr.		FM4843980 *');
	$pdf->Ln();
	$pdf->Cell(10,5,'*                                      *');
	$pdf->Ln();
	$pdf->Cell(10,5,'*Es bediente Sie:            *');
	$pdf->Ln();
	$pdf->Cell(10,5,'*'.$mitObj->mit_nachname.' '.$mitObj->mit_vorname.'                   *');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Cell(10,5,'Chip-Nr.   '.$chipID);
	$pdf->Ln();
	$pdf->Cell(10,5,'Ankunft. . . : '.date('d-m-Y H:i:s'));
	$pdf->Ln();
	$pdf->Cell(10,5,'Aufenthalt   : '.$einObj->ein_dauer).' h';
	$pdf->Ln();
	$pdf->Cell(10,5,'1 Eintritt '.$einObj->ein_kategorie).'       '.berechneEintritt($einObj->ein_preis);
	$pdf->Ln();
	$pdf->Cell(10,5,'=========================================');
	$pdf->SetFont('Arial','b',10);
	
	$pdf->Output();
}
?>