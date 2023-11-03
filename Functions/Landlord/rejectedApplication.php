
<?php
    include('../../DataBase/connection.php');
    session_start();

    $applicationdata = ucwords($_REQUEST["q"]);

    $arrayApplicationData = explode("~~>", $applicationdata);

    $updateApplicationdata = "UPDATE application_data SET send_status='rejected', rejected_reason='".mysqli_real_escape_string($con, $arrayApplicationData[3])."',
     receive_status='sent', agreement='stop' WHERE renter_id='".$arrayApplicationData[1]."' AND property_id='".$arrayApplicationData[0]."'
    AND landlord_id='".$arrayApplicationData[2]."' AND agreement='Ongoing'";
    $executeapplicationdata = mysqli_query($con, $updateApplicationdata);

    date_default_timezone_set('Asia/Manila');
    $created_Time = date("Y-m-d H:i:s");
    
    $insertNotif = "INSERT INTO renter_notification (landlord_id, renter_id, property_id, notif_info, notif_date, notif_status) 
    VALUES ('".$arrayApplicationData[2]."', '".$arrayApplicationData[1]."', '".$arrayApplicationData[0]."', 'rejected-application', '$created_Time', 'unread')";
    $executeInsertNotif = mysqli_query($con, $insertNotif);
?>