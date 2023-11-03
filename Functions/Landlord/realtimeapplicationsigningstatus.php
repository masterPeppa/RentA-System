<?php
include('../../DataBase/connection.php');
$userId = $_POST['userid'];
$iteration = $_POST['iterate'];
$selectlistlease = "SELECT * FROM lease WHERE landlord_id='$userId'";
$executelistlease = mysqli_query($con, $selectlistlease);
$getlistlease = mysqli_fetch_all($executelistlease, MYSQLI_ASSOC);
for($i = $iteration; $i < count($getlistlease); $i++){
    if($getlistlease[$i]['lease_status'] == "for-signing"){
        echo "<div class='l-for-signing status-purple'>
                <span><i class='bi bi-circle-fill pe-1'></i></span>
                <span>For Signing</span>
            </div>";
    }
    else if($getlistlease[$i]['lease_status'] == "signed"){
        echo "<div class='l-signed status-done'>
                <span><i class='bi bi-circle-fill pe-1'></i></span>
                <span>Signed</span>
            </div>";
    }
    break;
}

if(count($getlistlease) == 0){
    echo "<div class='l-no-lease status-red'>
            <span><i class='bi bi-circle-fill pe-1'></i></span>
            <span>No lease yet</span>
            </div>";
}
// Close the database connection
mysqli_close($con);
?>