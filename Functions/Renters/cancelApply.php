<?php
    //Connection of database
    include('../../DataBase/connection.php');
    //start Session
    session_start();
    //getting the email address in textbox
    $getLeaseinfo = ucwords($_REQUEST["q"]);
    //we set as array the value we get from the java script to separate them
    $arrayleaseinfo = explode("~~>", $getLeaseinfo);

    $renter = $arrayleaseinfo[0];
    $property = $arrayleaseinfo[1];
    $lId = $arrayleaseinfo[2];

    $save_time = date("Y-m-d");
    
    $updateleasedata = "UPDATE lease SET lease_status='cancelled' WHERE renter_id='$renter' AND landlord_id='$lId' 
    AND property_id='$property' AND lease_status='for-signing'";
    $executeleasedata = mysqli_query($con, $updateleasedata);

    $delete_query = mysqli_query($con, "DELETE FROM application_data WHERE send_status='3' AND renter_id='$renter' AND
    landlord_id='$lId' AND property_id='$property'");

    $insertlandlordNotif = "INSERT INTO landlord_notification (landlord_id, renter_id, property_id, notif_info, notif_date, notif_status) 
    VALUES ('$lId', '$renter', '$property', 'Cancelled', '$save_time', 'unread')";
    $executeInsertLandlordNotif = mysqli_query($con, $insertlandlordNotif);

    mysqli_close($con);
?>