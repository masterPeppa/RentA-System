<?php
include('../../DataBase/connection.php');
session_start();

    $userId = $_POST['userid'];
    $currentCount = $_POST['currentCount'];

    $select_applicationn = "SELECT * FROM application_data WHERE landlord_id='$userId' AND send_status='1'";
    $execute_applicationn = mysqli_query($con, $select_applicationn);
    $count_application = mysqli_num_rows($execute_applicationn);

    if($count_application > $currentCount){
        echo "<i class='bi bi-arrow-clockwise'></i>
        <span>Refresh</span>";
    }
// Close the database connection
mysqli_close($con);
?>