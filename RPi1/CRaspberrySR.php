<?php
// Klasse CRaspberrySR
// Projekt: RFID_SendReceive
//
// PC-Treiber zur Fernsteuerung des Raspberry Pi via TCP/IP
// (C) C. Kilgenstein, 04/2019

// Dieser Treiber benötigt auf der Gegenseite (Raspberry Pi) das
// Programm sockserver.py

session_start();
/**
 * Class CRaspberrySR
 */
class CRaspberrySR
{
	private $strIpAdress;
	private $strPort;
	private $socket = null;
	
	/**
	 * CRaspberrySR constructor.
	 * @param string $strIpAdress
	 * @param string $strPort
	 */
	public function __construct($strIpAdress = "192.168.30.12", $strPort = '9020')
	{
		$this->strIpAdress = $strIpAdress;
		$this->strPort = $strPort;
	}

	// ----------------------------------------------------------------------------------------------------------------
	// Funktionen für den Verbindungsaufbau zum Server
	// ----------------------------------------------------------------------------------------------------------------
	public function Connect()
	{
		$this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

		//$this->socket = pfsockopen('192.168.1.206', '9000', $errno, $errstr, 1000);
		if ($this->socket === false) {
			echo "socket_create() fehlgeschlagen: Grund: " . socket_strerror(socket_last_error()) . "\n";
		} else {
			//echo "OK.\n";
		}



		//echo "Versuche, zu '$this->strIpAdress' auf Port '$this->strPort' zu verbinden ...";
		$result = socket_connect($this->socket, $this->strIpAdress, $this->strPort);
		if ($result === false) {
			echo "socket_connect() fehlgeschlagen.\nGrund: ($result) " . socket_strerror(socket_last_error($this->socket)) . "\n";
			echo $this->socket, $this->strIpAdress, $this->strPort;
		} else {
			//echo "OK.\n";
		}

	}

	public function quitConnection()
	{
		$this->sendData("QUIT");
		socket_close($this->socket);
	}
	// ----------------------------------------------------------------------------------------------------------------

	// ----------------------------------------------------------------------------------------------------------------
	// Grundfunktionen für Senden und Empfangen
	// ----------------------------------------------------------------------------------------------------------------
	private function sendData($strData)
	{
		//echo "Kommando senden ...";
		socket_write($this->socket, $strData, strlen($strData));
		//fwrite($this->socket, $strData, strlen($strData));
	}

	private function receiveData()
	{
		//echo "Serverantwort lesen:\n\n";
		$out = socket_read($this->socket, 2048);
		//$out = fread($this->socket, 2048);

		return $out;
	}
	// ----------------------------------------------------------------------------------------------------------------


	// ----------------------------------------------------------------------------------------------------------------
	// Anwendungsbezogene Funktionen
	// ----------------------------------------------------------------------------------------------------------------

	// Funktionen zum Ein- und Ausschalten der 9 LEDs
	public function setLED1($boOnOff)
	{
		$this->sendData(($boOnOff) ? "SL11" : "SL10");
	}
	public function setLED2($boOnOff)
	{
		$this->sendData(($boOnOff) ? "SL21" : "SL20");
	}
	public function setLED3($boOnOff)
	{
		$this->sendData(($boOnOff) ? "SL31" : "SL30");
	}
	public function setLED4($boOnOff)
	{
		$this->sendData(($boOnOff) ? "SL41" : "SL40");
	}
	public function setLED5($boOnOff)
	{
		$this->sendData(($boOnOff) ? "SL51" : "SL50");
	}
	public function setLED6($boOnOff)
	{
		$this->sendData(($boOnOff) ? "SL61" : "SL60");
	}
	public function setLED7($boOnOff)
	{
		$this->sendData(($boOnOff) ? "SL71" : "SL70");
	}
	public function setLED8($boOnOff)
	{
		$this->sendData(($boOnOff) ? "SL81" : "SL80");
	}
	public function setLED9($boOnOff)
	{
		$this->sendData(($boOnOff) ? "SL91" : "SL90");
	}
	public function setLEDArray($Number)
	{
		$this->sendData("SLAR");
		sleep(1);
		$this->sendData($Number);
	}
	

	// Funktionen zum Ein- und Ausschalten der beiden Relais
	public function setRelais1($boOnOff)
	{
		$this->sendData(($boOnOff) ? "SR11" : "SR10");
	}

