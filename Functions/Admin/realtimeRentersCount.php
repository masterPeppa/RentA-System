<?php
include('../../DataBase/connection.php');
session_start();
$select_renter = "SELECT * FROM user_renter";
$execute_renter = mysqli_query($con, $select_renter);
$count_renter = mysqli_num_rows($execute_renter);
echo $count_renter;
mysqli_close($con);
?>