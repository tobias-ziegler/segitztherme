<?php
    require("../service/DatabaseUtil.php");
    require("../model/TransponderChip.php");

    header("Access-Control-Allow-Origin: *");

    $chips = DatabaseUtil::getAllChips();

    echo json_encode($chips);
?>