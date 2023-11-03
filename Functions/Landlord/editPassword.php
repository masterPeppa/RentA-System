<?php
    include ("../../DataBase/connection.php");
    session_start();
    $lEmail = $_SESSION['lEmail'];
    $getpassinfo = ucwords($_REQUEST["q"]);
    $arraypass = explode("~~>", $getpassinfo);

    $landlord_check_email = "SELECT * FROM user_landlord WHERE lEmail='$lEmail'";
    $landlord_result = mysqli_query($con, $landlord_check_email);
    $get_landlord_info = mysqli_fetch_assoc($landlord_result);
    $existing_landlord = mysqli_num_rows($landlord_result);

    if ($existing_landlord>0){
        if(password_verify($arraypass[0], $get_landlord_info['lPassword'])){
            $newHashPassword = password_hash($arraypass[1], PASSWORD_DEFAULT);
            $update_password="UPDATE user_landlord SET lPassword='$newHashPassword' WHERE lEmail='$lEmail'";
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