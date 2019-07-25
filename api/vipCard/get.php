<?php
    require("../service/DatabaseUtil.php");
    require("../model/VIPCard.php");

    header("Access-Control-Allow-Origin: *");

    $vipCards = DatabaseUtil::getAllVIPCards();

    echo json_encode($vipCards);
?>