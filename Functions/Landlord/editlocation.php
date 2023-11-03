<?php
    include ("../../DataBase/connection.php");
    session_start();
    $lEmail = $_SESSION['lEmail'];
    $getlocationinfo = ucwords($_REQUEST["q"]);
    $arraylocation = explode("~~>", $getlocationinfo);
    
    $region = $arraylocation[0];
    $province = $arraylocation[1];
    $city = $arraylocation[2];
    $barangay = $arraylocation[3];
    $houseno = $arraylocation[4];

    $landlord_check_email = "SELECT * FROM user_landlord WHERE lEmail='$lEmail'";
    $landlord_result = mysqli_query($con, $landlord_check_email);
    $existing_landlord = mysqli_num_rows($landlord_result);

    if ($existing_landlord>0){
        $update_location="UPDATE user_landlord SET lRegion='$region', lProvince='$province', lCity='$city',
        lBrgy='$barangay', lHouseNo='$houseno' WHERE lEmail='$lEmail'";
        $newlocation_update_executed=mysqli_query($con,$update_location);
    }
    // Close the database connection
mysqli_close($con);
?>