	public function setRelais2($boOnOff)
	{
		$this->sendData(($boOnOff) ? "SR21" : "SR20");
	}

	// Funktion zum Ein- und Ausschalten des Beepers
	public function setBeeper($boOnOff)
	{
		$this->sendData(($boOnOff) ? "SB1" : "SB0");
	}


	// Für die nachstehenden RFID-Funktionen hier ein paar Informationen
	// zum Aufbau der Mifare-Speicherkarten (Transponder)

	// Die RFID-Modulbaugruppen enthalten jeweils 2 Sub-D Anschlüsse für
	// die RFID-Reader; deshalb enthält jede RFID-Methode des vorliegenden
	// Treibers als ersten Parameter "iReader", dessen Wert 0 oder 1 sein
	// kann. Mit 0 wird der linke Anschluss der Modulbaugruppe angesprochen
	// (Blickrichtung vom Modul zur Hutschiene)

	// Die Transponder enthalten 16 Sektoren; jeder Sektor besteht aus
	// 4 Blöcken; jeder Block enthält 16 Byte; das ergibt in Summe
	// 16*4*16 = 1024 Byte, also ein Kilobyte

	// Die Blöcke weisen folgende Besonderheit auf:
	// Jeder letzte Block (Blocknummer 3) eines Sektors ist jeweils der
	// Verwaltungsblock, auch "Sector Trailer" genannt; in ihm sind neben
	// zweierlei Authentifizierungsschlüsseln (wovon hier nur einer
	// verwendet wird) auch sog. "Access Bits" untergebracht, mit denen man
	// den Zugriff auf die Daten noch weiter steuern kann, was hier im
	// vorliegenden Treiber aber nicht geschieht.
	// In den ersten 6 Bytes des "Sector Trailers" ist immer der erste
	// Authentifizierungsschlüssel zu finden, der von der vorliegenden
	// Software unterstützt wird.

	// Zur Datennutzung stehen also immer die Blöcke 0..2 zur Verfügung,
	// mit einer Ausnahme: der allererste Block 0 des Transponders, also
	// der mit Sektornummer 0 / Blocknummer 0, enthält herstellerspezifische
	// Daten und kann nicht genutzt werden! Unter anderem findet sich hier
	// die UID des Transponders (4 Byte).
	// Insgesamt bleiben damit 752 Byte zur freien Verfügung übrig



	// Name: readRFID_UID(Reader)
	// Abstract: Liest die UID eines Transponders
	// P1: RFID-Reader (0..1)
	// Return: string
	//      UID, wenn erfolgreich
	public function readRFID_UID($iReader)
	{
		$this->sendData("G_RFID_UID");
		sleep(1);
		$this->sendData($iReader);

		$returnVal = $this->receiveData();
		return $returnVal;
	}

	// Name: readRFID_Byte(Reader, Sektor, Block, Index, Key)
	// Abstract: Liest ein Byte eines Sektors ein
	// P1: RFID-Reader (0..1)
	// P2: Sektor (0..15)
	// P3: Block (0..3)
	// P4: Index (0..15)
	// P5: Authentifizierungsschlüssel für den Sektor
	//    (Format: "0x00:0x00:0x00:0x00:0x00:0x00" oder "00:00:00:00:00:00")
	// Return: string-Array
	//      String 1: "OK", wenn erfolgreich
	//      String 2: Angefordertes Byte
	public function readRFID_Byte($iReader, $iSektor, $iBlock, $iIndex, $Key)
	{
		// Bereichsprüfung Parameter
		$boFehler = false;
		$strReturn[0] = "False";
		$strReturn[1] = "False";
		if ($iReader < 0 || $iReader > 1)
		{
			$boFehler = true;
			$strReturn[0] = "Fehler: readRFID_Byte(), iReader out of range";
		}
		if ($iSektor < 0 || $iSektor > 15)
		{
			$boFehler = true;
			$strReturn[0] = "Fehler: readRFID_Byte(), iSektor out of range";
		}
		if ($iBlock < 0 || $iBlock > 3)
		{
			$boFehler = true;
			$strReturn[0] = "Fehler: readRFID_Byte(), iBlock out of range";
		}
		if ($iIndex < 0 || $iIndex > 15)
		{
			$boFehler = true;
			$strReturn[0] = "Fehler: readRFID_Byte(), iIndex out of range";
		}

		if (!$boFehler)
		{
			$iAddr = $iSektor * 4 + $iBlock;
			$strParameter = $iReader.'#'.$iAddr.'#'.$iIndex.'#'.$Key;

			$this->sendData("G_RFID_UID_Byte");
			sleep(1);
			$this->sendData($strParameter);

			$strReturn[0] = $this->receiveData(); // Status
			$strReturn[1] = $this->receiveData(); // Byte
		}

		return $strReturn;
	}

