
<?php
    include('../../DataBase/connection.php');
    session_start();

    $rejectedValue = ucwords($_REQUEST["q"]);

    $arrayrejectedInfo = explode("~~>", $rejectedValue);

    date_default_timezone_set('Asia/Manila');
    $created_Time = date("Y-m-d H:i:s");

    $updateData = "UPDATE payment_records SET pay_date=NULL, amount='0', Receipt_no=NULL, late=NULL, confirmation=NULL, img_receipt=NULL, rejected_reason='".mysqli_real_escape_string($con, $arrayrejectedInfo[1])."', sent_status=NULL WHERE id='".$arrayrejectedInfo[0]."'";
    $executeUpdate = mysqli_query($con, $updateData);

    $selectpayrecord = "SELECT * FROM payment_records WHERE id='".$arrayrejectedInfo[0]."'";
    $executepayrecord = mysqli_query($con, $selectpayrecord);
    $getpayrecord = mysqli_fetch_assoc($executepayrecord);

    $insertNotif = "INSERT INTO renter_notification (landlord_id, renter_id, property_id, payment_id, notif_info, notif_date, notif_status) 
    VALUES ('".$getpayrecord['landlord_id']."', '".$getpayrecord['renter_id']."', '".$getpayrecord['property_id']."', '".$arrayrejectedInfo[0]."', 'receipt-rejected', '$created_Time', 'unread')";
    $executeInsertNotif = mysqli_query($con, $insertNotif);
?>