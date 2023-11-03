<?php
include('../../DataBase/connection.php');
$userId = $_POST['userid'];
$iteration = $_POST['iterate'];
$currentValue = $_POST['currentValue'];
$currentiterationcount = $_POST['currentiterationcount'];
$selectlistlease = "SELECT * FROM lease WHERE landlord_id='$userId'";
$executelistlease = mysqli_query($con, $selectlistlease);
$getlistlease = mysqli_fetch_all($executelistlease, MYSQLI_ASSOC);

if($getlistlease[$iteration]['lease_status'] != $currentValue  || $currentiterationcount != count($getlistlease)){
    echo "<i class='bi bi-arrow-clockwise'></i><span>Refresh</span>";
}
else{
    echo "";
}
// Close the database connection
mysqli_close($con);
?>