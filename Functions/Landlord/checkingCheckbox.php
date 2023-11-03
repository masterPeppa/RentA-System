<?php
    session_start();
    $checkValue = ucwords($_REQUEST["q"]);
    $_SESSION['checkBoxLength'] = $checkValue;
    // Close the database connection
    mysqli_close($con);
?>