<?php
    require("../service/DatabaseUtil.php");

    header("Access-Control-Allow-Origin: *");

    $query = "Select * from VGewinnHeute;";

    $Result = DatabaseUtil::executeDatabaseQuery($query);

    while($data = mysqli_fetch_assoc($Result)) {
        echo json_encode($data);
    }
?>