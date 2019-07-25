<?php
    require("../service/DatabaseUtil.php");
    require("../model/Employee.php");

    header("Access-Control-Allow-Origin: *");

    $employees = DatabaseUtil::getAllEmployees();

    echo json_encode($employees);
?>