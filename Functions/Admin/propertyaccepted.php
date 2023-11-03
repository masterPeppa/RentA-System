<?php
    include ('../../DataBase/connection.php');
    $prop_id = ucwords($_REQUEST["q"]);
    $update_status="UPDATE landing_properties SET occular_visit_status='visited' WHERE propertyID='$prop_id'";
    $newstatus_update_executed=mysqli_query($con,$update_status);

    $selectProperty = "SELECT * FROM landing_properties WHERE propertyID='$prop_id'";
    $executeSelectProperty = mysqli_query($con, $selectProperty);
    $getProperty = mysqli_fetch_assoc($executeSelectProperty);


    $save_time = date("Y-m-d");

    $insertlandlordNotif = "INSERT INTO landlord_notification (landlord_id, property_id, notif_info, notif_date, notif_status) 
    VALUES ('".$getProperty['landlord_id']."', '".$getProperty['propertyID']."', 'property-approved', '$save_time', 'unread')";
    $executeInsertLandlordNotif = mysqli_query($con, $insertlandlordNotif);
?>

