<?php
include('../../DataBase/connection.php');
session_start();

$notifid = $_POST['notifid'];

$selectnotif = "SELECT * FROM renter_notification WHERE id='$notifid'";
$executenotif = mysqli_query($con, $selectnotif);
$getnotif = mysqli_fetch_assoc($executenotif);

$selectlease = "SELECT * FROM lease WHERE renter_id='".$getnotif['renter_id']."' AND lease_status='residing'";
$executelease = mysqli_query($con, $selectlease);
$getlease = mysqli_fetch_assoc($executelease);

echo $getlease['rejected_new_lease'];
// Close the database connection
mysqli_close($con);
?>