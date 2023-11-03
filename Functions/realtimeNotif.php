<?php
include('../DataBase/connection.php');
session_start();

if(isset($_SESSION['lEmail'])){
    $userId = $_POST['userid'];

    $select_message = "SELECT * FROM users_messages WHERE receiver='$userId' AND receive_status='unread'";
    $execute_message = mysqli_query($con, $select_message);
    $count_message = mysqli_num_rows($execute_message);

    $select_notification = "SELECT * FROM landlord_notification WHERE landlord_id='$userId' AND notif_status='unread'";
    $execute_notification = mysqli_query($con, $select_notification);
    $count_notification = mysqli_num_rows($execute_notification);

    if($count_message > 0 || $count_notification > 0){
        echo "<span class='position-absolute top-0 p-2 rounded-circle notif-badge'>
                <span class='visually-hidden'>Notif alerts</span>
            </span>";
    }
    else{
        echo "";
    }
}
else if(isset($_SESSION['rEmail'])){
    $userId = $_POST['userid'];

    $select_message = "SELECT * FROM users_messages WHERE receiver='$userId' AND sent_status='unsent'";
                        $execute_message = mysqli_query($con, $select_message);
                        $count_message = mysqli_num_rows($execute_message);

    $select_notification = "SELECT * FROM renter_notification WHERE renter_id='$userId' AND notif_status='unread'";
    $execute_notification = mysqli_query($con, $select_notification);
    $count_notification = mysqli_num_rows($execute_notification);

    if($count_message > 0 || $count_notification > 0){
        echo "<span class='position-absolute top-0 p-2 rounded-circle notif-badge'>
                <span class='visually-hidden'>Notif alerts</span>
            </span>";
    }

    else{
        echo "";
    }
}
// Close the database connection
mysqli_close($con);
?>