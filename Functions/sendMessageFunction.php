<?php
    session_start();
    include('../DataBase/connection.php');

    if(isset($_SESSION['rEmail'])){

    $sender = $_POST["sender"];
    $receiver = $_POST["receiver"];
    $message = $_POST["message"];
    $identification = $_POST['identification'];

    date_default_timezone_set('Asia/Manila');
    $sent_time = date("Y-m-d H:i:s");
    
    $seen_time = date("H:i:s");


    if($message != ""){
        $insertMessage = "INSERT INTO users_messages (sender, receiver, message, date_sent, date_seen, sent_status, receive_status) VALUES ('$sender','$receiver','".mysqli_real_escape_string($con, $message)."', '$sent_time', '$seen_time', 'sent', 'unread')";
        $executeInsert = mysqli_query($con, $insertMessage);

        $selectConnection = "SELECT * FROM conectivity_status WHERE (landlord_id='$sender' AND renter_id='$receiver') OR (landlord_id='$receiver' AND renter_id='$sender')";
        $executeConnection = mysqli_query($con, $selectConnection);
        $getConnection = mysqli_num_rows($executeConnection);

        if($getConnection == 0 && $identification == "renter"){
            $insertConnection = "INSERT INTO conectivity_status (renter_id, landlord_id) VALUES ('$sender','$receiver')";
            $executeInsert = mysqli_query($con, $insertConnection);
        }
    }
}
else if(isset($_SESSION['lEmail'])){

    $sender = $_POST["sender"];
    $receiver = $_POST["receiver"];
    $message = $_POST["message"];
    $identification = $_POST['identification'];
    
    date_default_timezone_set('Asia/Manila');
    $sent_time = date("Y-m-d H:i:s");
    $seen_time = date("H:i:s");


    if($message != ""){
        $insertMessage = "INSERT INTO users_messages (sender, receiver, message, date_sent, date_seen, sent_status, receive_status) VALUES ('$sender','$receiver','$message', '$sent_time', '$seen_time', 'unsent', 'read')";
        $executeInsert = mysqli_query($con, $insertMessage);

        $selectConnection = "SELECT * FROM conectivity_status WHERE (landlord_id='$sender' AND renter_id='$receiver') OR (landlord_id='$receiver' AND renter_id='$sender')";
        $executeConnection = mysqli_query($con, $selectConnection);
        $getConnection = mysqli_num_rows($executeConnection);

        if($getConnection == 0 && $identification == "landlord"){
            $insertConnection = "INSERT INTO conectivity_status (landlord_id, renter_id) VALUES ('$sender','$receiver')";
            $executeInsert = mysqli_query($con, $insertConnection);
        }
    }
}
// Close the database connection
mysqli_close($con);
?>