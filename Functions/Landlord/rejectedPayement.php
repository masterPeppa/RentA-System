<?php
    include('../../DataBase/connection.php');
    $userId = $_POST['userid'];
    $renterId = $_POST['renterId'];
    $dateId = str_replace('%', ' ', $_POST['dateId']);
    
    $updateReceiptdata = "UPDATE receipt 
    SET payment_status = 'rejected' 
    WHERE landlord_id = '$userId' 
      AND renter_id = '$renterId' 
      AND payment_date_time = '$dateId' 
      AND payment_status = 'paid'";
    
    $executereceiptdata = mysqli_query($con, $updateReceiptdata);

    echo "../landlordPage/manageAdvancePayments.php";
?>
