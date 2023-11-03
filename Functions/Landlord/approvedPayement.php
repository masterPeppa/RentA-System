<?php
    include('../../DataBase/connection.php');
    $userId = $_POST['userid'];
    $renterId = $_POST['renterId'];
    $dateId = str_replace('%', ' ', $_POST['dateId']);
    
    $updateReceiptdata = "UPDATE receipt 
    SET payment_status = 'approved' 
    WHERE landlord_id = '$userId' 
      AND renter_id = '$renterId' 
      AND payment_date_time = '$dateId' 
      AND payment_status = 'paid'";
    
    $executereceiptdata = mysqli_query($con, $updateReceiptdata);

    date_default_timezone_set('Asia/Manila');
    $created_Time = date("Y-m-d H:i:s");

    $insertNotif = "INSERT INTO renter_notification (landlord_id, renter_id, notif_info, notif_date, notif_status) 
    VALUES ('$userId', '$renterId', 'receipt-accepted', '$created_Time', 'unread')";
    $executeInsertNotif = mysqli_query($con, $insertNotif);

    echo "../landlordPage/manageAdvancePayments.php";
?>
