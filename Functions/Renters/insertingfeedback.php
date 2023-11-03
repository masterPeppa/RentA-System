<?php
    session_start();
    include ('../../DataBase/connection.php');

    $feedbackData = $_REQUEST["q"];
    $arrayfeedback = explode("~~>", $feedbackData);

    $comment_date = date("Y-m-d");
    
    $insertData = "INSERT INTO feedback_data (renter_id, property_id, landlord_id, cleanliness, communication, accuracy, proplocation, comment, commentdate) 
    VALUES ('$arrayfeedback[6]', '$arrayfeedback[7]', '$arrayfeedback[5]', '$arrayfeedback[0]', '$arrayfeedback[1]', '$arrayfeedback[2]', '$arrayfeedback[3]', '".mysqli_real_escape_string($con, $arrayfeedback[4])."', '$comment_date')";
    $executeInsert = mysqli_query($con, $insertData);

    echo "../viewProperty.php?id=".$arrayfeedback[7];
?>