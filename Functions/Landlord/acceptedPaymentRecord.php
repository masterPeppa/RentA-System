
<?php
    include('../../DataBase/connection.php');
    session_start();

    $receiptdata = ucwords($_REQUEST["q"]);

    $selectpayrecord = "SELECT * FROM payment_records WHERE id='$receiptdata'";
    $executepayrecord = mysqli_query($con, $selectpayrecord);
    $getpayrecord = mysqli_fetch_assoc($executepayrecord);

    $selectproperties = "SELECT * FROM landing_properties WHERE propertyID='".$getpayrecord['property_id']."'";
    $executeproperties = mysqli_query($con, $selectproperties);
    $getproperties = mysqli_fetch_assoc($executeproperties);

    $paymentValue = $getpayrecord['amount'] - $getproperties['propertyPrice'];
    $balancevalue = $getpayrecord['balance'];

    $pastdate = $getpayrecord['MonthsRecords'];
    $getDay = date("d", strtotime($pastdate));
    $getMonth = date("m", strtotime($pastdate));
    $getYear = date("Y", strtotime($pastdate));

    $nextMonth = $getMonth + 1;

    if ($nextMonth > 12) {
        $nextMonth = 1;
        $getYear++;
    }
    
    $new_date = date("$getYear-$nextMonth-$getDay");

    if($getpayrecord['balance'] != 0 && $paymentValue > 0){
        $paymentValue = $paymentValue - $getpayrecord['balance'];
        $balancevalue = $paymentValue - $getpayrecord['balance'];
    }

    $updateData = "UPDATE payment_records SET advance='$paymentValue', amount='".$getproperties['propertyPrice']."', balance='$balancevalue', confirmation='confirmed', sent_status='received' WHERE id='$receiptdata'";
    $executeUpdate = mysqli_query($con, $updateData);

    $insertData = "INSERT INTO payment_records (landlord_id, renter_id, property_id, advance, MonthsRecords) 
    VALUES ('".$getpayrecord['landlord_id']."', '".$getpayrecord['renter_id']."', '".$getpayrecord['property_id']."', '$paymentValue', '$new_date')";
    $executeInsert = mysqli_query($con, $insertData);
?>