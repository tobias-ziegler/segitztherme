<?php
    require("../service/DatabaseUtil.php");
    require("../model/Employee.php");

    header("Access-Control-Allow-Origin: *");

    $JsonEmployee = json_decode(file_get_contents('php://input'));

    DatabaseUtil::deleteEmployee($JsonEmployee->{"id"});
?>