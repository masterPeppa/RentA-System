<?php
    include('../../DataBase/connection.php');

    $select_admin_notif = "SELECT * FROM admin_notification WHERE notif_status!='read'";
    $execute_admin_notif = mysqli_query($con, $select_admin_notif);
    $count_admin_notif = mysqli_num_rows($execute_admin_notif);

    if($count_admin_notif > 0){
        echo "<span class='position-absolute translate-middle admin-badge text-light'>
        $count_admin_notif
        <span class='visually-hidden'>unread messages</span>
        </span>";
    }
    else if($count_admin_notif > 99){
        echo "<span class='position-absolute translate-middle admin-badge text-light'>
        99+
        <span class='visually-hidden'>unread messages</span>
        </span>";
    }
?>