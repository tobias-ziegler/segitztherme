<?php
//session_start();
require_once 'CRaspberrySR.php';
require_once 'FunktionenPi2.php';
require_once 'service/DatabaseUtil.php';

$itemsToPurchase = json_decode(file_get_contents('php://input'));

$ChipID = purchaseItemandChargeChip();

//
// einkauf (ein_id, auf_id, ver_id, ein_betrag, ein_menge) values (null,1  ,1 ,2.50 ,2 );
if($ChipID != null){
    $stayID = determineStayID($ChipID); 
    //$itemsToPurchase = json_decode($jsonString);
    /*foreach ($itemsToPurchase as $orderItem) {
        linkorderItemToStay($stayID,$orderItem);
    }*/
	linkorderItemToStay($stayID,$itemsToPurchase);

}


function determineStayID($ChipID){
	$SQL ='Select * from aufenthalt where chip_id='. $ChipID. ' and auf_abfahrt is null';
    $Result = DatabaseUtil::executeDatabaseQuery($SQL) ;  
	$staysWithThisChipID = fetch_mysqli_assoc($Result);
	return $staysWithThisChipID["auf_id"];
    /*foreach ($staysWithThisChipID as $stay){
        //if($stay["auf_abfahrt"] == null){
        return $stay["auf_id"];
		//}
	}*/	
}

function linkorderItemToStay($stayID,$orderItem){
$SqlQ ='Insert into einkauf (ein_id, auf_id, ver_id, ein_betrag, ein_menge) values (null,'. $stayID.','. $orderItem->{"id"}.','. $orderItem->{"preis"}.','. $orderItem->{"count"}.');';
 $Result = DatabaseUtil::executeDatabaseQuery($SqlQ); 
 $Result = DatabaseUtil::executeDatabaseQuery('COMMIT;');
 
}
?>