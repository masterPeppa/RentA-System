<?php
    //logout
    if (isset($_GET['status']) && $_GET['status'] === 'logout') {
        session_destroy();
        header("Location: ../../../RentA");
        exit();
    }
?>