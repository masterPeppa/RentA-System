<?php
include ('../../DataBase/connection.php');
session_start();
$landlordEmail = $_SESSION['lEmail'];
$selectUser = "SELECT * FROM user_landlord WHERE lEmail	='$landlordEmail'";
$executeSelectUser = mysqli_query($con, $selectUser);
$lgetId = mysqli_fetch_assoc($executeSelectUser);
if($lgetId['lStatus'] == "fully-verified"){
    echo "done";
}
else{
    echo "not_yet";
}
?>