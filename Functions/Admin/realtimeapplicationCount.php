<?php
include('../../DataBase/connection.php');
session_start();
$select_application = "SELECT * FROM application_data";
$execute_application = mysqli_query($con, $select_application);
$count_application = mysqli_num_rows($execute_application);
echo $count_application;
mysqli_close($con);
?>