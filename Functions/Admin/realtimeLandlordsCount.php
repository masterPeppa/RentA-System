<?php
include('../../DataBase/connection.php');
session_start();
$select_landlord = "SELECT * FROM user_landlord";
$execute_landlord = mysqli_query($con, $select_landlord);
$count_landlord = mysqli_num_rows($execute_landlord);
echo $count_landlord;
mysqli_close($con);
?>