<?php
    //Connection of database
    include('../../DataBase/connection.php');
    //start Session
    session_start();
    $notifid = $_POST['notifid'];

    date_default_timezone_set('Asia/Manila');
    $save_time = date("Y-m-d H:i:s");

    $move_out_data = date("Y-m-d H:i:s", strtotime($save_time . " +1 year"));

    $notifinfo = "SELECT * FROM landlord_notification WHERE id='$notifid'";
    $executenotifinfo = mysqli_query($con, $notifinfo);
    $getnotifinfo = mysqli_fetch_assoc($executenotifinfo);

    date_default_timezone_set('Asia/Manila');
    $created_Time = date("Y-m-d H:i:s");
    
    $insertNotif = "INSERT INTO renter_notification (landlord_id, renter_id, property_id, notif_info, notif_date, notif_status) 
    VALUES ('".$getnotifinfo['landlord_id']."', '".$getnotifinfo['renter_id']."', '".$getnotifinfo['property_id']."', 'extend-agreed', '$created_Time', 'unread')";
    $executeInsertNotif = mysqli_query($con, $insertNotif);

    $updateData = "UPDATE lease SET move_out_data = '$move_out_data' WHERE renter_id='".$getnotifinfo['renter_id']."' AND landlord_id='".$getnotifinfo['landlord_id']."' AND property_id='".$getnotifinfo['property_id']."' AND lease_status='residing'";
    $executeUpdate = mysqli_query($con, $updateData);

mysqli_close($con);
?>