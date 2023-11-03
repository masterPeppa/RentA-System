<?php
    include ("../../DataBase/connection.php");
    session_start();
    $lEmail = $_SESSION['lEmail'];
    $getnumber = ucwords($_REQUEST["q"]);

    $landlord_check_email = "SELECT * FROM user_landlord WHERE lEmail='$lEmail'";
    $landlord_result = mysqli_query($con, $landlord_check_email);
    $existing_landlord = mysqli_num_rows($landlord_result);

    if ($existing_landlord>0){
        $update_number="UPDATE user_landlord SET lNumber='$getnumber' WHERE lEmail='$lEmail'";
        $newnumber_update_executed=mysqli_query($con,$update_number);
    }
    // Close the database connection
mysqli_close($con);
?>