<?php
    //Connection of database
    include('../../DataBase/connection.php');
    //start Session
    session_start();
    //getting the email address in textbox
    $getinfo = ucwords($_REQUEST["q"]);
    //we set as array the value we get from the java script to separate them
    $arrayinfoList = explode("~~>", $getinfo);

    $lEmail = $_SESSION['lEmail'];

    date_default_timezone_set('Asia/Manila');
    $save_time = date("Y-m-d H:i:s");

    $lgetEmail = "SELECT * FROM user_landlord WHERE lEmail='$lEmail'";
    $lcheckDatabase = mysqli_query($con, $lgetEmail);
    $lgetId = mysqli_fetch_assoc($lcheckDatabase);

    $renter = $arrayinfoList[0];
    $property = $arrayinfoList[1];
    $lId = $lgetId['lID'];

    $startformattedDate = date('Y-m-d', strtotime($arrayinfoList[5]));
    $enformattedDate = date('Y-m-d', strtotime($arrayinfoList[6]));

    if($arrayinfoList[8] > 0){
        $penalty = $arrayinfoList[8];
    }
    else{
        $penalty = 0;
    }
    
    $updateData = "UPDATE lease SET preferred_monthly_rent='".$arrayinfoList[7]."', date_lease_sent='$save_time', starting_lease_date='$startformattedDate', ending_lease_date='$enformattedDate', sent_status='sent1', deposit_amount='".$arrayinfoList[2]."', advance_amount='".$arrayinfoList[3]."', advance_period='".$arrayinfoList[4]."', penalty_amount='$penalty', lease_status='for-signing' WHERE renter_id='$renter' AND landlord_id='$lId' AND property_id='$property' AND sent_status='not_yet'";
    $executeUpdate = mysqli_query($con, $updateData);

    $updateApplicationdata = "UPDATE application_data SET send_status='3', receive_status='sent' WHERE renter_id='$renter' AND send_status='2'";
    $executeapplicationdata = mysqli_query($con, $updateApplicationdata);

    $insertReceiptt = "INSERT INTO receipt (landlord_id, renter_id, property_id, date_send_lease, payment_status) 
    VALUES ('$lId', '$renter', '$property', '$save_time', 'Not yet')";
    $executeInsert = mysqli_query($con, $insertReceiptt);

    date_default_timezone_set('Asia/Manila');
    $created_Time = date("Y-m-d H:i:s");
    
    $insertNotif = "INSERT INTO renter_notification (landlord_id, renter_id, property_id, notif_info, notif_date, notif_status) 
    VALUES ('$lId', '$renter', '$property', 'received-lease', '$created_Time', 'unread')";
    $executeInsertNotif = mysqli_query($con, $insertNotif);

mysqli_close($con);
?>