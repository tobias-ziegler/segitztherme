<?php
    require("../service/DatabaseUtil.php");
    require("../model/VIPCustomer.php");

    header("Access-Control-Allow-Origin: *");

    $JsonVIPCustomer = json_decode(file_get_contents('php://input'));

    DatabaseUtil::deleteVIPCustomer($JsonVIPCustomer->{"id"});
?>