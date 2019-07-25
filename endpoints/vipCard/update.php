<?php
    require("../service/DatabaseUtil.php");
    require("../model/VIPCard.php");

    header("Access-Control-Allow-Origin: *");

    $JsonVIPCard = json_decode(file_get_contents('php://input'));

    $vipCard = new VIPCard($JsonVIPCard->{"id"}, $JsonVIPCard->{"kategorieId"},
                            $JsonVIPCard->{"guthaben"});

    DatabaseUtil::updateVIPCard($vipCard);
?>