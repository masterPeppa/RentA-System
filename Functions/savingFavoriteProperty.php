<?php
    include('../DataBase/connection.php');
    session_start();
    if(isset($_SESSION['lEmail'])){
        $user = $_SESSION['lEmail'];
        //Checking data base if the Email is already in data base of Landlords
        $user_query = "SELECT * FROM user_landlord WHERE lEmail='$user'";
        $user_execute = mysqli_query($con, $user_query);
        $userInfo = mysqli_fetch_assoc($user_execute);

        $userID = "l" . $userInfo['lID'];
    }
    else if(isset($_SESSION['rEmail'])){
        $user = $_SESSION['rEmail'];
        //Checking data base if the Email is already in data base of renters
        $user_query = "SELECT * FROM user_renter WHERE rEmail='$user'";
        $user_execute = mysqli_query($con, $user_query);
        $userInfo = mysqli_fetch_assoc($user_execute);

        $userID = "r" . $userInfo['rId'];
    }
    //getting the value of q its either prop id or unsave
    $SaveValue = ucwords($_REQUEST["q"]);
    $Saved_Time = date("Y-m-d H:i:s");

    if($SaveValue == "Unsave"){
        //get the id of property if the value of q is "Unsave"
        $propid = ucwords($_REQUEST["v"]);
        $delete_query = "DELETE FROM user_favorites WHERE user_id='$userID' AND favorite_id='$propid'";
        $delete_execute = mysqli_query($con, $delete_query);
    }
    else{
        $insertFavorite = "INSERT INTO user_favorites (user_id, favorite_id, saved_date) VALUES ('$userID', '$SaveValue', '$Saved_Time')";
        $executeFavorite = mysqli_query($con, $insertFavorite);
    }
    // Close the database connection
mysqli_close($con);
?>