<?php
    session_start();
    include('../../DataBase/connection.php');
    $delete_query = mysqli_query($con, "DELETE FROM landing_properties WHERE publishing_status='Not yet' AND landlord_id='".$_SESSION['landlordId']."'");
    // Close the database connection
    mysqli_close($con);
?>