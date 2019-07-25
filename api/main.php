<?php
    require("service/DatabaseUtil.php");
    require("model/Consumable.php");

    $listOfConsumables = array();

    $result = DatabaseUtil::getAllConsumables();


    echo json_encode($result);




    /*while($data = mysqli_fetch_assoc($result)) {
        
        $verpflegung = new Consumable($data["ver_id"], $data["ver_bezeichnung"],
                                        $data["ver_preis"], $data["ver_steuer"]);
        
        $listOfConsumables[] = $verpflegung;
    
    }*/

    //echo json_encode($result);

    /*foreach($listOfConsumables as $consumable) {
        echo $consumable->getVer_ID();
        echo "<br/>";
        echo $consumable->getVer_Bezeichnung();
        echo "<br/>";
        echo $consumable->getVer_Preis();
        echo "<br/>";
        echo $consumable->getVer_Steuer();
        echo "<br/>";
        echo "<br/>";
    }*/
    //foreach($data as $item) {
    //    echo $item . " - " ;
    //}
    //echo "<br/>";
?>