<?php
    //Connection of database
    include('../../DataBase/connection.php');
    //start Session
    session_start();
    //getting the email address in textbox
    $getdate = ucwords($_REQUEST["q"]);
    $lEmail = $_SESSION['lEmail'];

    $datedata = explode("~~>", $getdate);

    $dateformat = $datedata[0];
    $formatted_date = date('Y-m-d', strtotime($dateformat));

    $nextyear_formatted_date = date('Y-m-d', strtotime($dateformat . " +1 year"));

    $lgetEmail = "SELECT * FROM user_landlord WHERE lEmail='$lEmail'";
    $lcheckDatabase = mysqli_query($con, $lgetEmail);
    $lgetId = mysqli_fetch_assoc($lcheckDatabase);

    $lId = $lgetId['lID'];

    $updatelease = "UPDATE lease SET move_in_data='$formatted_date', move_out_data='$nextyear_formatted_date', lease_status='moving-in' WHERE landlord_id='$lId' AND renter_id='".$datedata[2]."' AND property_id='".$datedata[1]."'";
    $executelease = mysqli_query($con, $updatelease);

    $updateApplicationdata = "UPDATE application_data SET receive_status='sent' WHERE landlord_id='$lId' AND renter_id='".$datedata[2]."' AND property_id='".$datedata[1]."'";
    $executeapplicationdata = mysqli_query($con, $updateApplicationdata);

    date_default_timezone_set('Asia/Manila');
    $created_Time = date("Y-m-d H:i:s");

    $insertNotif = "INSERT INTO renter_notification (landlord_id, renter_id, property_id, notif_info, notif_date, notif_status) 
    VALUES ('$lId', '".$datedata[2]."', '".$datedata[1]."', 'moved-in-q', '$created_Time', 'unread')";
    $executeInsertNotif = mysqli_query($con, $insertNotif);

    mysqli_close($con);
?>