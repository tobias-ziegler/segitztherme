<?php
session_start();
require_once 'CRaspberrySR.php';
require_once 'FunktionenPi2.php';
require_once 'DatabaseUtil.php';

$jsonString = "[
  {
    "id": "4",
    "bezeichnung": "Brotzeitplatte",
    "preis": "7.8",
    "steuer": "19",
    "count": 1
  },
  {
    "id": "5",
    "bezeichnung": "Salat",
    "preis": "7.8",
    "steuer": "19",
    "count": 3
  },
  {
    "id": "6",
    "bezeichnung": "Bier 0.5",
    "preis": "3.2",
    "steuer": "19",
    "count": 2
  },
  {
    "id": "7",
    "bezeichnung": "Cola 0.5",
    "preis": "2.7",
    "steuer": "19",
    "count": 2
  },
  {
    "id": "9",
    "bezeichnung": "Bla",
    "preis": "10",
    "steuer": "7",
    "count": 2
  }
]";
$itemsToPurchase = json_decode($jsonString);
$ChipID = purchaseItemandChargeChip();

//
// einkauf (ein_id, auf_id, ver_id, ein_betrag, ein_menge) values (null,1  ,1 ,2.50 ,2 );
if($ChipID != null && !empty($jsonString )){
    $stayID = determineStayID($CustomerID); 
    $itemsToPurchase = json_decode($jsonString);
    foreach ($itemsToPurchase as $orderItem) {
        linkorderItemToStay($stayID,$orderItem);
    }

}


function determineStayID($ChipID){
	$SQL ='Select * from aufenthalt where chip_id='. $ChipID. ' where auf_abfahrt is null';
    $Result = DatabaseUtil::executeDatabaseQuery($SQL) ;  
	$staysWithThisChipID = fetch_mysqli_assoc($Result);
	//Abfrage auf Aufenthalt mit "where chip_id=$ChipID" + foreach über Ergebnismenge

    foreach ($staysWithThisChipID as $stay){
        if($stay["auf_abfahrt"] == null){
        return $stay["auf_id"];
    }
}

function linkorderItemToStay($stayID,$orderItem){
$SqlQ = Insert into einkauf (ein_id, auf_id, ver_id, ein_betrag, ein_menge) values (null, $stayID, $orderItem["id"], $orderItem["preis"], $orderItem["count"])
 $Result = DatabaseUtil::executeDatabaseQuery($SqlQ) ;  
}

?>