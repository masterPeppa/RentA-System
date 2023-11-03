<?php
    include ('../../DataBase/connection.php');
    $prop_id = ucwords($_REQUEST["q"]);
    $update_status="UPDATE landing_properties SET occular_visit_status='rejected' WHERE propertyID='$prop_id'";
    $newstatus_update_executed=mysqli_query($con,$update_status);
?>