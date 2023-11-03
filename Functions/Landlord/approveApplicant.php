<?php
include('../../DataBase/connection.php');
session_start();

$renterId = $_GET['renter'];

$updateApplicationdata = "UPDATE application_data SET send_status='2' WHERE renter_id='$renterId' AND send_status='1'";
$executeapplicationdata = mysqli_query($con, $updateApplicationdata);
if ($executeapplicationdata) {
    echo "<script>window.location.href = '../../landlordPage/manageLeases.php';</script>";
} 
else {
    echo "<script>alert(Update failed:". mysqli_error($con).")</script>";
}
mysqli_close($con);
?>