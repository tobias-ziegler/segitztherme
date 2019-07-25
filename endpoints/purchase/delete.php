<?php
    require("../service/DatabaseUtil.php");
    require("../model/Purchase.php");

    header("Access-Control-Allow-Origin: *");

    $JsonPurchase = json_decode(file_get_contents('php://input'));

    DatabaseUtil::deletePurchase($JsonPurchase->{"id"});
?>