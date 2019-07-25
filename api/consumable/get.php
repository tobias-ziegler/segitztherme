<?php
    require("../service/DatabaseUtil.php");
    require("../model/Consumable.php");

    header("Access-Control-Allow-Origin: *");

    $consumables = DatabaseUtil::getAllConsumables();

    echo json_encode($consumables);
?>