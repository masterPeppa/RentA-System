<?php
    include ("../../DataBase/connection.php");
    session_start();
    $rEmail = $_SESSION['rEmail'];
    $getnameinfo = ucwords($_REQUEST["q"]);
    $arrayname = explode("~~>", $getnameinfo);

    $renter_check_email = "SELECT * FROM user_renter WHERE rEmail='$rEmail'";
    $renter_result = mysqli_query($con, $renter_check_email);
    $existing_renter = mysqli_num_rows($renter_result);

    if ($existing_renter>0){
        $update_name="UPDATE user_renter SET rFname='$arrayname[0]', rLname='$arrayname[1]' WHERE rEmail='$rEmail'";
        $newname_update_executed=mysqli_query($con,$update_name);
    }
    // Close the database connection
mysqli_close($con);
?>