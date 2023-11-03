<?php
include('../../DataBase/connection.php');
$notifId = $_POST["notifid"];
$update_notif="UPDATE admin_notification SET notif_status='read' WHERE id = '$notifId'";
$newnotif_update_executed=mysqli_query($con,$update_notif);
?>

<h1 class="admin-page-h1 text-center">Notifications</h1>
<div class="notif-container mt-5">
    <?php
    $selectadminnotif = "SELECT * FROM admin_notification WHERE notif_status='unread' ORDER BY date_notif DESC";
    $executeadminnotif = mysqli_query($con, $selectadminnotif);
    $row_adminnotif = mysqli_fetch_all($executeadminnotif, MYSQLI_ASSOC);
    for ($i = 0; $i < count($row_adminnotif); $i++) {
        if ($row_adminnotif[$i]['notif_info'] == "Landlord-Register") {
            $selectlandlord = "SELECT * FROM user_landlord WHERE lID='" . $row_adminnotif[$i]['landlord_id'] . "'";
            $executelandlord = mysqli_query($con, $selectlandlord);
            $row_landlord = mysqli_fetch_assoc($executelandlord);
            echo "<a href='adminVerifyId.php?id=" . $row_adminnotif[$i]['landlord_id'] . "&notifid=" . $row_adminnotif[$i]['id'] . "'>";
            echo "<div class='row d-flex align-items-center py-3 border-bottom notification-content'>";
            echo "<div class='col-1 ps-2'>";
            echo "<div class='notif-circle rounded-circle d-flex align-items-center justify-content-center'>";
            echo "<img src='../imgs/admin/landlord.png' class='landlord-img' alt=''>";
            echo "</div>";
            echo "</div>";
            echo "<div class='col-10 d-flex flex-column gap-2'>";
            echo "<div class='notif-msg ps-3'>Landlord, <b>" . $row_landlord['lFname'] . " " . $row_landlord['lLname'] . "</b> had registered. Please verify his/her identity so that he/she can already list a property.</div>";
            echo "<div class='notif-date ps-3'>" . date('m/d/Y', strtotime($row_adminnotif[$i]['date_notif'])) . "</div>";
            echo "</div>";
            echo "<div class='col-1 d-flex justify-content-end pe-2'>";
            echo "<button type='button' class='btn-close btn-close-logout' data-bs-dismiss='modal' aria-label='Close'></button>";
            echo "</div>";
            echo "</div>";
            echo "</a>";
        } elseif ($row_adminnotif[$i]['notif_info'] == "List-Property") {
            $selectlandlord = "SELECT * FROM user_landlord WHERE lID='" . $row_adminnotif[$i]['landlord_id'] . "'";
            $executelandlord = mysqli_query($con, $selectlandlord);
            $row_landlord = mysqli_fetch_assoc($executelandlord);
            echo "<a href='../viewProperty.php?id=" . $row_adminnotif[$i]['property_id'] . "&notifid=" . $row_adminnotif[$i]['id'] . "'>";
            echo "<div class='row d-flex align-items-center py-3 border-bottom notification-content'>";
            echo "<div class='col-1 ps-2'>";
            echo "<div class='notif-circle rounded-circle d-flex align-items-center justify-content-center'>";
            echo "<img src='../imgs/admin/properties.png' class='notif-img' alt=''>";
            echo "</div>";
            echo "</div>";
            echo "<div class='col-10 d-flex flex-column gap-2'>";
            echo "<div class='notif-msg ps-3'>Landlord, <b>" . $row_landlord['lFname'] . " " . $row_landlord['lLname'] . "</b>, had listed a property. Please review and approve to display it in the website.</div>";
            echo "<div class='notif-date ps-3'>" . date('m/d/Y', strtotime($row_adminnotif[$i]['date_notif'])) . "</div>";
            echo "</div>";
            echo "<div class='col-1 d-flex justify-content-end pe-2'>";
            echo "<button type='button' class='btn-close btn-close-logout' data-bs-dismiss='modal' aria-label='Close'></button>";
            echo "</div>";
            echo "</div>";
            echo "</a>";
        } elseif ($row_adminnotif[$i]['notif_info'] == "Renter-Register") {
            $selectrenter = "SELECT * FROM user_renter WHERE rId='" . $row_adminnotif[$i]['renter_id'] . "'";
            $executerenter = mysqli_query($con, $selectrenter);
            $row_renter = mysqli_fetch_assoc($executerenter);
            echo "<div class='row d-flex align-items-center py-3 border-bottom notification-content'>";
            echo "<a href='adminRenterInfo.php?id=" . $row_adminnotif[$i]['renter_id'] . "&notifid=" . $row_adminnotif[$i]['id'] . "'>";
            echo "<div class='col-1 ps-2'>";
            echo "<div class='notif-circle rounded-circle d-flex align-items-center justify-content-center'>";
            echo "<img src='../imgs/admin/renters.png' class='landlord-img' alt=''>";
            echo "</div>";
            echo "</div>";
            echo "<div class='col-10 d-flex flex-column gap-2'>";
            echo "<div class='notif-msg ps-3'>A new renter, <b>" . $row_renter['rFname'] . " " . $row_renter['rLname'] . "</b>, has recently completed their registration.</div>";
            echo "<div class='notif-date ps-3'>" . date('m/d/Y', strtotime($row_adminnotif[$i]['date_notif'])) . "</div>";
            echo "</div>";
            echo "</a>";
            echo "<div class='col-1 d-flex justify-content-end pe-2'>";
            echo "<button type='button' class='btn-close btn-close-logout btnRemoveNotif' value='" . $row_adminnotif[$i]['id'] . "' onclick='removeNotification(this.value)'></button>";
            echo "</div>";
            echo "</div>";
        } elseif ($row_adminnotif[$i]['notif_info'] == "Application") {
            echo "<a href='adminApplications.php?notifid=" . $row_adminnotif[$i]['id'] . "'>";
            echo "<div class='row d-flex align-items-center py-3 border-bottom notification-content'>";
            echo "<div class='col-1 ps-2'>";
            echo "<div class='notif-circle rounded-circle d-flex align-items-center justify-content-center'>";
            echo "<img src='../imgs/admin/applicants.png' class='landlord-img' alt=''>";
            echo "</div>";
            echo "</div>";
            echo "<div class='col-10 d-flex flex-column gap-2'>";
            echo "<div class='notif-msg ps-3'>A renter had applied to one of the properties. View status.</div>";
            echo "<div class='notif-date ps-3'>" . date('m/d/Y', strtotime($row_adminnotif[$i]['date_notif'])) . "</div>";
            echo "</div>";
            echo "<div class='col-1 d-flex justify-content-end pe-2'>";
            echo "<button type='button' class='btn-close btn-close-logout' data-bs-dismiss='modal' aria-label='Close'></button>";
            echo "</div>";
            echo "</div>";
            echo "</a>";
        } elseif ($row_adminnotif[$i]['notif_info'] == "Lease") {
            echo "<a href='adminLeases.php?notifid=" . $row_adminnotif[$i]['id'] . "'>";
            echo "<div class='row d-flex align-items-center py-3 border-bottom notification-content'>";
            echo "<div class='col-1 ps-2'>";
            echo "<div class='notif-circle rounded-circle d-flex align-items-center justify-content-center'>";
            echo "<img src='../imgs/admin/leases.png' class='lease-img' alt=''>";
            echo "</div>";
            echo "</div>";
            echo "<div class='col-10 d-flex flex-column gap-2'>";
            echo "<div class='notif-msg ps-3'>A lease & advance payment agreement was settled. View now.</div>";
            echo "<div class='notif-date ps-3'>" . date('m/d/Y', strtotime($row_adminnotif[$i]['date_notif'])) . "</div>";
            echo "</div>";
            echo "<div class='col-1 d-flex justify-content-end pe-2'>";
            echo "<button type='button' class='btn-close btn-close-logout' data-bs-dismiss='modal' aria-label='Close'></button>";
            echo "</div>";
            echo "</div>";
            echo "</a>";
        } elseif ($row_adminnotif[$i]['notif_info'] == "Complaints") {
            echo "<a href='#'>";
            echo "<div class='row d-flex align-items-center py-3 border-bottom notification-content'>";
            echo "<div class='col-1 ps-2'>";
            echo "<div class='notif-circle rounded-circle d-flex align-items-center justify-content-center'>";
            echo "<img src='../imgs/admin/report.png' class='warning-img' alt=''>";
            echo "</div>";
            echo "</div>";
            echo "<div class='col-10 d-flex flex-column gap-2'>";
            echo "<div class='notif-msg ps-3'>A renter has sent a complaint to a landlord. Take Action.</div>";
            echo "<div class='notif-date ps-3'>" . date('m/d/Y', strtotime($row_adminnotif[$i]['date_notif'])) . "</div>";
            echo "</div>";
            echo "<div class='col-1 d-flex justify-content-end pe-2'>";
            echo "<button type='button' class='btn-close btn-close-logout' data-bs-dismiss='modal' aria-label='Close'></button>";
            echo "</div>";
            echo "</div>";
            echo "</a>";
        } elseif ($row_adminnotif[$i]['notif_info'] == "Warnings") {
            echo "<a href='#'>";
            echo "<div class='row d-flex align-items-center py-3 border-bottom notification-content'>";
            echo "<div class='col-1 ps-2'>";
            echo "<div class='notif-circle rounded-circle d-flex align-items-center justify-content-center'>";
            echo "<img src='../imgs/admin/report.png' class='warning-img' alt=''>";
            echo "</div>";
            echo "</div>";
            echo "<div class='col-10 d-flex flex-column gap-2'>";
            echo "<div class='notif-msg ps-3'>A landlord has sent a warning to a renter. Take Action.</div>";
            echo "<div class='notif-date ps-3'>" . date('m/d/Y', strtotime($row_adminnotif[$i]['date_notif'])) . "</div>";
            echo "</div>";
            echo "<div class='col-1 d-flex justify-content-end pe-2'>";
            echo "<button type='button' class='btn-close btn-close-logout' data-bs-dismiss='modal' aria-label='Close'></button>";
            echo "</div>";
            echo "</div>";
            echo "</a>";
        }
    }
    ?>
</div>
<?php
mysqli_close($con);
?>
