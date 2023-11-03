<?php
    //Connection of database
    include('../../DataBase/connection.php');
    //start Session
    session_start();
    $notifid = $_POST['notifid'];
    $reasonValue = $_POST['reasonValue'];

    $reason = mysqli_real_escape_string($con, $reasonValue);

    date_default_timezone_set('Asia/Manila');
    $save_time = date("Y-m-d H:i:s");

    $notifinfo = "SELECT * FROM landlord_notification WHERE id='$notifid'";
    $executenotifinfo = mysqli_query($con, $notifinfo);
    $getnotifinfo = mysqli_fetch_assoc($executenotifinfo);
    
    $updateData = "UPDATE lease SET rejected_new_lease='$reason' WHERE renter_id='".$getnotifinfo['renter_id']."' AND landlord_id='".$getnotifinfo['landlord_id']."' AND property_id='".$getnotifinfo['property_id']."' AND lease_status='residing'";
    $executeUpdate = mysqli_query($con, $updateData);

    date_default_timezone_set('Asia/Manila');
    $created_Time = date("Y-m-d H:i:s");
    
    $insertNotif = "INSERT INTO renter_notification (landlord_id, renter_id, property_id, notif_info, notif_date, notif_status) 
    VALUES ('".$getnotifinfo['landlord_id']."', '".$getnotifinfo['renter_id']."', '".$getnotifinfo['property_id']."', 'extend-rejected', '$created_Time', 'unread')";
    $executeInsertNotif = mysqli_query($con, $insertNotif);

mysqli_close($con);
?>