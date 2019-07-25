<?php
// Testprogramm für ein Objekt der Klasse CRaspberrySR
// Projekt: RFID_SendReceive
//
// PC-Treiber zur Fernsteuerung des Raspberry Pi via TCP/IP
// (C) C. Kilgenstein, 07/2019

// Das Programm benötigt auf der Gegenseite (Raspberry Pi) das
// Programm sockserver_9000.py

require_once 'CRaspberrySR.php';

if (!isset($_SESSION['CONNECT'])) {

    // Neues Treiber-Objekt erzeugen, über das der Zugriff auf alle Raspberry-Funktionen erfolgt
    $con = new CRaspberrySR('192.168.30.11','9020');
    $_SESSION['CONNECT'] = $con;
    $con->Connect();
}
else {
    $con = $_SESSION['CONNECT'];
    $con->Connect();
}

// Je nach gedrücktem Button wird die entsprechende Funktion ausgeführt und das Raspberry-Modul damit angesteuert
if(isset($_POST["LED1ON"])) {
    $con->setLED1(true);
}
else if(isset($_POST["LED1OFF"])) {
    $con->setLED1(false);
}
if(isset($_POST["LED2ON"])) {
    $con->setLED2(true);
}
else if(isset($_POST["LED2OFF"])) {
    $con->setLED2(false);
}
if(isset($_POST["LED3ON"])) {
    $con->setLED3(true);
}
else if(isset($_POST["LED3OFF"])) {
    $con->setLED3(false);
}
if(isset($_POST["LED4ON"])) {
    $con->setLED4(true);
}
else if(isset($_POST["LED4OFF"])) {
    $con->setLED4(false);
}
if(isset($_POST["LED5ON"])) {
    $con->setLED5(true);
}
else if(isset($_POST["LED5OFF"])) {
    $con->setLED5(false);
}
if(isset($_POST["LED6ON"])) {
    $con->setLED6(true);
}
else if(isset($_POST["LED6OFF"])) {
    $con->setLED6(false);
}
if(isset($_POST["LED7ON"])) {
    $con->setLED7(true);
}
else if(isset($_POST["LED7OFF"])) {
    $con->setLED7(false);
}
if(isset($_POST["LED8ON"])) {
    $con->setLED8(true);
}
else if(isset($_POST["LED8OFF"])) {
    $con->setLED8(false);
}
if(isset($_POST["LED9ON"])) {
    $con->setLED9(true);
}
else if(isset($_POST["LED9OFF"])) {
    $con->setLED9(false);
}
else if(isset($_POST["LEDALLON"])) {
    $con->setLEDArray(511);
}
else if(isset($_POST["LEDALLOFF"])) {
    $con->setLEDArray(0);
}
else if(isset($_POST["LEDARRAY"])) {
    $con->setLEDArray($_POST["txtLEDArray"]);
    $LEDArray = $_POST["txtLEDArray"];
}
else if(isset($_POST["LED<"])) {
    $LEDArray = ($_POST["txtLEDArray"]==0) ? 511 : $_POST["txtLEDArray"] - 1;
    $con->setLEDArray($LEDArray);
}
else if(isset($_POST["LED>"])) {
    $LEDArray = ($_POST["txtLEDArray"]==511) ? 0 : $_POST["txtLEDArray"] + 1;
    $con->setLEDArray($LEDArray);
}

else if(isset($_POST["REL1ON"])) {
    $con->setRelais1(true);
}
else if(isset($_POST["REL1OFF"])) {
    $con->setRelais1(false);
}
else if(isset($_POST["REL2ON"])) {
    $con->setRelais2(true);
}
else if(isset($_POST["REL2OFF"])) {
    $con->setRelais2(false);
}
else if(isset($_POST["BEEPON"])) {
    $con->setBeeper(true);
}
else if(isset($_POST["BEEPOFF"])) {
    $con->setBeeper(false);
}
else if(isset($_POST["GETUID"])) {
    $UID = $con->readRFID_UID("1");
}
else if(isset($_POST["GETBYTE"])) {
    $retVal = $con->readRFID_Byte(1, 8, 0, 0, "FF:FF:FF:FF:FF:FF");

    $Byte = $retVal[1];
}
else if(isset($_POST["SETBYTE"])) {
    $retVal = $con->writeRFID_Byte(1, 8, 0, 0, $_POST["txtByte"], "FF:FF:FF:FF:FF:FF");

    $Byte = $retVal;
}
else if(isset($_POST["GETDOUBLE"])) {
    $retVal = $con->readRFID_Double(1, 9, 0, "FF:FF:FF:FF:FF:FF");

    $Double = $retVal[1];
}
else if(isset($_POST["SETDOUBLE"])) {
    $retVal = $con->writeRFID_Double(1, 9, 0, $_POST["txtDouble"], false, "FF:FF:FF:FF:FF:FF");

    $Double = $retVal;
}
else if(isset($_POST["SETNEWKEY"])) {
    $retVal = $con->writeRFIDNewKey(1, $_POST["txtSektor"], $_POST["txtOldKey"], $_POST["txtNewKey"]);

    $Sektor = $_POST["txtSektor"];
    $strOldKey = $_POST["txtOldKey"];
    $strNeyKey = $_POST["txtNewKey"];
}


