<?php
    session_start();
    include('../../DataBase/connection.php');
    $delete_query = mysqli_query($con, "DELETE FROM application_data WHERE send_status='0' AND renter_id='".$_SESSION['renterId']."'");
    // Close the database connection
    mysqli_close($con);
?>