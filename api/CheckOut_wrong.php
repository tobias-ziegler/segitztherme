<?php
require_once("service/DatabaseUtil.php");
require_once("model/TransponderChip.php");
require_once("FunktionenPi1.php");
require_once("rechnung.php");
function perform_checkout() {
	
	unlockChip();
	$chipID = getUid(1);
	//Frotentdaten auslesen
	$entityBody = file_get_contents('php://input');
	//String in json encoden
	json_encode($entityBody);
	//json in Objekt decoden
	$jsonObj = json_decode($entityBody);
	//Rechnung ausgeben
	checkOutRechnung($jsonObj->{'employeeId'], $chipID);
	//Abfahrtszeit auf DB schreiben
	DatabaseUtil::insertleave($chipID);
	
}
?>