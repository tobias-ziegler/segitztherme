<?php
    require("../service/DatabaseUtil.php");
    require("../model/VIPCustomer.php");

    header("Access-Control-Allow-Origin: *");

    $vipCustomers = DatabaseUtil::getAllVIPCustomers();

    echo json_encode($vipCustomers);
?>