<?php
//eintritt 7%
//verpfl 19%
    require_once("service/DatabaseUtil.php");
	require_once("model/Employee.php");
	require_once("model/Entrance.php");
	require_once("model/Stay.php");
	require_once("model/TransponderChip.php");
	require_once("model/FunktionenPi1.php");
	require_once("model/rechnung.php");
	
	//ChipID auslesen
	$chipID = checkIn();
	//Frotentdaten auslesne
	$entityBody = file_get_contents('php://input');
	//String in json encoden
    json_encode($entityBody);
	//json in Objekt decoden
	$jsonObj = json_decode($entityBody);
	//Aufenthaltsobjekt mit Frontend Daten befüllen
	$stayObj = new Stay(1, $chipID, $jsonObj->{'priceId'], $jsonObj->{'employeeId'],
						$jsonObj->{'mitId_abfahrt'],
						date('Y-m-d H:i:s'), '2019-07-11 11:00:00');
	//Aufenthaltsobjekt auf die DB schreiben
	$result = DatabaseUtil::addStay($stayObj, $chipID);
	
	rechnung($jsonObj->{'employeeId'], $chipID, $jsonObj->{'entranceId']);
?>