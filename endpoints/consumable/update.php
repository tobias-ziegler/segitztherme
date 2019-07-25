<?php
    require("../service/DatabaseUtil.php");
    require("../model/Consumable.php");

    header("Access-Control-Allow-Origin: *");

    $JsonConsumable = json_decode(file_get_contents('php://input'));

    $consumable = new Consumable($JsonConsumable->{"id"}, $JsonConsumable->{"bezeichnung"},
                            $JsonConsumable->{"preis"}, $JsonConsumable->{"steuer"});

    DatabaseUtil::updateConsumable($consumable);
?>