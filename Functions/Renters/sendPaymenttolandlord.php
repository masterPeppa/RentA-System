
<?php
    include('../../DataBase/connection.php');
    session_start();

    //notifdate
    date_default_timezone_set('Asia/Manila');
    $currentDateTime = new DateTime();
    $databaseFormattedDate = $currentDateTime->format('Y-m-d');

    $sendcurrentdate = $getpayrecord['MonthsRecords'];
    $sendcurrentdate = new DateTime($sendcurrentdate);

    $receiptdata = ucwords($_REQUEST["q"]);
    $arrayreceipt = explode("~~>", $receiptdata);

    $randomNumber = rand(100000, 999999);
    $receiptNo = "R-".$randomNumber;

    $selectpayrecord = "SELECT * FROM payment_records WHERE id='".$arrayreceipt[0]."'";
    $executepayrecord = mysqli_query($con, $selectpayrecord);
    $getpayrecord = mysqli_fetch_assoc($executepayrecord);

    if($currentDateTime <= $sendcurrentdate){
        $latevalue = "NO";
    }
    else{
        $latevalue = "YES";
    }

    $updateData = "UPDATE payment_records SET pay_date='$databaseFormattedDate', amount='$arrayreceipt[1]',
    balance='0', penalty='0', Receipt_no='$receiptNo', late='$latevalue', confirmation='Not yet', sent_status='sent' WHERE id='".$arrayreceipt[0]."'";
    $executeUpdate = mysqli_query($con, $updateData);

    $insertlandlordNotif = "INSERT INTO landlord_notification (landlord_id, renter_id, property_id, notif_info, notif_date, notif_status) 
    VALUES ('".$getpayrecord['landlord_id']."', '".$getpayrecord['renter_id']."', '".$getpayrecord['property_id']."', 'Receipt', '$databaseFormattedDate', 'unread')";
    $executeInsertLandlordNotif = mysqli_query($con, $insertlandlordNotif);
?>