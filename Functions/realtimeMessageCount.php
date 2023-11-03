<?php
include('../DataBase/connection.php');
session_start();

if(isset($_SESSION['lEmail'])){
    $userId = $_POST['userid'];

    $select_message = "SELECT * FROM users_messages WHERE receiver='$userId' AND receive_status='unread'";
                        $execute_message = mysqli_query($con, $select_message);
                        $count_message = mysqli_num_rows($execute_message);

    if($count_message > 0){
        echo "Message <span class='badge message-badge text-dark d-flex align-items-center justify-content-center'>$count_message</span>";
    }
    else{
        echo "Message";
    }
}
else if(isset($_SESSION['rEmail'])){
    $userId = $_POST['userid'];

    $select_message = "SELECT * FROM users_messages WHERE receiver='$userId' AND sent_status='unsent'";
                        $execute_message = mysqli_query($con, $select_message);
                        $count_message = mysqli_num_rows($execute_message);

    if($count_message > 0){
        echo "Message <span class='badge message-badge text-dark d-flex align-items-center justify-content-center'>$count_message</span>";
    }
    else{
        echo "Message";
    }
}
// Close the database connection
mysqli_close($con);
?>