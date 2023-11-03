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

    date_default_timezone_set('Asia/Manila');
    $save_time = date("Y-m-d H:i:s");

    $updateleasedata = "UPDATE lease SET date_lease_signed='$save_time', lease_status='signed' WHERE renter_id='$renter' AND landlord_id='$lId' 
    AND property_id='$property' AND lease_status='for-signing'";
    $executeleasedata = mysqli_query($con, $updateleasedata);

    $updateApplicationdata = "UPDATE application_data SET send_status='4' WHERE renter_id='$renter' AND send_status='3'";
    $executeapplicationdata = mysqli_query($con, $updateApplicationdata);

    $updateReceipt = "UPDATE receipt SET landlord_id = '$lId', property_id = '$property', payment_date_time = '$save_time', payment_status = 'paid' WHERE renter_id='$renter' AND payment_status = 'Not yet'";
    $executeUpdateReceipt = mysqli_query($con, $updateReceipt);

    $insertlandlordNotif = "INSERT INTO landlord_notification (landlord_id, renter_id, property_id, notif_info, notif_date, notif_status) 
    VALUES ('$lId', '$renter', '$property', 'Payment', '$save_time', 'unread')";
    $executeInsertLandlordNotif = mysqli_query($con, $insertlandlordNotif);

    $insertAdminNotif = "INSERT INTO admin_notification (landlord_id, renter_id, notif_info, date_notif, notif_status) 
    VALUES ('$lId', '$renter', 'Lease', '$save_time', 'unread')";
    $executeInsertAdminNotif = mysqli_query($con, $insertAdminNotif);

    mysqli_close($con);
?>