<?php
    include ("../DataBase/connection.php");
    session_start();
    $userEmail = $_SESSION['userEmail'];
    $newPassword = $_POST['confirm_new_pass'];
    $newHashPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    
    $renter_check_email = "SELECT * FROM user_renter WHERE rEmail='$userEmail'";
    $renter_result = mysqli_query($con, $renter_check_email);
    $existing_renter=mysqli_num_rows($renter_result);

    if ($existing_renter>0){
        $update_password="UPDATE user_renter SET rPass='$newHashPassword' WHERE rEmail='$userEmail'";
        $newPassword_update_executed=mysqli_query($con,$update_password);
        header("Location: ../loginPage.php");
    }
    // Close the database connection
mysqli_close($con);
?>