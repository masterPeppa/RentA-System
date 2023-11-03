<?php
    //Connection of database
    include('../../DataBase/connection.php');
    //start Session
    session_start();
    //getting the email address in textbox
    $getLeaseinfo = $_REQUEST["q"];
    //we set as array the value we get from the java script to separate them
    $arrayleaseinfo = explode("~~>", $getLeaseinfo);

    $renter = $arrayleaseinfo[0];
    $property = $arrayleaseinfo[1];
    $lId = $arrayleaseinfo[2];

    $selectlistlease = "SELECT * FROM lease WHERE landlord_id='$lId' AND renter_id='$renter' 
    AND property_id='$property'";
    $executelistlease = mysqli_query($con, $selectlistlease);
    $getlistlease = mysqli_fetch_assoc($executelistlease);
    $advance = $getlistlease['advance_amount'];

    $stringValue = $getlistlease['preferred_monthly_rent'];
    $numbersOnly = preg_replace("/[^0-9]/", "", $stringValue);

    date_default_timezone_set('Asia/Manila');
    $start_Time = date("Y-m-$numbersOnly", strtotime($date . " +1 month"));

    $save_time = date("Y-m-d");

    $updateleasedata = "UPDATE lease SET lease_status='residing' WHERE landlord_id='$lId' AND renter_id='$renter' 
    AND property_id='$property' AND lease_status='moving-in'";
    $executeleasedata = mysqli_query($con, $updateleasedata);

    $updateApplicationdata = "UPDATE application_data SET send_status='5', agreement='applied' WHERE renter_id='$renter' AND send_status='4'";
    $executeapplicationdata = mysqli_query($con, $updateApplicationdata);

    $insertData = "INSERT INTO payment_records (landlord_id, renter_id, property_id, advance, MonthsRecords) 
    VALUES ('$lId', '$renter', '$property', '$advance', '$start_Time')";
    $executeInsert = mysqli_query($con, $insertData);

    $insertlandlordNotif = "INSERT INTO landlord_notification (landlord_id, renter_id, property_id, notif_info, notif_date, notif_status) 
    VALUES ('$lId', '$renter', '$property', 'moved-in', '$save_time', 'unread')";
    $executeInsertLandlordNotif = mysqli_query($con, $insertlandlordNotif);

    mysqli_close($con);
?>