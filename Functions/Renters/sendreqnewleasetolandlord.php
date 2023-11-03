<?php
include('../../DataBase/connection.php');
session_start();

$notifid = $_POST['notifid'];

$selectnotif = "SELECT * FROM renter_notification WHERE id='$notifid'";
$executenotif = mysqli_query($con, $selectnotif);
$getnotif = mysqli_fetch_assoc($executenotif);

date_default_timezone_set('Asia/Manila');
$save_time = date("Y-m-d");

$insertlandlordNotif = "INSERT INTO landlord_notification (landlord_id, renter_id, property_id, notif_info, notif_date, notif_status) 
    VALUES ('".$getnotif['landlord_id']."', '".$getnotif['renter_id']."', '".$getnotif['property_id']."', 'extension', '$save_time', 'unread')";
    $executeInsertLandlordNotif = mysqli_query($con, $insertlandlordNotif);
// Close the database connection
mysqli_close($con);
?>