?>

<H3> Programm zum Test der PHP-Klasse CRaspberrySR für  <BR>
     die Kommunikation zwischen PC und Raspberry Pi<BR></H3>
<H4>(C) C. Kilgenstein, 07/2019 <BR><BR>
    <U>Hinweis:</U> Auf dem Raspberry Pi muss das Programm sockserver_9000.py gestartet werden!</H4>



<form action="sendrecv.php" method="POST">
    <H4>Schalt-Funktionen</H4>
    <button type="submit" name="LED1ON">LED 1 an </button>
    <button type="submit" name="LED1OFF">LED 1 aus </button>

    <button type="submit" name="REL1ON">Relais 1 an </button>
    <button type="submit" name="REL1OFF">Relais 1 aus </button>

    <button type="submit" name="BEEPON">Beeper an </button>
    <button type="submit" name="BEEPOFF">Beeper aus </button><BR>

    <button type="submit" name="LED2ON">LED 2 an </button>
    <button type="submit" name="LED2OFF">LED 2 aus </button>

    <button type="submit" name="REL2ON">Relais 2 an </button>
    <button type="submit" name="REL2OFF">Relais 2 aus </button><BR>

    <button type="submit" name="LED3ON">LED 3 an </button>
    <button type="submit" name="LED3OFF">LED 3 aus </button><BR>

    <button type="submit" name="LED4ON">LED 4 an </button>
    <button type="submit" name="LED4OFF">LED 4 aus </button><BR>

    <button type="submit" name="LED5ON">LED 5 an </button>
    <button type="submit" name="LED5OFF">LED 5 aus </button><BR>

    <button type="submit" name="LED6ON">LED 6 an </button>
    <button type="submit" name="LED6OFF">LED 6 aus </button><BR>

    <button type="submit" name="LED7ON">LED 7 an </button>
    <button type="submit" name="LED7OFF">LED 7 aus </button><BR>

    <button type="submit" name="LED8ON">LED 8 an </button>
    <button type="submit" name="LED8OFF">LED 8 aus </button><BR>

    <button type="submit" name="LED9ON">LED 9 an </button>
    <button type="submit" name="LED9OFF">LED 9 aus </button><BR><BR>

    <button type="submit" name="LEDALLON">Alle LEDs an </button>
    <button type="submit" name="LEDALLOFF">Alle LEDs aus </button><BR><BR><BR>

    <H3>Umwandlung von Dezimalzahlen in Dualzahlen</H3><BR>

    <input type="text" style="font-size: 20pt"  size="3"  name="txtLEDArray" value="<?php echo (isset($LEDArray)) ? $LEDArray : ""; ?>">
    <button type="submit" style="font-size: 20pt"  name="LED<"> < </button>
    <button type="submit" style="font-size: 20pt"  name="LED>"> > </button>
    <button type="submit" style="font-size: 20pt"  name="LEDARRAY">Senden</button>

    <br><br>
    <H4>RFID-Funktionen</H4>
    <button type="submit" name="GETUID">UID lesen</button>
    <input type="text" name="txtUID" value="<?php echo (isset($UID)) ? $UID : ""; ?>">

    <br><br>
    <button type="submit" name="GETBYTE">Byte lesen</button>
    <button type="submit" name="SETBYTE">Byte schreiben</button>
    <input type="text" name="txtByte" value="<?php echo (isset($Byte)) ? $Byte : ""; ?>">

    <br><br>
    <button type="submit" name="GETDOUBLE">Double lesen</button>
    <button type="submit" name="SETDOUBLE">Double schreiben</button>
    <input type="text" name="txtDouble" value="<?php echo (isset($Double)) ? $Double : ""; ?>">

    <br><br><br><br>
    <b>Achtung:</b> Ändern Sie den Schlüssel eines Sektors nur mit Bedacht! Sie können auf die Daten des Sektors<br>
    nur noch mit dem neuen Schlüssel zugreifen!! Notieren Sie sich deshalb unbedingt den neuen Schlüssel!<br>
    Der Standardschlüssel lautet: FF:FF:FF:FF:FF:FF
    <br><br>
    Sektor: <input type="text" name="txtSektor" value="<?php echo (isset($Sektor)) ? $Sektor : ""; ?>">
    Alter Key: <input type="text" name="txtOldKey" value="<?php echo (isset($strOldKey)) ? $strOldKey : ""; ?>">
    Neuer Key: <input type="text" name="txtNewKey" value="<?php echo (isset($strNeyKey)) ? $strNeyKey : ""; ?>">
    <button type="submit" name="SETNEWKEY">Neuen Key schreiben</button>
</form>
