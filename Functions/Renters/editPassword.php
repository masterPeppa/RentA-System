<?php
    include ("../../DataBase/connection.php");
    session_start();
    $rEmail = $_SESSION['rEmail'];
    $getpassinfo = ucwords($_REQUEST["q"]);
    $arraypass = explode("~~>", $getpassinfo);

    $renter_check_email = "SELECT * FROM user_renter WHERE rEmail='$rEmail'";
    $renter_result = mysqli_query($con, $renter_check_email);
    $get_renter_info = mysqli_fetch_assoc($renter_result);
    $existing_renter = mysqli_num_rows($renter_result);

    if ($existing_renter>0){
        if(password_verify($arraypass[0], $get_renter_info['rPass'])){
            $newHashPassword = password_hash($arraypass[1], PASSWORD_DEFAULT);
            $update_password="UPDATE user_renter SET rPass='$newHashPassword' WHERE rEmail='$rEmail'";
            $newPassword_update_executed=mysqli_query($con,$update_password);
            echo "success";
        }
        else{
            echo "failed";
        }
    }
    // Close the database connection
mysqli_close($con);
?>