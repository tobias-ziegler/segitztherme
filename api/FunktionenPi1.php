<?php
session_start();
require_once 'CRaspberrySR.php';
//Die Adressierung des Check In / Check Out Terminals
$Raspb1IP = '192.168.30.12';
$Raspb1Port = '9020';


// Verbindungsaufbau zum Check In / Check Out Terminal
if (!isset($_SESSION['CONNECT'])) {

    // Neues Treiber-Objekt erzeugen, über das der Zugriff auf alle Raspberry-Funktionen erfolgt
    // Bei der Objekterzeugung werden die IP-Adresse und der Port des Servers übergeben
    $conPi1 = new CRaspberrySR($Raspb1IP, $Raspb1Port);
    $_SESSION['CONNECT'] = $conPi1;
    $conPi1->Connect();
}
else {
    $conPi1 = $_SESSION['CONNECT'];
    $conPi1->Connect();
}
// Die Funktion beinhaltet die Logik zum einmaligen Initialieren des Chips und legt den Zugriffschlüssel für die Lese und Schreibberechtigungen fest.
// Sie Wird vom Check In Terminal aufgerufen (RaspBPi 1 Reader Schnittstelle 0)
function initChip (){
// Zugriffsschlüssel für den Manufacturer - Block im Sekor 1 des NFC Chips (beinhaltet die UID)
public function writeRFIDNewKey(0, 0, "FF:FF:FF:FF:FF:FF", "12:34:56:78:90:AB");
// Zugriffsschlüssel für den Sektor 8 des NFC Chips (beinhaltet die Ausgangsberechtigung)
public function writeRFIDNewKey(0, 8, "FF:FF:FF:FF:FF:FF", "12:34:56:78:90:AB");

}


//Die Funktion liest die Informationen des gescannten RFID Chip ein und gibt dessen UID zurück
//Bei Erfolgreichen auslesen wird aus ein Akustisches Signal ausgegeben und die grüne LED signalisiert zusätzlich den Erfolg des Scanvorgangs
//als EingabeParameter wird die Nr des Scanners benötigt (Check In Scanner -> 0, Check Out Scanner -> 1)
function getUid($ScannerPort){
    // read chipID
    $UID = null;
   
    $UID = $conPi1->readRFID_UID($ScannerPort);
    if($UID != null){    
        checkInSuccessful();    
    }
    return $UID;
}
//Die Funktion liest die Informationen des gescanten RFID Chip ein und gibt dessen UID zurück
//Bei Erfolgreichen auslesen wird aus ein Akustisches Signal ausgegeben und die grüne LED signalisiert zusätzlich den Erfolg des Scanvorgangs
//die Auswahl des Check In Scanner ist bereits hartcodiert
function checkIn($ScannerPort = 0){
    // read chipID
    $UID = null;
   
    $UID = $conPi1->readRFID_UID($ScannerPort);
    if($UID != null){    
        checkInSuccessful();    

    }
    return $UID;
}
//Die Funktion liest die Informationen der gescanten RFID Karte ein und gibt dessen UID zurück
//Bei Erfolgreichen auslesen wird aus ein Akustisches Signal ausgegeben und die grüne LED signalisiert zusätzlich den Erfolg des Scanvorgangs
//die Auswahl des Check Out Scanner(1.0) ist bereits hartcodiert
function scanVIPCard(){
// read cardID from Reader 1
    $UID = null;
   
        $UID = $conPi1->readRFID_UID("0");
        if($UID != null){
			checkSuccessful(); 
        }else{
			checkUnseccessful();
        }    
    
return $UID;
}
// Die Funktion wird beim Versuch das Ausgangsdrehkreuz zu passieren (Check out Terminal) aufgerufen und liest den PermissionToExit - Flagwertes des RFID Chips aus
// ist dieser gesetzt (1) also der Gast berechtigt das Bad zu verlassen wird dies durch ein Akustisches Signal und einer Grünen LED signalisiert
// ist dieser auf 0 oder nicht gesetzt der Chip also nicht valide Initialisiert oder die Ausgangs-Berechtigung noch nicht erteilt 
// erfolgt ebenfalls eins Akustisches Signal sowie das Aufleuchten einer roten LED 
// Der BerechtigungsIndikator wird ebenfalls für die weitere Verarbeitung zurückgegeben
// Sie Wird vom Check Out Terminal aufgerufen (RaspBPi 1 Reader Schnittstelle 1)
function exitAttemp(){
	 $returnValue = $conPi1->readRFID_Byte(1, 8, 0, 0, "12:34:56:78:90:AB");
	 $permissionToExit = $returnValue[1];

	 if($permissionToExit != '1'){
		checkUnseccessful();
	 }else{
		checkSuccessful();
	 }
	 return $permissionToExit;

}
// Diese Funktion setzt den PermissionToExit - Flagwertes auf 0 und signalisiert so den negativen Stand des Kundenkontos
// Der Erfolg des Schreibevorgangs wird auserdem für die weitere Verarbeitung zurück gegeben (als String)
function lockChip(){
        // set Bool exitPermitted to false;
         $result = $conPi1->writeRFID_Byte(0, 8, 0, 0, '0', '12:34:56:78:90:AB');
         return $result;
}

// 
function unlockChip(){
		
        // set exitPermitted to false;
         $result = $conPi1->writeRFID_Byte(0, 8, 0, 0, '1', '12:34:56:78:90:AB');
         return $result;
}

// langer Piepton + kurzer Piepton + grüne LED 
function checkSuccessful(){
    //long beep
    $con->setBeeper(true);
    $con->setLED9(true);
	usleep(350000);
	$con->setBeeper(false);
	usleep(10000);
    //short beep
	$con->setBeeper(true);
	usleep(250000);
	$con->setBeeper(false);
	 $con->setLED9(false);
	usleep(10000);
}

// Langer Piepton + Rote LED
function checkUnSuccessful(){
    $con->setBeeper(true);
    $con->setLED1(true);
	usleep(500000);
	$con->setBeeper(false);
	$con->setLED1(false);


}



?>