	// Name: readRFID_Double(Reader, Sektor, iBlock, Key)
	// Abstract: Liest einen double-Wert eines Blocks ein
	// P1: RFID-Reader (0..1)
	// P2: Sektor (0..15)
	// P3: Block (0..3)
	// P4: Authentifizierungsschlüssel für den Sektor
	//     (Format: "0x00:0x00:0x00:0x00:0x00:0x00")
	// Return: string-Array
	//      String 1: "OK", wenn erfolgreich
	//      String 2: DoubleString
	public function readRFID_Double($iReader, $iSektor, $iBlock, $Key)
	{
		// Bereichsprüfung Parameter
		$boFehler = false;
		$strReturn[0] = "False";
		$strReturn[1] = "False";
		if ($iReader < 0 || $iReader > 1)
		{
			$boFehler = true;
			$strReturn[0] = "Fehler: readRFID_Double(), iReader out of range";
		}
		if ($iSektor < 0 || $iSektor > 15)
		{
			$boFehler = true;
			$strReturn[0] = "Fehler: readRFID_Double(), iSektor out of range";
		}
		if ($iBlock < 0 || $iBlock > 3)
		{
			$boFehler = true;
			$strReturn[0] = "Fehler: readRFID_Double(), iBlock out of range";
		}

		if (!$boFehler) {
			$iAddr = $iSektor * 4 + $iBlock;
			$strParameter = $iReader.'#'.$iAddr.'#'.$Key;

			$this->sendData("G_RFID_DOUBLE");
			sleep(1);
			$this->sendData($strParameter);

			$strReturn[0] = $this->receiveData(); // Status
			$strReturn[1] = $this->receiveData(); // Double-Wert als String
		}

		return $strReturn;
	}

	// Name: writeRFID_Byte(Reader, Sektor, Block, Index, Value, Key)
	// Abstract: Schreibt ein Byte auf den Transponder
	// P1: RFID-Reader (0..1)
	// P2: Sektor (0..15)
	// P3: Block (0..3)
	// P3: Index (0..15)
	// P4: Wert (0..255)
	// P5: Authentifizierungsschlüssel für den Sektor
	//     (Format: "0x00:0x00:0x00:0x00:0x00:0x00")
	// Return: string
	//      Fehlermeldung, wenn Daten nicht geschrieben werden konnten
	//      "Byte geschrieben", wenn erfolgreich

	public function writeRFID_Byte($iReader, $iSektor, $iBlock, $iIndex, $iValue, $Key)
	{
		// Bereichsprüfung Parameter
		$boFehler = false;
		$strReturn = "False";
		if ($iReader < 0 || $iReader > 1)
		{
			$boFehler = true;
			$strReturn = "Fehler: writeRFID_Byte(), iReader out of range";
		}
		if ($iSektor < 0 || $iSektor > 15)
		{
			$boFehler = true;
			$strReturn = "Fehler: writeRFID_Byte(), iSektor out of range";
		}
		if ($iBlock < 0 || $iBlock > 3)
		{
			$boFehler = true;
			$strReturn = "Fehler: writeRFID_Byte(), iBlock out of range";
		}
		if ($iIndex < 0 || $iIndex > 15)
		{
			$boFehler = true;
			$strReturn = "Fehler: writeRFID_Byte(), iIndex out of range";
		}
		if ($iValue < 0 || $iValue > 255)
		{
			$boFehler = true;
			$strReturn = "Fehler: writeRFID_Byte(), iValue out of range";
		}

		if (!$boFehler) {
			$iAddr = $iSektor * 4 + $iBlock;

			$strParameter = $iReader.'#'.$iAddr.'#'.$iIndex.'#'.$iValue.'#'.$Key;

			$this->sendData("S_RFID_Byte");
			sleep(1);
			$this->sendData($strParameter);

			$strReturn = $this->receiveData(); // Bestätigung empfangen
		}

		return $strReturn;
	}

