<?php
    session_start();
    include ('../../DataBase/connection.php');
    $userData = ucwords($_REQUEST["q"]);
    $select_types = "SELECT * FROM property_types WHERE property_type = '$userData'";
    $execute_types = mysqli_query($con, $select_types);
    $count_types = mysqli_num_rows($execute_types);
    if($count_types > 0){
        echo $userData;
    }
    else{
        $insertpropertyTypes = "INSERT INTO property_types (property_type) VALUES ('$userData')";
        $executpropertyTypes = mysqli_query($con, $insertpropertyTypes);
        echo "success";
    }
?>