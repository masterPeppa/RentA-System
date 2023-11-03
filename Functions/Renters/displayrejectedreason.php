<?php
include('../../DataBase/connection.php');
session_start();

$paymentid = $_POST['paymentid'];

$selectnotif = "SELECT * FROM renter_notification WHERE id='$paymentid'";
$executenotif = mysqli_query($con, $selectnotif);
$getnotif = mysqli_fetch_assoc($executenotif);

$selectpayment = "SELECT * FROM payment_records WHERE id='".$getnotif['payment_id']."'";
$executepayment = mysqli_query($con, $selectpayment);
$getpayment = mysqli_fetch_assoc($executepayment);

echo $getpayment['rejected_reason'];
// Close the database connection
mysqli_close($con);
?>