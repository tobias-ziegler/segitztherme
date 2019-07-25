<?php
    require("../service/DatabaseUtil.php");
    require("../model/VIPCustomer.php.php");

    header("Access-Control-Allow-Origin: *");

    $vipCustomers = DatabaseUtil::getAllVIPCustomers();

    echo json_encode($vipCustomers);
?>