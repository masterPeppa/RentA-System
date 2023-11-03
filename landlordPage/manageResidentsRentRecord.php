<!-- <?php
    include ('../DataBase/connection.php');
    session_start();
    if(isset($_SESSION['lEmail'])){
    $landlordEmail = $_SESSION['lEmail'];
    $delete_query = mysqli_query($con, "DELETE FROM landing_properties WHERE publishing_status='Not yet' AND landlord_id='".$_SESSION['landlordId']."'");
    $delete_query1 = mysqli_query($con, "DELETE FROM landing_properties_new WHERE publishing_status='Not yet' AND landlord_id='".$_SESSION['landlordId']."'");
    $selectUser = "SELECT * FROM user_landlord WHERE lEmail	='$landlordEmail'";
    $executeSelectUser = mysqli_query($con, $selectUser);
    $lgetId = mysqli_fetch_assoc($executeSelectUser);
?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentA | Records</title>
    <link rel="icon" type="image/x-icon" href="../imgs/key.ico">
    
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- CSS -->
    <link rel="stylesheet" href="../CSS/">
    <link rel="stylesheet" href="../CSS/stylesNav.css">
    <link rel="stylesheet" href="../CSS/stylesManageApplicants.css">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    
</head>
<body>

<!-- MODAL NOT VERIFIED YET -->
<div class="modal fade" id="cantListModal" tabindex="-1" aria-labelledby="reasonModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content modals modal_cantList">

                <div class="modal-header modal-header-logout p-3">
                    <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="d-flex flex-column align-items-center justify-content-center px-md-5 px-3">
                        <img src="../../imgs/warning.png" alt="" class="img-logout">
                        <h5 class="text-center mt-2 modal-txt"> Oops! You can't list a property yet since the admin is still verifying your identity. We will notify you immediately when you are already verified.</h5>
                    </div>
                </div>

                <div class="modal-footer d-flex gap-2 p-3">
                    <button type="button" class="btn modal-logout-btns btn-del px-4 py-2" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
<!-- modal end - NOT VERIFIED YET --> 

<!-- Navbar - Landlord -->
<div class="nav-container fixed-top">
        <nav class="navbar navbar-expand-md px-3 px-md-5">
            <div class="container-fluid">
			<!-- for save condition -->
                <div class="d-none">
                    <input type="text" id="txtEmail" value="<?php echo $_SESSION['lEmail'];?>">
                </div>
                <!-- burger -->
                <button class="navbar-toggler collapsed d-flex d-sm-block d-md-none flex-column justify-content-around" type="button" data-bs-toggle="collapse" data-bs-target="#navMenuLandlord" >
                    <span class="toggler-icon top-bar"></span>
                    <span class="toggler-icon middle-bar"></span>
                    <span class="toggler-icon bottom-bar"></span>
                </button>

                <!-- logo -->
                <a class="navbar-brand" href="../../RentA">
                    <img src="../imgs/logo.png" alt="RentA" id="imgLogo">
                </a>
                
                <!-- Avatar - Landlord on small screen -->
                <div class="dropdown ms-auto d-sm-block d-md-none">
                    <button onclick="dropdownAvatarFunction()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block" type="button" id="dropdrownbtn-avatar" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo $lgetId['lImgProfile'] ?>" alt="" class="img-avatar me-1">
                        <i class="bi bi-chevron-down nav-icons" id="chevron-down-avatar"></i>
                        <i class="bi bi-chevron-up nav-icons" id="chevron-up-avatar"></i>
                        <div class="d-none">
                            <input type="text" id="txtUserId" value="<?php echo $lgetId['lID'] ?>">
                        </div>
                    <span id="smnotifyCircle">
                    </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-avatar-sm " aria-labelledby="dropdrownbtn-avatar">
                        <li>
                            <a class="dropdown-item dropdown-item-first d-flex justify-content-between" href="landlordNotifications.php" id="smNotifCount">
                                Notifications 
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex justify-content-between" href="../messages.php" id="smmessageCount">Messages 
                                
                            </a>
                        </li>
                        <li><a class="dropdown-item" href="landlordProfile.php">My Profile</a></li>
                        <li><a class="dropdown-item dropdown-item-last" data-bs-toggle="modal" data-bs-target="#logoutModal">Log out</a></li>
                    </ul>
                </div>

                <!-- links center -->
                <div class="collapse navbar-collapse" id="navMenuLandlord">

                    <ul class="navbar-nav navbar-nav-landlord d-flex align-items-center">
                        
                        <li class="nav-item px-3">
                            <a class="nav-link" href="manageProperty.php">My Properties</a>
                        </li>

                        <!-- Manage Renters -->
                        <li class="nav-item dropdown d-none d-sm-none d-md-block">
                            <button onclick="dropdownManageFunction()" onblur="blurFunction()" class="btn active-dropdown btn-light dropdown-toggle d-inline-block" type="button" id="dropdrownbtn-manage" data-bs-toggle="dropdown" aria-expanded="false">
                                Manage Renters
                                <i class="bi bi-chevron-down nav-icons" id="chevron-down-manage"></i>
                                <i class="bi bi-chevron-up nav-icons" id="chevron-up-manage"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-manage" aria-labelledby="dropdrownbtn-manage">
                                <li><a class="dropdown-item dropdown-item-first" href="manageApplicants.php">Applicants</a></li>
                                <li><a class="dropdown-item" href="manageLeases.php">Leases</a></li>
                                <li><a class="dropdown-item" href="manageAdvancePayments.php">Advance Payments</a></li>
                                <li><a class="dropdown-item" href="manageResidents.php">Residents</a></li>
                                <li><a class="dropdown-item dropdown-item-last active-dropdown" href="manageResidentsRent.php">Residents' Rents</a></li>
                            </ul>
                        </li>

                       <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link" href="manageApplicants.php">Applicants</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link " href="manageLeases.php">Leases</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link" href="manageAdvancePayments.php">Advance Payments</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link" href="manageResidents.php">Residents</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link active-dropdown" href="manageResidentsRent.php">Residents' Rents</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link listProperty" onclick="checklistProperty1()">List a Property</a>
                        </li>

                    </ul>
                    
                    <ul class="d-flex align-items-center ms-auto">
                        <!-- Avatar - Landlord big-->
                        <div class="dropdown me-2 d-none d-sm-none d-md-block ">
                            <button onclick="dropdownAvatarFunction2()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block" type="button" id="dropdrownbtn-avatar" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?php echo $lgetId['lImgProfile'] ?>" alt="" class="img-avatar me-1">
                                <i class="bi bi-chevron-down nav-icons" id="chevron-down-avatar2"></i>
                                <i class="bi bi-chevron-up nav-icons" id="chevron-up-avatar2"></i>
                                <span id="notifyCircle">
                                </span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-avatar" aria-labelledby="dropdrownbtn-avatar">
                                <li>
                                    <a class="dropdown-item dropdown-item-first d-flex justify-content-between" href="landlordNotifications.php" id="notifCount">
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex justify-content-between" href="../messages.php" id="messageCount">
                                    </a>
                                </li>
                                <li><a class="dropdown-item " href="landlordProfile.php">My profile</a></li>
                                <li><a class="dropdown-item dropdown-item-last" data-bs-toggle="modal" data-bs-target="#logoutModal">Log out</a></li>
                            </ul>
                        </div>

                        <!-- List property button -->
                        <div class=" nav-item d-none d-sm-none d-md-block">
                            <a onclick="checklistProperty1()" class="btn btns listProperty btn_listProperty pt-2">List a Property</a>
                        </div>
                    </ul>

                </div>
            </div>
        </nav>
    </div>
<!-- end nav landlord -->

<!-- MODAL LOGOUT -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="modalLogout" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content container_modalLogout">

                <div class="modal-header modal-header-logout p-3">
                    <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body modal-body-logout">
                    <section class="section_logout">
                        
                        <div class="div-logout d-flex flex-column align-items-center justify-content-center mt-3">
                            <img src="../imgs/logout.png" alt="Log Out" class="img-logout">
                            <h5 class="text-center mt-1">Are you sure you want to log out?</h5>
                        </div>
                    </section>
                </div>

                <div class="modal-footer d-flex gap-2 p-3">
                    <button type="button" class="btn btn-cancel modal-logout-btns" data-bs-dismiss="modal">No</button>
                    <a href="../index.php?status=logout" class="btn btn-del modal-logout-btns d-flex align-items-center justify-content-center">Yes</a>
                  </div>
            </div>
        </div>
    </div>
<!-- modal end - LOGOUT -->


<!-- MAIN -->
<?php
    $selectlistlease = "SELECT * FROM lease WHERE id='".$_GET['leaseid']."'";
    $executelistlease = mysqli_query($con, $selectlistlease);
    $getlistlease = mysqli_fetch_assoc($executelistlease);
    $countlistlease = mysqli_num_rows($executelistlease);
?>
<!-- NO APPLICANTS -->
    <?php 
    if($countlistlease == 0){
        ?>
    <div class="container-fluid container-approved-applicants px-3 px-md-5 py-3">

        <div class="d-flex gap-2 align-items-center">
            <a class="" onclick="GobackPage()">
                <h3 class="title title-prev">Residents' Rents</h3>
            </a>
            <i class="bi bi-chevron-right back-chev"></i>
            <h3 class="title">Records</h3>
        </div>

        <a class="chev-back ps-1 py-1 pe-2" href="manageResidentsRent.php">
            <i class="bi bi-chevron-left back-chev"></i>
        </a>
        <header class="mt-3">
            <h3 class="title">Records</h3>
        </header>

        <!-- refresh button -->
        <div class="d-flex gap-2 mt-3">
            <button class="btn refresh-btn" onclick="refreshPage()" id="btnrefresh">
            </button>
        </div>
    </div>
<?php
    }
    else{
?>
<!-- THERE'S APPROVED APPLICANTS -->
   
    <div class="container-fluid container-approved-applicants px-3 px-md-5 py-3">
        <div class="d-flex gap-2 align-items-center">
            <a class="" onclick="GobackPage()">
                <h3 class="title title-prev">Residents' Rents</h3>
            </a>
            <i class="bi bi-chevron-right back-chev"></i>
            <h3 class="title">Records</h3>
        </div>

        <!-- refresh button -->
        <div class="d-flex gap-2">
        <button class="btn refresh-btn" onclick="refreshPage()" id="refreshButton">
            </button>
        </div>

        <?php
        $selectrenter= "SELECT * FROM user_renter WHERE rId='".$getlistlease['renter_id']."'";
        $executerenter = mysqli_query($con, $selectrenter);
        $getrenterinfo = mysqli_fetch_assoc($executerenter);

        $selectproperties = "SELECT * FROM landing_properties WHERE propertyID='".$getlistlease['property_id']."'";
        $executeproperties = mysqli_query($con, $selectproperties);
        $getpropertyInfo = mysqli_fetch_assoc($executeproperties);
        
        $selectlistleasevalue = "SELECT * FROM lease WHERE renter_id='".$getlistlease['renter_id']."' AND lease_status='residing'";
        $executelistleasevalue = mysqli_query($con, $selectlistleasevalue);
        $getlistleasevalue = mysqli_fetch_assoc($executelistleasevalue);

        $selectpayrecord = "SELECT * FROM payment_records WHERE renter_id='".$getlistlease['renter_id']."' AND pay_date IS NULL";
        $executepayrecord = mysqli_query($con, $selectpayrecord);
        $getpayrecord = mysqli_fetch_assoc($executepayrecord);
        $getpayrecordcount = mysqli_num_rows($executepayrecord);

        if($getpayrecordcount > 0){
            date_default_timezone_set('Asia/Manila');
            $targetDate = date("Y-m-d"); 
            $approvedDate = $getpayrecord['MonthsRecords'];
            
            $targetDate = new DateTime($targetDate);
            $approvedDate = new DateTime($approvedDate);

            $daysToCheck = range(-30, 3);
            foreach ($daysToCheck as $days) {
                $dateToCheck = clone $targetDate;
                $dateToCheck->modify("+$days days");
                if ($dateToCheck->format("Y-m-d") == $approvedDate->format("Y-m-d")) {
                    if($days <= 3 && $days > 0){
                        $created_Time = date("Y-m-d");
                        $insertNotif = "INSERT INTO renter_notification (landlord_id, renter_id, property_id, notif_info, notif_date, notif_status) 
                        VALUES ('".$getpropertyInfo['landlord_id']."', '".$getlistleasevalue['renter_id']."', '".$getpropertyInfo['propertyID']."', 'due3', '$created_Time', 'unread')";
                        $executeInsertNotif = mysqli_query($con, $insertNotif);
                    }
                    else if($days == 0){
                        $created_Time = date("Y-m-d");
                        $insertNotif = "INSERT INTO renter_notification (landlord_id, renter_id, property_id, notif_info, notif_date, notif_status) 
                        VALUES ('".$getpropertyInfo['landlord_id']."', '".$getlistleasevalue['renter_id']."', '".$getpropertyInfo['propertyID']."', 'due-today', '$created_Time', 'unread')";
                        $executeInsertNotif = mysqli_query($con, $insertNotif);
                    }
                    else if($days < 0){
                        $created_Time = date("Y-m-d");
                        $insertNotif = "INSERT INTO renter_notification (landlord_id, renter_id, property_id, notif_info, notif_date, notif_status) 
                        VALUES ('".$getpropertyInfo['landlord_id']."', '".$getlistleasevalue['renter_id']."', '".$getpropertyInfo['propertyID']."', 'due-late', '$created_Time', 'unread')";
                        $executeInsertNotif = mysqli_query($con, $insertNotif);

                        $lateValue = abs($days);
                        $newAdvance = $getpayrecord['advance'];
                        $advancededuction = $getpropertyInfo['propertyPrice'] + $getlistleasevalue['penalty_amount'];
                        $dayValue = "DAY";
                        if($lateValue > 1){
                            $dayValue = "DAYS";
                        }
                        if($lateValue == 30){
                            if($getpayrecord['late'] != "YES" || $getpayrecord['late'] != "NO"){
                                if($getpayrecord['advance'] >= $getpropertyInfo['propertyPrice'] && $getpayrecord['pay_date'] == NULL){
                                    $newadvance = $getpayrecord['advance'] - $getpropertyInfo['propertyPrice'];
                                    $pastdate = $getpayrecord['MonthsRecords'];
                                    $randomNumber = rand(100000, 999999);
                                    $receiptNo = "R-".$randomNumber;

                                    $getDay = date("d", strtotime($pastdate));

                                    $new_date = date("Y-m-$getDay");

                                    $curr_date = date("Y-m-d");
                                    
                                    $updatepaymentrecord = "UPDATE payment_records SET pay_date='$curr_date', amount='".$getpropertyInfo['propertyPrice']."', balance='0', penalty='0', Receipt_no='$receiptNo', late='NO', confirmation='confirmed',
                                    sent_status='No record' WHERE renter_id='".$getlistleasevalue['renter_id']."' AND pay_date IS NULL";
                                    $executepaymentrecord = mysqli_query($con, $updatepaymentrecord);

                                    $insertData = "INSERT INTO payment_records (landlord_id, renter_id, property_id, advance, MonthsRecords) 
                                    VALUES ('".$getpropertyInfo['landlord_id']."', '".$getlistleasevalue['renter_id']."', '".$getpropertyInfo['propertyID']."', '$newadvance', '$new_date')";
                                    $executeInsert = mysqli_query($con, $insertData);
                                }
                                else if($advancededuction > $newAdvance && $getpayrecord['pay_date'] == NULL){
                                    $bal = $advancededuction - $newAdvance;
                                    $balanceValue = $bal + $getpayrecord['balance'];

                                    $pastdate = $getpayrecord['MonthsRecords'];

                                    $getDay = date("d", strtotime($pastdate));

                                    $new_date = date("Y-m-$getDay");

                                    $curr_date = date("Y-m-d");

                                    $updatepaymentrecord = "UPDATE payment_records SET pay_date='$curr_date', advance='0', amount='".$getpropertyInfo['propertyPrice']."', balance='$balanceValue', penalty='".$getlistleasevalue['penalty_amount']."', Receipt_no='Overdue', late='YES', confirmation='confirmed'
                                    WHERE renter_id='".$getlistlease['renter_id']."' AND pay_date IS NULL";
                                    $executepaymentrecord = mysqli_query($con, $updatepaymentrecord);

                                    $insertData = "INSERT INTO payment_records (landlord_id, renter_id, property_id, advance, MonthsRecords) 
                                    VALUES ('".$getpropertyInfo['landlord_id']."', '".$getlistlease['renter_id']."', '".$getpropertyInfo['propertyID']."', '0', '$new_date')";
                                    $executeInsert = mysqli_query($con, $insertData);
                                }
                            }
                        }
                        ?>
                        <?php
                    }
                }
            }
        }
            ?>
        <div class="d-flex flex-column renter-info gap-2 mt-5">
            <p>Renter's name: <span> <b><?php echo $getrenterinfo['rLname'] . ", " . $getrenterinfo['rFname']?> </b></span></p>
            <p>Monthly rent: <b> ₱ <span><?php echo number_format($getpropertyInfo['propertyPrice']) ?></span> </b></p>
            <p>Due every: <b><span><?php echo $getlistlease['preferred_monthly_rent'] ?></span></b> day of the month</p>
        </div> 

    <!-- TABLE -->
        <table role="table" class="table-manage-applicants mt-3">
        <!-- HEADER -->
            <thead role="rowgroup" class="headers">
                <tr role="row" class="headers">
                    <th role="columnheader" class="py-3 pe-5">Month</th>
                    <th role="columnheader" class="py-3 pe-5">Advanced</th>
                    <th role="columnheader" class="py-3 pe-5">Amount paid</th>
                    <th role="columnheader" class="py-3 pe-5">Date Paid</th>
                    <th role="columnheader" class="py-3 pe-5">Receipt no.</th>
                    <th role="columnheader" class="py-3 pe-3">Confirmation</th>
                    <th role="columnheader" class="py-3 pe-3">Balance</th>
                    <th role="columnheader" class="py-3 pe-3">Penalty</th>
                    <th role="columnheader" class="py-3 pe-3">Actions</th>
                    <!-- view receipt 
                        send warning-->

                </tr>
            </thead>

        <!-- DATA -->
            <tbody role="rowgroup">
            <?php
            $selectlistrecord1 = "SELECT * FROM payment_records WHERE landlord_id='".$lgetId['lID']."' AND renter_id='".$getlistlease['renter_id']."'";
            $executelistrecord1 = mysqli_query($con, $selectlistrecord1);
            $getpayrecord1 = mysqli_fetch_all($executelistrecord1, MYSQLI_ASSOC);

                    for($i = count($getpayrecord1)-1; $i >= 0; $i--){
                        $propertyId = $getpayrecord1[$i]['property_id'];
                        $renterId = $getpayrecord1[$i]['renter_id'];

                        if($getpayrecord1[$i]['amount'] == NULL){
                            $amount_paid = 0;
                        }
                        else{
                            $amount_paid = $getpayrecord1[$i]['amount'];
                        }

                        $currentDate = $getpayrecord1[$i]['MonthsRecords'];
                        $payment_Date = date("F", strtotime("+1 month", strtotime($currentDate)));
                    ?>
                <tr role="row" class="border-bottom">
                    <td role="cell" class="py-3 pe-2 manage-res-record ps-1"> <?php echo $payment_Date ?> </td>
                    <td role="cell" class="py-3 pe-2 manage-res-record ps-1">₱ <?php echo number_format($getpayrecord1[$i]['advance']) ?></td>
                    <td role="cell" class="py-3 pe-2 manage-res-record ps-1">₱ <?php echo number_format($amount_paid) ?></td>
                    <td role="cell" class="py-3 pe-2 manage-res-record ps-1">
                        <div>
                        <?php
                        if($getpayrecord1[$i]['pay_date'] != NULL){
                            $datePaid = $getpayrecord1[$i]['pay_date'];
                            $getDayVal = date("d", strtotime($datePaid));
                            $getMonthVal = date("m", strtotime($datePaid));
                            $getYearVal = date("Y", strtotime($datePaid));
                        ?>
                            <p><?php echo $getMonthVal ?>/ <b><?php echo $getDayVal ?></b> /<?php echo $getYearVal ?></p>
                            <?php
                                    if($getpayrecord1[$i]['late'] == "NO"){
                                        ?>
                                        <p class="on-time"><b>ON TIME</b> </p>
                                        <?php
                                    }
                                    else if($getpayrecord1[$i]['late'] == "YES"){
                                        ?>
                                        <p class="late"><b>LATE</b> </p>
                                        <?php
                                    }
                                }
                                    ?>
                        </div>
                        
                    </td>
                    <?php
                            if($getpayrecord1[$i]['Receipt_no'] == NULL){
                                ?>
                                <td role="cell" class="py-3 pe-2 manage-monthly-rent ps-1"></td>
                                <?php
                            }
                            else{
                                ?>
                                <td role="cell" class="py-3 pe-2 manage-monthly-rent ps-1"><?php echo $getpayrecord1[$i]['Receipt_no'] ?></td>
                                <?php
                            }
                            ?>
                    <td role="cell" class="py-3 pe-2 manage-monthly-rent ps-1">
                                <?php
                                if($getpayrecord1[$i]['confirmation'] == "confirmed"){
                                    ?>
                                    <div class="">
                                        <span class="payment-confirmed payment-confirmation px-4 py-2">Confirmed</span>
                                    </div>
                                    <?php
                                }
                                else{
                                    ?>
                                    <div class="">
                                        <span class="payment-not-confirmed payment-confirmation px-4 py-2">Not yet</span>
                                    </div>
                                    <?php
                                }
                                ?>
                            </td>
                            <?php
                            if($getpayrecord1[$i]['balance'] == "0" || $getpayrecord1[$i]['balance'] == NULL){
                                ?>
                                <td role="cell" class="py-3 pe-2 manage-monthly-rent ps-1">0</td>
                                <?php
                            }
                            else{
                                ?>
                                <td role="cell" class="py-3 pe-2 manage-monthly-rent ps-1"><?php echo $getpayrecord1[$i]['balance'] ?></td>
                                <?php
                            }
                            ?>
                    <?php
                            if($getpayrecord1[$i]['penalty'] == "0" || $getpayrecord1[$i]['penalty'] == NULL){
                                ?>
                                <td role="cell" class="py-3 pe-2 manage-monthly-rent ps-1">0</td>
                                <?php
                            }
                            else{
                                ?>
                                <td role="cell" class="py-3 pe-2 manage-monthly-rent ps-1"><?php echo $getpayrecord1[$i]['penalty'] ?> </td>
                                <?php
                            }
                            ?>
                            <td role="cell" class="py-3 manage-monthly-rent">
                            <?php
                            if($getpayrecord1[$i]['sent_status'] == "sent" && $getpayrecord1[$i]['confirmation'] == "Not yet"){
                                ?>
                                <a href="rentReceipt.php?paymentid=<?php echo $getpayrecord1[$i]['id'] ?>&datevalue=<?php echo $payment_Date ?>" class="btn btns btn-confirm px-1 py-2 d-flex align-items-center justify-content-center" role="button">
                                    <i class="bi bi-search-heart actionIcon pe-1"></i>
                                    <span>View receipt</span>
                                </a>
                                <?php
                            }
                            else{
                                ?>
                                <a class="btn btns btn-del px-1 py-2 d-flex align-items-center justify-content-center" role="button">
                                    <i class="bi bi-exclamation-triangle actionIcon pe-1"></i>
                                    <span>Send warning</span>
                                </a>
                                <?php
                            }
                                ?>
                            </td>
              </tr>
              <?php
                }
                ?>
            </tbody>
          </table>

    </div>
<div class="d-none">
    <input type="text" id="txtiteratecount" value="<?php echo count($getlistlease)?>">
</div>
<?php
    }
    ?>



    <!-- JS -->
    <script src="../JavaScripts/functionNav.js"></script>
    <script defer src="../JavaScripts/functionManageProperty.js"></script>

    <script>
            function blurFunction(){
                var upManage = document.getElementById("chevron-up-manage");
                var downManage = document.getElementById("chevron-down-manage");
                var upAvatar = document.getElementById("chevron-up-avatar");
                var downAvatar = document.getElementById("chevron-down-avatar");
                var upAvatar2 = document.getElementById("chevron-up-avatar2");
                var downAvatar2 = document.getElementById("chevron-down-avatar2");

                upAvatar.style.display = "none";
                downAvatar.style.display = "inline-block";

                upAvatar2.style.display = "none";
                downAvatar2.style.display = "inline-block";

                upManage.style.display = "none";
                downManage.style.display = "inline-block";
            }
               
        setInterval(function(){
                $.ajax({
                    url:"../Functions/realtimeMessageCount.php",
                    method:"POST",
                    data:{
                        userid:$("#txtUserId").val()
                    },
                    dataType:"text",
                    success:function(data)
                    {
                        $("#messageCount").html(data);
                    }
                });
            }, 700);
            setInterval(function(){
                $.ajax({
                    url:"../Functions/realtimeMessageCount.php",
                    method:"POST",
                    data:{
                        userid:$("#txtUserId").val()
                    },
                    dataType:"text",
                    success:function(data)
                    {
                        $("#smmessageCount").html(data);
                    }
                });
            }, 700);
            setInterval(function(){
                $.ajax({
                    url:"../Functions/realtimeNotif.php",
                    method:"POST",
                    data:{
                        userid:$("#txtUserId").val()
                    },
                    dataType:"text",
                    success:function(data)
                    {
                        $("#notifyCircle").html(data);
                    }
                });
            }, 700);
            setInterval(function(){
                $.ajax({
                    url:"../Functions/realtimeNotif.php",
                    method:"POST",
                    data:{
                        userid:$("#txtUserId").val()
                    },
                    dataType:"text",
                    success:function(data)
                    {
                        $("#smnotifyCircle").html(data);
                    }
                });
            }, 700);

            // var i = 0;
            // setInterval(function () {
            //     $.ajax({
            //         url: "../Functions/Landlord/realtimesigningstatus.php",
            //         method: "POST",
            //         data: {
            //             userid: $("#txtUserId").val(),
            //             iterate: i // Use i directly here
            //         },
            //         dataType: "text",
            //         success: function (data) {
            //             var iteration = document.getElementById('txtiteratecount').value;
            //             $("#signingstatus" + i).html(data);
            //             i++;
            //             if (i >= iteration) {
            //                 i = 0; // Reset i when it reaches the end
            //             }
            //         }
            //     });
            // }, 700);
            setInterval(function(){
                $.ajax({
                    url:"../Functions/Landlord/realtimeNotifCount.php",
                    method:"POST",
                    data:{
                        userid:$("#txtUserId").val()
                    },
                    dataType:"text",
                    success:function(data)
                    {
                        $("#notifCount").html(data);
                    }
                });
            }, 700);
            setInterval(function(){
                $.ajax({
                    url:"../Functions/Landlord/realtimeNotifCount.php",
                    method:"POST",
                    data:{
                        userid:$("#txtUserId").val()
                    },
                    dataType:"text",
                    success:function(data)
                    {
                        $("#smNotifCount").html(data);
                    }
                });
            }, 700);
    </script>



</body>
</html>
<!-- <?php
    }
    else{
        if(isset($_GET['data']) && $_GET['data'] != ""){
            echo "<script>window.location.href = 'starterPage.php?data=".$_GET['data']."'</script>";
        }
        else{
            echo "<script>window.location.href = '../../../RentA/landlordPage/starterPage.php'</script>";
        }
    }
    ?> -->