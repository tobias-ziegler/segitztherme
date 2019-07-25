<?php
    require("../service/DatabaseUtil.php");
    require("../model/VIPCustomer.php");

    header("Access-Control-Allow-Origin: *");

    $JsonVIPCustomer = json_decode(file_get_contents('php://input'));

    $vipCustomer = new VIPCustomer($JsonVIPCustomer->{"id"}, $JsonVIPCustomer->{"vipcardId"},
                            $JsonVIPCustomer->{"nachname"}, $JsonVIPCustomer->{"vorname"},
                            $JsonVIPCustomer->{"geburtsdatum"});

    DatabaseUtil::addVIPCustomer($vipCustomer);
?>