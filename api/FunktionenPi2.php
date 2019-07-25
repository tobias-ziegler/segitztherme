<?php
session_start();
require_once 'CRaspberrySR.php';

//Die Adressierung des Restaurant / VIP Terminals
$Raspb1IP = '192.168.30.11';
$Raspb1Port = '9021';



// for Pi#2
//if (!isset($_SESSION['CONNECT'])) {

    // Neues Treiber-Objekt erzeugen, über das der Zugriff auf alle Raspberry-Funktionen erfolgt
    // Bei der Objekterzeugung werden die IP-Adresse und der Port des Servers übergeben
$conPi2 = new CRaspberrySR($Raspb1IP, $Raspb1Port);
$_SESSION['CONNECT'] = $conPi2;
$conPi2->Connect();
//}
//else {
//    $conPi2 = $_SESSION['CONNECT'];
//    $conPi2->Connect();
//}

//scan UID
function getUid($ScannerPort){// 0 for left Scanner (1.0) Restaurant / 1 for right Scanner (1.1) VIP _ terminal
    // read chipID
    $UID = null;
   
    $UID = $conPi2->readRFID_UID($ScannerPort);
    if($UID != null){    
        checkInSuccessful();    
    }
    return $UID;
}
//Diese FUnktion wird am VIP Terminal aufgerufen
// Die Auswahl des Scanners ist bereits hartcodiert (RPI 2.1)
// Die UID der VIP - Card wird für die weitere Verarbeitung zurück gegeben
function scanVIPCard(){
// read cardID from Reader 1
    $UID = null;
   
        $UID = s->readRFID_UID("1");
        if($UID != null){
        checkSuccessful();
        
        }else{
        checkUnseccessful();
        }    
    
return $UID;
}
	// Diese Funktion setzt den Ausgangs-BerechtigungsIndikator auf 0 und signalisiert so den negativen Stand des Kundenkonto.
	// Die Auswahl des Scanners ist bereits hartcodiert (RPI 2.0)
	// Die UID des Chips wird für die weitere Verarbeitung zurück gegeben
function purchaseItemandChargeChip(){
		$UID = getUid(0);
        // set exitPermitted to false;
         $result = $conPi2->writeRFID_Byte(0, 8, 0, 0, '0', '12:34:56:78:90:AB');
         return $UID;
}
function unchargeChip(){
		
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