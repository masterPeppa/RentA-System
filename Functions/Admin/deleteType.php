<?php
    include('../../DataBase/connection.php');
    $typeId = $_REQUEST["q"];
    $delete_query = mysqli_query($con, "DELETE FROM property_types WHERE id='$typeId'");
    echo $typeId;
    // Close the database connection
    mysqli_close($con);
?>