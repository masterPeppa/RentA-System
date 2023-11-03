<?php
include('../../DataBase/connection.php');
$userId = $_POST['userid'];
$iteration = $_POST['iterate'];
$currentValue = $_POST['currentValue'];

$currentiterationcount = $_POST['currentiterationcount'];
$selectadvancepayment = "SELECT * FROM receipt WHERE landlord_id='$userId'";
$executeadvancepayment = mysqli_query($con, $selectadvancepayment);
$getadvancepayment = mysqli_fetch_all($executeadvancepayment, MYSQLI_ASSOC);

    if($getadvancepayment[$iteration]['payment_status'] != $currentValue || $currentiterationcount != count($getadvancepayment)){
        echo "<i class='bi bi-arrow-clockwise'></i><span>Refresh</span>";
    }
    else{
        echo "";
    }
// Close the database connection
mysqli_close($con);
?>