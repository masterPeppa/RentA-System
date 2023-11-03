<?php
include('../../DataBase/connection.php');
session_start();

    $userId = $_POST['userid'];

    $select_notification = "SELECT * FROM renter_notification WHERE renter_id='$userId' AND notif_status='unread'";
                        $execute_notification = mysqli_query($con, $select_notification);
                        $count_notification = mysqli_num_rows($execute_notification);

    if($count_notification > 99){
        echo "Notification <span class='badge message-badge text-dark d-flex align-items-center justify-content-center'>99+</span>";
    }
    else if($count_notification > 0){
        echo "Notification <span class='badge message-badge text-dark d-flex align-items-center justify-content-center'>$count_notification</span>";
    }
    else{
        echo "Notification";
    }
// Close the database connection
mysqli_close($con);
?>