<?php
    include ("../../DataBase/connection.php");
    session_start();
    $lEmail = $_SESSION['lEmail'];
    $getnameinfo = ucwords($_REQUEST["q"]);
    $arrayname = explode("~~>", $getnameinfo);

    $landlord_check_email = "SELECT * FROM user_landlord WHERE lEmail='$lEmail'";
    $landlord_result = mysqli_query($con, $landlord_check_email);
    $existing_landlord = mysqli_num_rows($landlord_result);

    if ($existing_landlord>0){
        $update_name="UPDATE user_landlord SET lFname='$arrayname[0]', lLname='$arrayname[1]' WHERE lEmail='$lEmail'";
        $newname_update_executed=mysqli_query($con,$update_name);
    }
    // Close the database connection
mysqli_close($con);
?>