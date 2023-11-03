<?php
include('../../DataBase/connection.php');
session_start();
$select_Type = "SELECT * FROM property_types";
$execute_Type = mysqli_query($con, $select_Type);
$count_Type = mysqli_num_rows($execute_Type);
echo $count_Type;
mysqli_close($con);
?>