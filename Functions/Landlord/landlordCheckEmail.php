<?php
	//Connection of database
    include('../../DataBase/connection.php');
    //getting the email address in textbox
	$checkingEmail = ucwords($_REQUEST["q"]);
    //Checking data base if the Email is already in data base of renters
    $rSelect_Query = "SELECT * FROM user_renter WHERE rEmail='$checkingEmail'";
    $rResult = mysqli_query($con, $rSelect_Query);
    $rCheckExistence = mysqli_num_rows($rResult);
    //Checking data base if the Email is already in data base of Landlords
    $lSelect_Query = "SELECT * FROM user_landlord WHERE lEmail='$checkingEmail'";
    $lResult = mysqli_query($con, $lSelect_Query);
    $lCheckExistence = mysqli_num_rows($lResult);
    if($rCheckExistence > 0){
        $row_data = mysqli_fetch_assoc($rResult);
        $email = $row_data['rEmail'];
        echo "$email";
    }
    else if($lCheckExistence > 0){
        $row_data = mysqli_fetch_assoc($lResult);
        $email = $row_data['lEmail'];
        echo "$email";
    }
    // Close the database connection
    mysqli_close($con);
?>