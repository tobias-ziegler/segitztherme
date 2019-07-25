<?php
    require("../service/DatabaseUtil.php");
    require("../model/Purchase.php");

    header("Access-Control-Allow-Origin: *");

    $JsonPurchase = json_decode(file_get_contents('php://input'));

    $purchase = new Purchase($JsonPurchase->{"id"}, $JsonPurchase->{"auf_id"},
                            $JsonPurchase->{"ver_id"}, $JsonPurchase->{"betrag"},
                            $JsonPurchase->{"menge"});

    DatabaseUtil::addPurchase($purchase);
?>