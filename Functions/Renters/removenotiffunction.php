<?php
    include('../../DataBase/connection.php');
    $notifvalue = $_POST['notifid'];
    
    $update_notif="UPDATE renter_notification SET notif_status='read' WHERE id='$notifvalue'";
    $newnotif_update_executed=mysqli_query($con,$update_notif);
    
    echo "
    <h1 class='l-page-h1'>Notifications</h1>
    <div class='notif-container mt-3'>";?>

    <?php
        $selectrenternotif = "SELECT * FROM renter_notification WHERE notif_status='unread' ORDER BY notif_date DESC";
        $executerenternotif = mysqli_query($con, $selectrenternotif);
        $row_renternotif = mysqli_fetch_all($executerenternotif, MYSQLI_ASSOC);
        for($i = 0; $i<count($row_renternotif); $i++){

            if($row_renternotif[$i]['notif_info'] == "application-approved"){
            echo '
            <div class="row d-flex align-items-center py-3 border-bottom notification-content">
                <a href="application3LeaseWait.php?id=' . $row_renternotif[$i]['id'] . '" class="a-notif">
                    <div class="col-1 ps-2">
                        <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                            <img src="../imgs/approved.png" class="app-img" alt="">
                        </div>
                    </div>
                    <div class="col-10 d-flex flex-column gap-2">
                        <div class="notif-msg ps-3"> The landlord had approved your rental application. View progress. </div>
                        <div class="notif-date ps-3">' . date('m/d/Y', strtotime($row_renternotif[$i]['notif_date'])) . '</div>
                    </div>
                </a>
                <div class="col-1 d-flex justify-content-end pe-2 ">
                    <button type="button" class="btn-close btn-close-logout"  onclick="removenotiffunction(this.value)" value="' . $row_renternotif[$i]['id'] . '"></button>
                </div>
            </div>';
            }
            else if ($row_renternotif[$i]['notif_info'] == "rejected-application") {
                echo '<div class="row d-flex align-items-center py-3 border-bottom notification-content">
                        <a href="application2Rejected.php?id=' . $row_renternotif[$i]['id'] . '" class="a-notif">
                            <div class="col-1 ps-2">
                                <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                    <img src="../imgs/cancel.png" class="bill-img" alt="">
                                </div>
                            </div>
                            <div class="col-10 d-flex flex-column gap-2">
                                <div class="notif-msg ps-3">  Sorry, the landlord had rejected your rental application. See the reason why by clicking this notification.</div>
                                <div class="notif-date ps-3">' . date('m/d/Y', strtotime($row_renternotif[$i]['notif_date'])) . '</div>
                            </div>
                        </a>
                        <div class="col-1 d-flex justify-content-end pe-2 ">
                            <button type="button" class="btn-close btn-close-logout btnremovenotif" onclick="removenotiffunction(this.value)" value="' . $row_renternotif[$i]['id'] . '"></button>
                        </div>
                    </div>';
            }
            else if ($row_renternotif[$i]['notif_info'] == "received-lease") {
                echo '<div class="row d-flex align-items-center py-3 border-bottom notification-content">
                        <a href="application3SignLeaseUploaded.php?id=' . $row_renternotif[$i]['id'] . '" class="a-notif">
                            <div class="col-1 ps-2">
                                <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                    <img src="../imgs/lease-ag.png" class="ag-img ms-1" alt="">
                                </div>
                            </div>
                            <div class="col-10 d-flex flex-column gap-2">
                                <div class="notif-msg ps-3">  The landlord sent you a lease and advance payment agreement. Settle it now. </div>
                                <div class="notif-date ps-3">' . date('m/d/Y', strtotime($row_renternotif[$i]['notif_date'])) . '</div>
                            </div>
                        </a>
                        <div class="col-1 d-flex justify-content-end pe-2 ">
                            <button type="button" class="btn-close btn-close-logout btnremovenotif" onclick="removenotiffunction(this.value)" value="' . $row_renternotif[$i]['id'] . '"></button>
                        </div>
                    </div>';
            }
            else if ($row_renternotif[$i]['notif_info'] == "receipt-accepted") {
                echo '<!-- 1 notif landlord confirmed receipt -->
                <div class="row d-flex align-items-center py-3 border-bottom notification-content">
                    <a href="application4Move.php?id=' . $row_renternotif[$i]['id'] . '" class="a-notif">
                        <div class="col-1 ps-2">
                            <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                <img src="../imgs/calendar.png" class="ag-img" alt="">
                            </div>
                        </div>
                        <div class="col-10 d-flex flex-column gap-2">
                            <div class="notif-msg ps-3"> The landlord confirmed your lease and advance payment. Message him/her to settle your move-in date. </div>
                            <div class="notif-date ps-3">' . date('m/d/Y', strtotime($row_renternotif[$i]['notif_date'])) . '</div>
                        </div>
                    </a>
                    <div class="col-1 d-flex justify-content-end pe-2 ">
                        <button type="button" class="btn-close btn-close-logout btnremovenotif" onclick="removenotiffunction(' . $row_renternotif[$i]['id'] . ')" value="' . $row_renternotif[$i]['id'] . '"></button>
                    </div>
                </div>';
            }            
            else if ($row_renternotif[$i]['notif_info'] == "receipt-accepted") {
                echo '<div class="row d-flex align-items-center py-3 border-bottom notification-content">
                        <a href="application4Move.php?id=' . $row_renternotif[$i]['id'] . '" class="a-notif">
                            <div class="col-1 ps-2">
                                <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                    <img src="../imgs/calendar.png" class="ag-img" alt="">
                                </div>
                            </div>
                            <div class="col-10 d-flex flex-column gap-2">
                                <div class="notif-msg ps-3"> The landlord confirmed your lease and advance payment. Message him/her to settle your move-in date. </div>
                                <div class="notif-date ps-3">' . date('m/d/Y', strtotime($row_renternotif[$i]['notif_date'])) . '</div>
                            </div>
                        </a>
                        <div class="col-1 d-flex justify-content-end pe-2 ">
                            <button type="button" class="btn-close btn-close-logout btnremovenotif" onclick="removenotiffunction(this.value)" value="' . $row_renternotif[$i]['id'] . '"></button>
                        </div>
                    </div>';
            }
            else if ($row_renternotif[$i]['notif_info'] == "due3") {
                echo '<div class="row d-flex align-items-center py-3 border-bottom notification-content">
                        <a href="manageMonthlyRent.php?id=' . $row_renternotif[$i]['id'] . '" class="a-notif">
                            <div class="col-1 ps-2">
                                <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                    <img src="../imgs/wallet.png" class="ag-img" alt="">
                                </div>
                            </div>
                            <div class="col-10 d-flex flex-column gap-2">
                                <div class="notif-msg ps-3"> Your monthly rent is due in 3 days. Settle it now. </div>
                                <div class="notif-date ps-3">' . date('m/d/Y', strtotime($row_renternotif[$i]['notif_date'])) . '</div>
                            </div>
                        </a>
                        <div class="col-1 d-flex justify-content-end pe-2 ">
                            <button type="button" class="btn-close btn-close-logout btnremovenotif" onclick="removenotiffunction(this.value)" value="' . $row_renternotif[$i]['id'] . '"></button>
                        </div>
                    </div>';
            }
            else if ($row_renternotif[$i]['notif_info'] == "due-today") {
                echo '<div class="row d-flex align-items-center py-3 border-bottom notification-content">
                        <a href="manageMonthlyRent.php?id=' . $row_renternotif[$i]['id'] . '" class="a-notif">
                            <div class="col-1 ps-2">
                                <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                    <img src="../imgs/wallet.png" class="ag-img" alt="">
                                </div>
                            </div>
                            <div class="col-10 d-flex flex-column gap-2">
                                <div class="notif-msg ps-3"> Your monthly rent is due today. You need to settle it now. </div>
                                <div class="notif-date ps-3">' . date('m/d/Y', strtotime($row_renternotif[$i]['notif_date'])) . '</div>
                            </div>
                        </a>
                        <div class="col-1 d-flex justify-content-end pe-2 ">
                            <button type="button" class="btn-close btn-close-logout btnremovenotif" onclick="removenotiffunction(this.value)" value="' . $row_renternotif[$i]['id'] . '"></button>
                        </div>
                    </div>';
            }
            else if ($row_renternotif[$i]['notif_info'] == "due-late") {
                echo '<div class="row d-flex align-items-center py-3 border-bottom notification-content">
                        <a href="manageMonthlyRent.php?id=' . $row_renternotif[$i]['id'] . '" class="a-notif">
                            <div class="col-1 ps-2">
                                <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                    <img src="../imgs/wallet.png" class="ag-img" alt="">
                                </div>
                            </div>
                            <div class="col-10 d-flex flex-column gap-2">
                                <div class="notif-msg ps-3"> Your monthly rent due date has already passed. Please settle it immediately. </div>
                                <div class="notif-date ps-3">' . date('m/d/Y', strtotime($row_renternotif[$i]['notif_date'])) . '</div>
                            </div>
                        </a>
                        <div class="col-1 d-flex justify-content-end pe-2 ">
                            <button type="button" class="btn-close btn-close-logout btnremovenotif" onclick="removenotiffunction(this.value)" value="' . $row_renternotif[$i]['id'] . '"></button>
                        </div>
                    </div>';
            }
            else if ($row_renternotif[$i]['notif_info'] == "contract-expiring") {
                echo '<div class="row d-flex align-items-center py-3 border-bottom notification-content" onclick="reqnewlease(this)" data-value="' . $row_renternotif[$i]['id'] . '">
                        <div class="col-1 ps-2">
                            <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                <img src="../imgs/question-sign.png" class="ag-img" alt="">
                            </div>
                        </div>
                        <div class="col-10 d-flex flex-column gap-2 extend-notif">
                            <div class="notif-msg ps-3"> Your contract is expiring next month. We need you to settle it. Please click this notification.</div>
                            <div class="notif-date ps-3">' . date('m/d/Y', strtotime($row_renternotif[$i]['notif_date'])) . '</div>
                        </div>
                        <div class="col-1 d-flex justify-content-end pe-2 ">
                            <button type="button" class="btn-close btn-close-logout btnremovenotif" onclick="removenotiffunction(this.value)" value="' . $row_renternotif[$i]['id'] . '"></button>
                        </div>
                    </div>';
            }
            else if ($row_renternotif[$i]['notif_info'] == "extend-agreed") {
                echo '<div class="row d-flex align-items-center py-3 border-bottom notification-content">
                    <div class="col-1 ps-2">
                        <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                            <img src="../imgs/approved.png" class="app-img" alt="">
                        </div>
                    </div>
                    <div class="col-10 d-flex flex-column gap-2 extend-notif">
                        <div class="notif-msg ps-3"> The landlord had agreed on renewing your contract. Please wait while he/she processes the new contract. </div>
                        <div class="notif-date ps-3">' . date('m/d/Y', strtotime($row_renternotif[$i]['notif_date'])) . '</div>
                    </div>
                    <div class="col-1 d-flex justify-content-end pe-2 ">
                        <button type="button" class="btn-close btn-close-logout btnremovenotif" onclick="removenotiffunction(this.value)" value="' . $row_renternotif[$i]['id'] . '"></button>
                    </div>
                </div>';
            }
            else if ($row_renternotif[$i]['notif_info'] == "extend-rejected") {
                echo '<div class="row d-flex align-items-center py-3 border-bottom notification-content" data-bs-toggle="modal" data-bs-target="#extendContractModal">
                    <div class="col-1 ps-2">
                        <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                            <img src="../imgs/cancel.png" class="bill-img" alt="">
                        </div>
                    </div>
                    <div class="col-10 d-flex flex-column gap-2 extend-notif">
                        <div class="notif-msg ps-3"> Sorry! The landlord had rejected your request for contract renewal. See his/her reason here.</div>
                        <div class="notif-date ps-3">' . date('m/d/Y', strtotime($row_renternotif[$i]['notif_date'])) . '</div>
                    </div>
                    <div class="col-1 d-flex justify-content-end pe-2 ">
                        <button type="button" class="btn-close btn-close-logout btnremovenotif" onclick="removenotiffunction(this.value)" value="' . $row_renternotif[$i]['id'] . '"></button>
                    </div>
                </div>';
            }   
            else if ($row_renternotif[$i]['notif_info'] == "receipt-rejected") {
                echo '
                <div class="row d-flex align-items-center py-3 border-bottom notification-content" onclick="checkrejectedreason(this)" data-value="' . $row_renternotif[$i]['id'] . '">
                    <div class="col-1 ps-2">
                        <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                            <img src="../imgs/cancel.png" class="bill-img" alt="">
                        </div>
                    </div>
                    <div class="col-10 d-flex flex-column gap-2 extend-notif">
                        <div class="notif-msg ps-3"> Sorry! The landlord had rejected your payment receipt. See his/her reason here.</div>
                        <div class="notif-date ps-3">' . date('m/d/Y', strtotime($row_renternotif[$i]['notif_date'])) . '</div>
                    </div>
                    <div class="col-1 d-flex justify-content-end pe-2 ">
                        <button type="button" class="btn-close btn-close-logout btnremovenotif" onclick="removenotiffunction(' . $row_renternotif[$i]['id'] . ')" value="' . $row_renternotif[$i]['id'] . '"></button>
                    </div>
                </div>';
            }
        }
?>
