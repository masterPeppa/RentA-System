<?php
    include ('../../DataBase/connection.php');
    $user_id = ucwords($_REQUEST["q"]);
    $arraylanlordinfo = explode("~~>", $user_id);
    $delete_query = mysqli_query($con, "DELETE FROM verification_document WHERE user_id='".$arraylanlordinfo[0]."'");
    $update_status="UPDATE user_landlord SET lStatus='rejected', rejected_reason='".mysqli_real_escape_string($con, $arraylanlordinfo[1])."' WHERE lID='".$arraylanlordinfo[0]."'";
    $newstatus_update_executed=mysqli_query($con,$update_status);
?>