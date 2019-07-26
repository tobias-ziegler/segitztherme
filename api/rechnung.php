<?php
require_once('fpdf/fpdf.php');
require_once("service/DatabaseUtil.php");
require_once("model/Entrance.php");
require_once("model/CheckOut.php");
require_once("model/Employee.php");
require_once("berechnung.php");

function checkInRechnung($mitID, $chipID, $einID){
	date_default_timezone_set("Europe/Berlin");  
	$mitObj = DatabaseUtil::fetchEmployee($mitID);
	$einObj = DatabaseUtil::fetchEntrance($einID);
	$eintrittPreis = $einObj[0]->getEin_Preis();
	$eintrittPreis = number_format($eintrittPreis, 2, ',', '.');
	
	$pdf = new FPDF();
	$pdf->AddPage();
	//SetFont(schriftart,bold/kursiv/unterstrichen, schriftgröße)
	$pdf->SetFont('Arial','',10);
	//Cell(breitenabstand, höhenabstand, text)
	$pdf->Cell(10,0,'***********************************');
	//Linebreak
	$pdf->Ln();
	$pdf->Cell(2,5,'*');$pdf->Cell(45,5,'Empfang EG  '.date("H:i:s"));$pdf->Cell(2,5,'*');
	$pdf->Ln();
	$pdf->Cell(2,5,'*');$pdf->Cell(45,5,'bon-rg-Nr.		FM4843980 ');$pdf->Cell(2,5,'*');
	$pdf->Ln();
	$pdf->Cell(2,5,'*');$pdf->Cell(45,5,'');$pdf->Cell(2,5,'*');
	$pdf->Ln();
	$pdf->Cell(2,5,'*');$pdf->Cell(45,5,'Es bediente Sie: ');$pdf->Cell(2,5,'*');
	$pdf->Ln();
	$pdf->Cell(2,5,'*');$pdf->Cell(45,5,$mitObj[0]->getMit_Nachname().' '.$mitObj[0]->getMit_Vorname());$pdf->Cell(2,5,'*');
	$pdf->Ln();
	$pdf->Cell(10,2,'***********************************');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Cell(10,5,'Chip-Nr.   '.$chipID);
	$pdf->Ln();
	$pdf->Cell(10,5,'Ankunft. . . : '.date('d-m-Y H:i:s'));
	$pdf->Ln();
	$pdf->Cell(10,5,'Aufenthalt   : '.$einObj[0]->getEin_Dauer().' h');
	$pdf->Ln();
	$pdf->Cell(10,5,'1 Eintritt '.$einObj[0]->getEin_Kategorie().'       '.$eintrittPreis);
	$pdf->Ln();
	$pdf->Cell(10,5,'=========================');
	$pdf->Ln();
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(10,5,'bezahlter Betrag:             '.$eintrittPreis);
	$pdf->SetFont('Arial','',10);
	$pdf->Ln();
	$pdf->Cell(10,5,'(Alle Betraege in EURO)');
	$pdf->Output();
}
function checkOutRechnung($mitID, $chipID){
	//Zeitzone 
	date_default_timezone_set("Europe/Berlin"); 
	//Mitarbeiter aus der DB ziehen
	$mitObj = DatabaseUtil::fetchEmployee($mitID);
	//Positionen aus der DB ziehen
	$posObj = DatabaseUtil::getPositions($chipID);
	//Summierter Endbetrag
	$bezahlterBetrag = 0;
	$pdf = new FPDF();
	$pdf->AddPage();
	//SetFont(schriftart,bold/kursiv/unterstrichen, schriftgröße)
	$pdf->SetFont('Arial','',10);
	//Cell(breitenabstand, höhenabstand, text)
	$pdf->Cell(10,0,'***********************************');
	//Linebreak
	$pdf->Ln();
	$pdf->Cell(2,5,'*');$pdf->Cell(45,5,'Empfang EG  '.date("H:i:s"));$pdf->Cell(2,5,'*');
	$pdf->Ln();
	$pdf->Cell(2,5,'*');$pdf->Cell(45,5,'bon-rg-Nr.		FM4843980 ');$pdf->Cell(2,5,'*');
	$pdf->Ln();
	$pdf->Cell(2,5,'*');$pdf->Cell(45,5,'');$pdf->Cell(2,5,'*');
	$pdf->Ln();
	$pdf->Cell(2,5,'*');$pdf->Cell(45,5,'Es bediente Sie: ');$pdf->Cell(2,5,'*');
	$pdf->Ln();
	$pdf->Cell(2,5,'*');$pdf->Cell(45,5,$mitObj[0]->getMit_Nachname().' '.$mitObj[0]->getMit_Vorname());$pdf->Cell(2,5,'*');
	$pdf->Ln();
	$pdf->Cell(10,2,'***********************************');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Cell(10,5,'Chip-Nr.   '.$chipID);
	$pdf->Ln();
	$pdf->Cell(10,5,'Ankunft. . . : '.$posObj[0]->getAuf_Ankunft());
	$pdf->Ln();
	$pdf->Cell(10,5,'Aufenthalt   : '.$posObj[0]->getAuf_Abfahrt().' h');
	$pdf->Ln();
	//Einzelpositionen ausgeben
	foreach($posObj as $pos){
		$pdf->Cell(10,5,$pos->getEin_Menge());
		$pdf->Cell(30,5,$pos->getVer_Bezeichnung());
		$pdf->Cell(30,5,number_format($pos->getEin_Betrag(), 2, ',', '.'));
		$bezahlterBetrag += $pos->getEin_Betrag();
		$pdf->Ln();
	}
	$pdf->Ln();
	$pdf->Cell(10,5,'=========================');
	$pdf->Ln();
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(10,5,'bezahlter Betrag:             '.number_format($bezahlterBetrag, 2, ',', '.'));
	$pdf->SetFont('Arial','',10);
	$pdf->Ln();
	$pdf->Cell(10,5,'(Alle Betraege in EURO)');
	$pdf->Output();
}
checkOutRechnung(1,'b3e258d3');
?>