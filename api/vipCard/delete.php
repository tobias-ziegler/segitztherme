<?php
    require("../service/DatabaseUtil.php");
    require("../model/VIPCard.php");

    header("Access-Control-Allow-Origin: *");

    $JsonVIPCard = json_decode(file_get_contents('php://input'));

    DatabaseUtil::deleteVIPCard($JsonVIPCard->{"id"});
?>