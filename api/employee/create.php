<?php
    require("../service/DatabaseUtil.php");
    require("../model/Employee.php");

    header("Access-Control-Allow-Origin: *");

    $JsonEmployee = json_decode(file_get_contents('php://input'));

    $employee = new Employee($JsonEmployee->{"id"}, $JsonEmployee->{"nachname"},
                            $JsonEmployee->{"vorname"}, $JsonEmployee->{"strasse"},
                            $JsonEmployee->{"ort"}, $JsonEmployee->{"plz"},
                            $JsonEmployee->{"login"}, $JsonEmployee->{"passwort"});

    DatabaseUtil::addEmployee($employee);
?>