<?php
include('../../DataBase/connection.php');
session_start();

if(isset($_SESSION['rEmail'])){
    $userId = $_POST['userid'];

    $select_data = "SELECT * FROM application_data WHERE renter_id='$userId' AND receive_status='sent'";
                        $execute_data = mysqli_query($con, $select_data);
                        $count_data = mysqli_num_rows($execute_data);

    if($count_data == 0){
        echo "";
    }
    else{
        echo "<span class='position-absolute top-0 translate-middle badge app-badge'>
                <span><i class='bi bi-bell'></i></span>
                <span class='visually-hidden'>application notif</span>
            </span>";
    }
}
// Close the database connection
mysqli_close($con);
?>