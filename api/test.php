<?php
    require('service/DatabaseUtil.php');
    require('model/Employee.php');
    header('Access-Control-Allow-Origin: *');

    // get
    $employee = new Employee(1, "Mueller", "Manuel", "Strasse", "Ort", "PLZ");
    $employee2 = new Employee(2, "bla", "Manuel", "Strasse", "Ort", "PLZ");
    $employee3 = new Employee(3, "foo", "Manuel", "Strasse", "Ort", "PLZ");
    echo json_encode(array($employee, $employee2, $employee3));
    // post body
    $entityBody = file_get_contents('php://input');
    echo '<script>console.log('.json_encode($entityBody).')</script>';
?>