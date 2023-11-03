<?php
    include ('../../DataBase/connection.php');
    $user_id = ucwords($_REQUEST["q"]);
    $arraylanlordinfo = explode("~~>", $user_id);
    date_default_timezone_set('Asia/Manila');

    $currentDateTime = new DateTime();
    $databaseFormattedDate = $currentDateTime->format('Y-m-d');

    $update_status="UPDATE user_landlord SET lStatus='blocked', rejected_reason='{$arraylanlordinfo[1]}', date_blocked='$databaseFormattedDate' WHERE lID='".$arraylanlordinfo[0]."'";
    $newstatus_update_executed=mysqli_query($con,$update_status);

    $update_status_property="UPDATE landing_properties SET occular_visit_status='blocked' WHERE landlord_id='$user_id'";
    $newstatus_update_executed_property=mysqli_query($con,$update_status_property);
?>