<?php
    include ('../../DataBase/connection.php');
    $user_id = ucwords($_REQUEST["q"]);
    date_default_timezone_set('Asia/Manila');
    $currentDateTime = date('Y-m-d H:i:s');
    $update_status="UPDATE user_landlord SET lStatus='fully-verified', date_verified='$currentDateTime' WHERE lID='$user_id'";
    $newstatus_update_executed=mysqli_query($con,$update_status);
?>