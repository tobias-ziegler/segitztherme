<?php
require_once("service/DatabaseUtil.php");
//require_once("model/Employee.php");
//require_once("model/Entrance.php");
//require_once("model/Stay.php");
//require_once("model/TransponderChip.php");
require_once("./FunktionenPi1.php");
//require_once("./rechnung.php");
header("Access-Control-Allow-Origin: *");


	//ChipID auslesen
	$chipID = checkIn();
	//Frotentdaten auslesen
	$entityBody = file_get_contents('php://input');
	//String in json encoden
	//json_encode($entityBody);
	//json in Objekt decoden
	$jsonObj = json_decode($entityBody);
	//echo json_encode($jsonObj);
	//Aufenthaltsobjekt mit Frontend Daten befüllen
	/*$stayObj = new Stay(1, $chipID, $jsonObj->{'priceId'], $jsonObj->{'employeeId'],
						null,
						null, null);*/
	//Aufenthaltsobjekt auf die DB schreiben
	$SQL='Insert into Aufenthalt value(null,'. $ChipID .','.$jsonObj->{'priceId'}.','. $jsonObj->{'employeeId'}.',null,null,Curdate(),null);' ;
	//echo $SQL;
	$result = DatabaseUtil::executeDatabaseQuery($SQL);
	$result = DatabaseUtil::executeDatabaseQuery('Commit');
	//Checkin Rechnung ausgeben
	//checkInRechnung($jsonObj->{'employeeId'], $chipID, $jsonObj->{'entranceId']);
?>