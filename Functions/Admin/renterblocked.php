<?php
    include ('../../DataBase/connection.php');
    $user_id = ucwords($_REQUEST["q"]);
    $arrayrenterinfo = explode("~~>", $user_id);
    date_default_timezone_set('Asia/Manila');
    $currentDateTime = new DateTime();
    $databaseFormattedDate = $currentDateTime->format('Y-m-d');

    $update_status="UPDATE user_renter SET rStatus='blocked', blocked_reason='{$arrayrenterinfo[1]}', date_blocked='$databaseFormattedDate' WHERE rId='".$arrayrenterinfo[0]."'";
    $newstatus_update_executed=mysqli_query($con,$update_status);
    $delete_query = mysqli_query($con, "DELETE FROM application_data WHERE renter_id='$user_id'");
    $delete_query1 = mysqli_query($con, "DELETE FROM lease WHERE renter_id='$user_id'");
?>