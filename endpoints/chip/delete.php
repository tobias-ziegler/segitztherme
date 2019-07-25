<?php
    require("../service/DatabaseUtil.php");
    require("../model/TransponderChip.php");

    header("Access-Control-Allow-Origin: *");

    $JsonChip = json_decode(file_get_contents('php://input'));

    DatabaseUtil::deleteChip($JsonChip->{"id"});
?>