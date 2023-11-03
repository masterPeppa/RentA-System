<?php
include('../../DataBase/connection.php');
$userId = $_POST['userid'];
$iteration = $_POST['iterate'];
$selectlistpayment = "SELECT * FROM receipt WHERE landlord_id='$userId'";
$executelistpayment = mysqli_query($con, $selectlistpayment);
$getlistpayment = mysqli_fetch_all($executelistpayment, MYSQLI_ASSOC);
for($i = $iteration; $i < count($getlistpayment); $i++){
    if($getlistpayment[$i]['payment_status'] == "Not yet"){
        echo "<div class='p-no-receipt status-red'>
                <span><i class='bi bi-circle-fill pe-1'></i></span>
                <span>No receipt yet</span>
            </div>";
    }
    else if($getlistpayment[$i]['payment_status'] == "sent"){
        echo "<div class='p-paid status-green'>
                <span><i class='bi bi-circle-fill pe-1'></i></span>
                <span>Paid</span>
            </div>";
    }
    else if($getlistpayment[$i]['payment_status'] == "rejected"){
        echo "<div class='p-approved status-red'>
                <span><i class='bi bi-circle-fill pe-1'></i></span>
                <span>Invalid receipt</span>
            </div>";
    }
    else if($getlistpayment[$i]['payment_status'] == "approved"){
        echo "<div class='p-approved status-done'>
                <span><i class='bi bi-circle-fill pe-1'></i></span>
                <span>Approved</span>
            </div>";
    }
    break;
}
// Close the database connection
mysqli_close($con);
?>