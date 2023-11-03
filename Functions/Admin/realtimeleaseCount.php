<?php
include('../../DataBase/connection.php');
session_start();
$select_lease = "SELECT * FROM lease";
$execute_lease = mysqli_query($con, $select_lease);
$count_lease = mysqli_num_rows($execute_lease);
echo $count_lease;
mysqli_close($con);
?>