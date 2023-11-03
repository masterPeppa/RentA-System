<?php
include('../../DataBase/connection.php');
session_start();
$select_properties = "SELECT * FROM landing_properties WHERE publishing_status='Published'";
$execute_properties = mysqli_query($con, $select_properties);
$count_properties = mysqli_num_rows($execute_properties);
echo $count_properties;
mysqli_close($con);
?>