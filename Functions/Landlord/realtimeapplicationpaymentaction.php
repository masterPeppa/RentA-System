<?php
include('../../DataBase/connection.php');
$userId = $_POST['userid'];
$iteration = $_POST['iterate'];
$renterId = $_POST['renterId'];
$dateid = $_POST['dateId'];

$selectlistpayment = "SELECT * FROM receipt WHERE landlord_id='$userId'";
$executelistpayment = mysqli_query($con, $selectlistpayment);
$getlistpayment = mysqli_fetch_all($executelistpayment, MYSQLI_ASSOC);
for($i = $iteration; $i < count($getlistpayment); $i++){
    if($getlistpayment[$i]['payment_status'] == "sent"){
        echo "<a href='proof.php?rentid=$renterId&date=$dateid' class='btn btns-manage-applicants px-1 py-2 d-flex align-items-center justify-content-center' role='button'>
                <i class='bi bi-check-lg actionIcon pe-1'></i>
                <span>Approve receipt</span>
            </a>";
    }
    else if($getlistpayment[$i]['payment_status'] == "approved"){
        echo "<a href='proofApproved.php?rentid=$renterId&date=$dateid' class='btn btns-manage-applicants px-1 py-2 d-flex align-items-center justify-content-center' role='button'>
                <i class='bi bi-receipt actionIcon pe-1'></i>
                <span>View Receipt</span>
            </a>";
    }
    else if($getlistpayment[$i]['payment_status'] == "rejected"){
        echo "<a href='proofApproved.php' class='btn btns btn-del px-1 py-2 d-flex align-items-center justify-content-center' role='button'>
                <i class='bi bi-send-plus actionIcon pe-1'></i>
                <span>Request new</span>
            </a>";
    }
    else{
        echo "<div class='btn btns px-1 py-2 d-flex align-items-center justify-content-center'> Waiting... </div>";
    }
    break;
}
// Close the database connection
mysqli_close($con);
?>