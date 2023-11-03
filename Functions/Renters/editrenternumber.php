<?php
    include ("../../DataBase/connection.php");
    session_start();
    $rEmail = $_SESSION['rEmail'];
    $getnumber = ucwords($_REQUEST["q"]);

    $renter_check_email = "SELECT * FROM user_renter WHERE rEmail='$rEmail'";
    $renter_result = mysqli_query($con, $renter_check_email);
    $existing_renter = mysqli_num_rows($renter_result);

    if ($existing_renter>0){
        $update_number="UPDATE user_renter SET rNum='$getnumber' WHERE rEmail='$rEmail'";
        $newnumber_update_executed=mysqli_query($con,$update_number);
    }
    // Close the database connection
mysqli_close($con);
?>