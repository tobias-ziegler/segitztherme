<?php
    require("../service/DatabaseUtil.php");
    require("../model/Entrance.php");

    header("Access-Control-Allow-Origin: *");

    $entrances = DatabaseUtil::getAllEntrances();

    echo json_encode($entrances);
?>