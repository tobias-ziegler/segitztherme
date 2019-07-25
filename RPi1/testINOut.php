<?php
require_once 'FunktionenPi1.php';

 $con = new CRaspberrySR('192.168.30.11', '9020');
 $_SESSION['CONNECT'] = $con;
 $con->Connect();

if(isset($_POST["GETUID"])) {
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

else if(isset($_POST["SETNEWKEY"])) {
    $retVal = $con->writeRFIDNewKey(1, $_POST["txtSektor"], $_POST["FF:FF:FF:FF:FF:FF"], $_POST["12:34:56:78:90:AB"]);

    $Sektor = $_POST["txtSektor"];
    $strOldKey = $_POST["txtOldKey"];
    $strNeyKey = $_POST["txtNewKey"];
}
else if(isset($_POST["INITCHIP"])) {
    initChip();
}
?>

<form action="sendrecv.php" method="POST">
    
     <button type="submit" name="INITCHIP">init Chip</button>
    
    <H4>RFID-Funktionen</H4>
    <button type="submit" name="GETUID">UID lesen</button>
    <input type="text" name="txtUID" value="<?php echo (isset($UID)) ? $UID : " "; ?>">
    
    <br><br>
    <button type="submit" name="GETBYTE">Byte lesen</button>
    <button type="submit" name="SETBYTE">Byte schreiben</button>
    <input type="text" name="txtByte" value="<?php echo (isset($Byte)) ? $Byte : " "; ?>"

    <br><br><br><br>
    <b>Achtung:</b> Ändern Sie den Schlüssel eines Sektors nur mit Bedacht! Sie können auf die Daten des Sektors<br>
    nur noch mit dem neuen Schlüssel zugreifen!! Notieren Sie sich deshalb unbedingt den neuen Schlüssel!<br>
    Der Standardschlüssel lautet: FF:FF:FF:FF:FF:FF
    <br><br>
    Sektor: <input type="text" name="txtSektor" value="<?php echo (isset($Sektor)) ? $Sektor : " "; ?>">
    Alter Key: <input type="text" name="txtOldKey" value="<?php echo (isset($strOldKey)) ? $strOldKey : " "; ?>">
    Neuer Key: <input type="text" name="txtNewKey" value="<?php echo (isset($strNeyKey)) ? $strNeyKey : " "; ?>">
    <button type="submit" name="SETNEWKEY">Neuen Key schreiben</button>
</form>