	// Name: writeRFID_Double(Reader, Sektor, Block, DoubleZahl, Currency, Key)
	//       Länge der Zahl einschl. Dezimalpunkt: 15 Zeichen
	//       Das erste Byte des Blocks wird für die Länge benötigt
	// Abstract: Schreibt einen double-Wert in einen Block
	// P1: RFID-Reader (0..1)
	// P2: Sektor (0..15)
	// P3: Block (0..3)
	// P4: double-Wert
	// P5: Currency: true, wenn 2 Nachkommastellen, false sonst
	// P6: Authentifizierungsschlüssel für den Sektor
	//     (Format: "0x00:0x00:0x00:0x00:0x00:0x00")
	// Return: string
	//      Fehlermeldung, wenn Daten nicht geschrieben werden konnten
	//      "Bytes geschrieben", wenn erfolgreich
	public function writeRFID_Double($iReader, $iSektor, $iBlock, $Value, $boCurrency, $Key)
	{
		// Bereichsprüfung Parameter
		$boFehler = false;
		$strReturn = "False";
		if ($iReader < 0 || $iReader > 1)
		{
			$boFehler = true;
			$strReturn = "Fehler: writeRFID_Double(), iReader out of range";
		}
		if ($iSektor < 0 || $iSektor > 15)
		{
			$boFehler = true;
			$strReturn = "Fehler: writeRFID_Double(), iSektor out of range";
		}
		if ($iBlock < 0 || $iBlock > 3)
		{
			$boFehler = true;
			$strReturn = "Fehler: writeRFID_Double(), iBlock out of range";
		}
		if ($iBlock == 3)
		{
			$boFehler = true;
			$strReturn = "Fehler: writeRFID_Double(), writing into Sector Trailer not allowed!";
		}


		if (!$boFehler) {
			$iAddr = $iSektor * 4 + $iBlock;

			if ($boCurrency)
				$strValue = number_format($Value, 2);
			else
				$strValue = (string)$Value;

			$strValueLen = (string)strlen($strValue);

			$strParameter = $iReader.'#'.$iAddr.'#'.$strValue.'#'.$strValueLen.'#'.$Key;

			$this->sendData("S_RFID_DOUBLE");
			sleep(1);
			$this->sendData($strParameter);

			$strReturn = $this->receiveData(); // Bestätigung empfangen
		}

		return $strReturn;
	}

	// Name: writeRFIDNewKey(Reader, Sektor, oldKey, newKey)
	// Abstract:    Ersetzt den Authentifizierungsschlüssel des angegebenen
	//              Sektors durch einen neuen Schlüssel
	//              Danach kann auf den angegebenen Sektor mit dem neuen
	//              Schlüssel zugegriffen werden; alle anderen Sektoren
	//              bleiben davon unberührt
	// P1: RFID-Reader (0..1)
	// P2: Sektor (0..15)
	// P4: Alter Schlüssel (Format: "0x00:0x00:0x00:0x00:0x00:0x00")
	// P5: Neuer Schlüssel (Format: "0x00:0x00:0x00:0x00:0x00:0x00")
	// Return: string
	//      False, wenn Daten nicht geschrieben werden konnten
	//      Fehlerbeschreibung, wenn Parameter out of range
	//      True, wenn erfolgreich
	public function writeRFIDNewKey($iReader, $iSektor, $strOldKey, $strNewKey)
	{
		// Bereichsprüfung Parameter
		$boFehler = false;
		$strReturn = "False";

		if ($iReader < 0 || $iReader > 1)
		{
			$boFehler = true;
			$strReturn = "Fehler: writeRFIDNewKey(), iReader out of range";
		}
		if ($iSektor < 0 || $iSektor > 15)
		{
			$boFehler = true;
			$strReturn = "Fehler: writeRFIDNewKey(), iSektor out of range";
		}

		if (!$boFehler) {
			$iAddr = $iSektor * 4 + 3;

			$strParameter = $iReader.'#'.$iAddr.'#'.$strOldKey.'#'.$strNewKey;

			$this->sendData("S_RFID_NEWKEY");
			sleep(1);
			$this->sendData($strParameter);

			$strReturn = $this->receiveData(); // Bestätigung empfangen
		}

		return $strReturn;
	}

	// ----------------------------------------------------------------------------------------------------------------
	// ----------------------------------------------------------------------------------------------------------------
} // class CRaspberrySR
?>
