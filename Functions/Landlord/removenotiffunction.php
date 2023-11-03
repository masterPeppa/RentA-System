<?php
    include('../../DataBase/connection.php');
    $notifvalue = $_POST['notifid'];
    $update_notif="UPDATE landlord_notification SET notif_status='read' WHERE id='$notifvalue'";
    $newnotif_update_executed=mysqli_query($con,$update_notif);

    echo '
<h1 class="l-page-h1">Notifications</h1>
<div class="notif-container mt-3">';

$selectlandlordnotif = "SELECT * FROM landlord_notification WHERE notif_status='unread' ORDER BY notif_date DESC";
$executelandlordnotif = mysqli_query($con, $selectlandlordnotif);
$row_landlordnotif = mysqli_fetch_all($executelandlordnotif, MYSQLI_ASSOC);

for ($i = 0; $i < count($row_landlordnotif); $i++) {
    if ($row_landlordnotif[$i]['notif_info'] == "application") {
        echo '
        <div class="row d-flex align-items-center py-3 border-bottom notification-content">
            <a href="manageApplicants.php?id=' . $row_landlordnotif[$i]['id'] . '" class="a-notif">
                <div class="col-1 ps-2">
                    <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                        <img src="../imgs/application.png" class="landlord-img ms-2" alt="">
                    </div>
                </div>
                <div class="col-10 d-flex flex-column gap-2">
                    <div class="notif-msg ps-3">A potential renter had sent an application. View and process it now.</div>
                    <div class="notif-date ps-3">' . date('m/d/Y', strtotime($row_landlordnotif[$i]['notif_date'])) . '</div>
                </div>
            </a>
            <div class="col-1 d-flex justify-content-end pe-2 ">
                <button type="button" class="btn-close btn-close-logout btnremovenotif" onclick="lremovenotiffunction(this.value)" value="' . $row_landlordnotif[$i]['id'] . '" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        </div>';
    } elseif ($row_landlordnotif[$i]['notif_info'] == "payment") {
        $selectrenter = "SELECT * FROM user_renter WHERE rId='" . $row_landlordnotif[$i]['renter_id'] . "'";
        $executerenterr = mysqli_query($con, $selectrenter);
        $row_renter = mysqli_fetch_assoc($executerenterr);

        echo '
        <div class="row d-flex align-items-center py-3 border-bottom notification-content">
            <a href="manageLeases.php?id=' . $row_landlordnotif[$i]['id'] . '" class="a-notif">
                <div class="col-1 ps-2">
                    <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                        <img src="../imgs/bill-white.png" class="bill-img mt-1" alt="">
                    </div>
                </div>
                <div class="col-10 d-flex flex-column gap-2">
                    <div class="notif-msg ps-3">Renter, ' . $row_renter['rFname'] . ' ' . $row_renter['rLname'] . ' had approved the lease agreement and sent an advance payment. Confirm now.</div>
                    <div class="notif-date ps-3">' . date('m/d/Y', strtotime($row_landlordnotif[$i]['notif_date'])) . '</div>
                </div>
            </a>
            <div class="col-1 d-flex justify-content-end pe-2 ">
                <button type="button" class="btn-close btn-close-logout btnremovenotif" onclick="lremovenotiffunction(this.value)" value="' . $row_landlordnotif[$i]['id'] . '" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        </div>';
    } elseif ($row_landlordnotif[$i]['notif_info'] == "receipt") {
        $selectrenter = "SELECT * FROM user_renter WHERE rId='" . $row_landlordnotif[$i]['renter_id'] . "'";
        $executerenterr = mysqli_query($con, $selectrenter);
        $row_renter = mysqli_fetch_assoc($executerenterr);

        echo '
        <div class="row d-flex align-items-center py-3 border-bottom notification-content">
            <a href="manageResidentsRent.php?id=' . $row_landlordnotif[$i]['id'] . '" class="a-notif">
                <div class="col-1 ps-2">
                    <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                        <img src="../imgs/peso.png" class="peso-img" alt="">
                    </div>
                </div>
                <div class="col-10 d-flex flex-column gap-2">
                    <div class="notif-msg ps-3">Renter, ' . $row_renter['rFname'] . ' ' . $row_renter['rLname'] . ' had paid monthly rent. Confirm receipt now.</div>
                    <div class="notif-date ps-3">' . date('m/d/Y', strtotime($row_landlordnotif[$i]['notif_date'])) . '</div>
                </div>
            </a>
            <div class="col-1 d-flex justify-content-end pe-2 ">
                <button type="button" class="btn-close btn-close-logout btnremovenotif" onclick="lremovenotiffunction(this.value)" value="' . $row_landlordnotif[$i]['id'] . '" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        </div>';
    } elseif ($row_landlordnotif[$i]['notif_info'] == "moved-in") {
        $selectrenter = "SELECT * FROM user_renter WHERE rId='" . $row_landlordnotif[$i]['renter_id'] . "'";
        $executerenterr = mysqli_query($con, $selectrenter);
        $row_renter = mysqli_fetch_assoc($executerenterr);

        echo '
        <div class="row d-flex align-items-center py-3 border-bottom notification-content">
            <a href="manageResidents.php?id=' . $row_landlordnotif[$i]['id'] . '" class="a-notif">
                <div class="col-1 ps-2">
                    <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                        <img src="../imgs/moved.png" class="bill-img" alt="">
                    </div>
                </div>
                <div class="col-10 d-flex flex-column gap-2">
                    <div class="notif-msg ps-3">Renter, ' . $row_renter['rFname'] . ' ' . $row_renter['rLname'] . ' had already moved-in.</div>
                    <div class="notif-date ps-3">' . date('m/d/Y', strtotime($row_landlordnotif[$i]['notif_date'])) . '</div>
                </div>
            </a>
            <div class="col-1 d-flex justify-content-end pe-2 ">
                <button type="button" class="btn-close btn-close-logout btnremovenotif" onclick="lremovenotiffunction(this.value)" value="' . $row_landlordnotif[$i]['id'] . '" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        </div>';
    } elseif ($row_landlordnotif[$i]['notif_info'] == "cancelled") {
        $selectrenter = "SELECT * FROM user_renter WHERE rId='" . $row_landlordnotif[$i]['renter_id'] . "'";
        $executerenterr = mysqli_query($con, $selectrenter);
        $row_renter = mysqli_fetch_assoc($executerenterr);

        echo '
        <div class="row d-flex align-items-center py-3 border-bottom notification-content">
            <a href="manageResidents.php?id=' . $row_landlordnotif[$i]['id'] . '" class="a-notif">
                <div class="col-1 ps-2">
                    <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                        <img src="../imgs/cancel.png" class="bill-img" alt="">
                    </div>
                </div>
                <div class="col-10 d-flex flex-column gap-2">
                    <div class="notif-msg ps-3">Renter, ' . $row_renter['rFname'] . ' ' . $row_renter['rLname'] . ' cancelled the renting application.</div>
                    <div class="notif-date ps-3">' . date('m/d/Y', strtotime($row_landlordnotif[$i]['notif_date'])) . '</div>
                </div>
            </a>
            <div class="col-1 d-flex justify-content-end pe-2 ">
                <button type="button" class="btn-close btn-close-logout btnremovenotif" onclick="lremovenotiffunction(this.value)" value="' . $row_landlordnotif[$i]['id'] . '" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        </div>';
    } 
    else if ($row_landlordnotif[$i]['notif_info'] == "extension") {
        $selectrenter = "SELECT * FROM user_renter WHERE rId='" . $row_landlordnotif[$i]['renter_id'] . "'";
        $executerenterr = mysqli_query($con, $selectrenter);
        $row_renter = mysqli_fetch_assoc($executerenterr);
    
        echo '
        <div class="row d-flex align-items-center py-3 border-bottom notification-content" onclick="sendidfornewlease(this)" data-value="'. $row_landlordnotif[$i]['id'] .'">
            <div class="col-1 ps-2">
                <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                    <img src="../imgs/question-sign.png" class="ag-img" alt="">
                </div>
            </div>
            <div class="col-10 d-flex flex-column gap-2">
                <div class="notif-msg ps-3">  Renter, <span>'. $row_renter['rFname'] . " " . $row_renter['rLname'] . '</span>, wants to renew the contract expiring next month. We need you to settle it. Please click this notification.</div>
                <div class="notif-date ps-3">'. date('m/d/Y', strtotime($row_landlordnotif[$i]['notif_date'])) . '</div>
            </div>
            <div class="col-1 d-flex justify-content-end pe-2 ">
                <button type="button" class="btn-close btn-close-logout btnremovenotif" onclick="lremovenotiffunction(this.value)" value="'. $row_landlordnotif[$i]['id'] .'"  data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        </div>';
    }    
}
?>
