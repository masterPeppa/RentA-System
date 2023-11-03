<?php
    include('../../DataBase/connection.php');
    $userId = $_POST['userid'];
    $renterId = $_POST['renterId'];

    if($renterId != ""){
        date_default_timezone_set('Asia/Manila');
        $created_Time = date("Y-m-d H:i:s");

        $insertAdminNotif = "INSERT INTO renter_notification (landlord_id, renter_id, notif_info, notif_date, notif_status) VALUES ('$userId', '$renterId', 'Request-new-payment', '$created_Time', 'unread')";
        $executeInsertAdminNotif = mysqli_query($con, $insertAdminNotif);

        $updateApplicationdata = "UPDATE application_data SET send_status='3' WHERE renter_id='$renterId' AND landlord_id='$userId'";
        $executeapplicationdata = mysqli_query($con, $updateApplicationdata);

        $updatelease= "UPDATE lease SET lease_status='for-signing' WHERE renter_id='$renterId' AND landlord_id='$userId'";
        $executelease = mysqli_query($con, $updatelease);

        $delete_query = mysqli_query($con, "DELETE FROM receipt WHERE landlord_id = '$userId' AND renter_id = '$renterId' ");

        echo "success";
    }
?>
