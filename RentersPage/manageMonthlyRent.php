<?php

session_start();
include('../DataBase/connection.php');
if(isset($_SESSION['rEmail'])){
    $renterEmail = $_SESSION['rEmail'];
    $selectUser = "SELECT * FROM user_renter WHERE rEmail ='$renterEmail'";
    $executeSelectUser = mysqli_query($con, $selectUser);
    $getUser = mysqli_fetch_assoc($executeSelectUser);

    if(isset($_GET['idnotif']) && $_GET['idnotif'] != ""){
        $update_notif="UPDATE renter_notification SET notif_status='read' WHERE id = '".$_GET['idnotif']."'";
        $newnotif_update_executed=mysqli_query($con,$update_notif);
    }
    else{
        $update_notif="UPDATE renter_notification SET notif_status='read' WHERE renter_id = '".$getUser['rId']."' AND notif_info='due3'";
        $newnotif_update_executed=mysqli_query($con,$update_notif);
        
        $update_notif1="UPDATE renter_notification SET notif_status='read' WHERE renter_id = '".$getUser['rId']."' AND notif_info='due-today'";
        $newnotif_update_executed1=mysqli_query($con,$update_notif1);
        
        $update_notif2="UPDATE renter_notification SET notif_status='read' WHERE renter_id = '".$getUser['rId']."' AND notif_info='due-late'";
        $newnotif_update_executed2=mysqli_query($con,$update_notif2);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentA | Monthly Rent</title>
    <link rel="icon" type="image/x-icon" href="../imgs/key.ico">
     
     <!-- Bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

     <!-- Bootstrap icons -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

     <!-- CSS -->
     <link rel="stylesheet" href="../CSS/">
     <link rel="stylesheet" href="../CSS/stylesNav.css">
     <link rel="stylesheet" href="../CSS/stylesRenterApplication.css">
     

</head>
<body>
    
<!-- Navbar - Renter -->
<div class="nav-container fixed-top ">
    <nav class="navbar navbar-expand-md px-3 px-md-5">
        <div class="container-fluid">

            <div class="d-none">
                <input type="text" id="txtEmail" value="<?php echo $_SESSION['rEmail'];?>">
            </div>

            <!-- burger -->
            <button class="navbar-toggler collapsed d-flex d-sm-block d-md-none flex-column justify-content-around" type="button" data-bs-toggle="collapse" data-bs-target="#navMenuRenter" >
                <span class="toggler-icon top-bar"></span>
                <span class="toggler-icon middle-bar"></span>
                <span class="toggler-icon bottom-bar"></span>
            </button>

            <!-- logo -->
            <a class="navbar-brand" href="../../RentA">
                <img src="../imgs/logo.png" alt="RentA" id="imgLogo">
            </a>
            
            <!-- Avatar - Renter on small screen -->
            <div class="dropdown ms-auto d-sm-block d-md-none ">
                <button onclick="dropdownAvatarFunction()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block" type="button" id="dropdrownbtn-avatar" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo $getUser['rImgProfile'] ?>" alt="" class="img-avatar">
                    <i class="bi bi-chevron-down nav-icons" id="chevron-down-avatar"></i>
                    <i class="bi bi-chevron-up nav-icons" id="chevron-up-avatar"></i>
                    <div class="d-none">
                        <input type="text" id="txtUserId" value="<?php echo $getUser['rId'] ?>">
                    </div>
                <span id="smnotifyCircle">
                </span>
                </button>
                <ul class="dropdown-menu dropdown-menu-avatar-renter-sm " aria-labelledby="dropdrownbtn-avatar">
                    <li>
                        <a class="dropdown-item dropdown-item-first d-flex justify-content-between" href="renterNotifications.php" id="smNotifCount">
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item dropdown-item-first d-flex justify-content-between" href="../messages.php" id="smmessageCount"> 
                        </a>
                    </li>
                    <li><a class="dropdown-item" href="../favorites.php">Favorites</a></li>
                    <li><a class="dropdown-item " href="renterProfile.php">My Profile</a></li>
                    <li><a class="dropdown-item dropdown-item-last" data-bs-toggle="modal" data-bs-target="#logoutModal">Log out</a></li>
                </ul>
            </div>

            <!-- links center -->
            <div class="collapse navbar-collapse" id="navMenuRenter">

                <ul class="navbar-nav navbar-nav-renter d-flex gap-2 align-items-center ms-auto">
                        <li class="nav-item px-3">
                            <a class="nav-link" href="../rentals.php">Find Rentals</a>
                        </li>
                        
                        <li class="nav-item dropdown d-none d-sm-none d-md-block">
                            <button onclick="dropdownManageFunction()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block dd-renter-manage active-dropdown" type="button" id="" data-bs-toggle="dropdown" aria-expanded="false">
                                Manage
                                <i class="bi bi-chevron-down nav-icons" id="chevron-down-manage"></i>
                                <i class="bi bi-chevron-up nav-icons" id="chevron-up-manage"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-rentals" aria-labelledby="dropdrownbtn-manage">
                                <li><a class="dropdown-item dropdown-item-first" href="application1Submit.php">Application</a></li>
                                <li><a class="dropdown-item active-dropdown" href="manageMonthlyRent.php">Monthly Rent</a></li>
                                <li><a class="dropdown-item dropdown-item-last" href="manageRentalConcern.php">Rental Concern</a></li>
                            </ul>
                        </li>

                       <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link" href="application1Submit.php">Application</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link active-dropdown" href="manageMonthlyRent.php">Monthly Rent</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link " href="manageRentalConcern.php">Rental Concern</a>
                        </li>

                </ul>

                <ul class="d-flex align-items-center ms-auto">
                    <!-- Avatar - Renter big-->
                    <div class="dropdown ">
                        <button onclick="dropdownAvatarFunction2()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block" type="button" id="dropdrownbtn-avatar" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?php echo $getUser['rImgProfile'] ?>" alt="" class="img-avatar me-1">
                            <i class="bi bi-chevron-down nav-icons" id="chevron-down-avatar2"></i>
                            <i class="bi bi-chevron-up nav-icons" id="chevron-up-avatar2"></i>

                        <span id="notifyCircle">
                        </span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-avatar-renter" aria-labelledby="dropdrownbtn-avatar">
                            <li>
                                <a class="dropdown-item dropdown-item-first d-flex justify-content-between" href="renterNotifications.php" id="notifCount"> 
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex justify-content-between" href="../messages.php" id="messageCount"> 
                                </a>
                            </li>
                            <li><a class="dropdown-item" href="../favorites.php">Favorites</a></li>
                            <li><a class="dropdown-item" href="renterProfile.php">My Profile</a></li>
                            <li><a class="dropdown-item dropdown-item-last" data-bs-toggle="modal" data-bs-target="#logoutModal">Log out</a></li>
                        </ul>
                    </div>
                </ul>
            </div>
        </div>
    </nav>
</div>
<!-- end navbar renter -->

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
    $selectlistlease = "SELECT * FROM lease WHERE renter_id='".$getUser['rId']."' AND lease_status='residing'";
    $executelistlease = mysqli_query($con, $selectlistlease);
    $getlistlease = mysqli_fetch_all($executelistlease, MYSQLI_ASSOC);
    ?>
    <div class="container-fluid container-submit ">

        <!-- NO RECORD YET -->
        <?php
        if(count($getlistlease) == 0){
        ?>
        <div class="container-fluid px-3 px-md-5 py-3">
            <header>
                <h3 class="title">Monthly Rent</h3>
                <p class="mt-2">Monthly rent record will appear here once you've moved in.</p>
            </header>
        </div>
    <?php
        }
        else{
            $selectpropertyInfo = "SELECT * FROM landing_properties WHERE propertyID='".$getlistlease[0]['property_id']."'";
            $executepropertyInfo = mysqli_query($con, $selectpropertyInfo);
            $getpropertyInfo = mysqli_fetch_assoc($executepropertyInfo);
    ?>
    <!-- THERE'S RECORD -->
        <div class="container-fluid px-3 px-md-5 py-3">
            <header>
                <h3 class="title">Monthly Rent</h3>
                <p class="mt-2">This page holds the record of all your monthly rent. 
                <br> Please send your receipt photo as proof of payment once you've already paid your rent.</p>
                <p> <span class="late"><b>Reminder:</b> </span>  We will automatically use your advance payment if you didn't settle your payment on your due date. </p>
            </header>

            <div class="d-flex flex-column renter-info mt-1">
                <p>Monthly rent: <b> ₱ <span><?php echo number_format($getpropertyInfo['propertyPrice']) ?></span> </b></p>
                <p>Due every: <b><span><?php echo $getlistlease[0]['preferred_monthly_rent'] ?> </span> day of the month</b></p>
            </div>

            <!-- only 1 will appear -->
            <div class="d-flex justify-content-center mt-3">
            <?php
            
            $selectlistleasevalue = "SELECT * FROM lease WHERE renter_id='".$getUser['rId']."' AND lease_status='residing'";
            $executelistleasevalue = mysqli_query($con, $selectlistleasevalue);
            $getlistleasevalue = mysqli_fetch_assoc($executelistleasevalue);
            
                $selectpayrecord = "SELECT * FROM payment_records WHERE renter_id='".$getUser['rId']."' AND pay_date IS NULL";
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
                                $dayValue = "DAY";
                                if($days > 1){
                                    $dayValue = "DAYS";
                                }
                            ?>
                            <div class="d-flex flex-column justify-content-center align-items-center">
                                <p class="p-due">Your monthly rent is due in <span class="due-in"><b><?php echo $days . " " . $dayValue?></b>.</span></p>
                                <a href="uploadRentReceipt.php" class="pay-now">Send receipt now</a>
                            </div>
                            <?php
                            }
                            else if($days == 0){
                                ?>
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <p class="p-due due-today">Your monthly rent is <b> DUE TODAY</b>.</p>
                                    <a href="uploadRentReceipt.php" class="pay-now">Send receipt now</a>
                                </div>
                                <?php
                            }
                            else if($days < 0){
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
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <p class="p-due due-today">Your monthly rent was due  <span><b><?php echo $lateValue . " " . $dayValue ?></span> AGO</b>.</p>
                                    <a href="uploadRentReceipt.php" class="pay-now">Send receipt now</a>
                                </div>
                                <?php
                            }
                        }
                    }
                }
                    ?>
                </div>
                
        
            <!-- TABLE -->
                <table role="table" class="table-renter-manage w-100">
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
                        
                        </tr>
                    </thead>
        
                <!-- DATA -->
                    <tbody role="rowgroup">
                    <?php
                            $selectpayrecord1 = "SELECT * FROM payment_records WHERE renter_id='".$getUser['rId']."'";
                            $executepayrecord1 = mysqli_query($con, $selectpayrecord1);
                            $getpayrecord1 = mysqli_fetch_all($executepayrecord1, MYSQLI_ASSOC);
                            for($i = count($getpayrecord1)-1; $i >= 0; $i--){
                                $propertyId = $getpayrecord1[$i]['property_id'];
                                $renterId = $getpayrecord1[$i]['renter_id'];

                                if($getpayrecord1[$i]['amount'] == NULL){
                                    $amount_paid = 0;
                                }
                                else{
                                    $amount_paid = $getpayrecord1[$i]['amount'];
                                }
                                
                                $selectProperty = "SELECT * FROM landing_properties WHERE propertyID='$propertyId'";
                                $executeProperty = mysqli_query($con, $selectProperty);
                                $getProperty = mysqli_fetch_assoc($executeProperty);
        
                                $selectrenter= "SELECT * FROM user_renter WHERE rId='$renterId'";
                                $executerenter = mysqli_query($con, $selectrenter);
                                $getrenterinfo = mysqli_fetch_assoc($executerenter);
                                
                                $selectleaseinfo= "SELECT * FROM lease WHERE renter_id='$renterId' AND property_id='$propertyId'";
                                $executeleaseinfo = mysqli_query($con, $selectleaseinfo);
                                $getleaseinfo = mysqli_fetch_assoc($executeleaseinfo);

                                $currentDate = $getpayrecord1[$i]['MonthsRecords'];
                                $payment_Date = date("F", strtotime($currentDate));

                            ?>
                        <tr role="row" class="border-bottom">
                            <td role="cell" class="py-3 pe-2 manage-monthly-rent ps-1"> <?php echo $payment_Date?> </td>
                            <td role="cell" class="py-3 pe-2 manage-monthly-renty ps-1">₱ <?php echo number_format($getpayrecord1[$i]['advance']) ?></td>
                            <td role="cell" class="py-3 pe-2 manage-monthly-renty ps-1">₱ <?php echo number_format($amount_paid) ?></td>
                            <td role="cell" class="py-3 pe-2 manage-monthly-renty ps-1">
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
                            if($getpayrecord1[$i]['sent_status'] == NULL){
                                ?>
                                <a href="uploadRentReceipt.php?paymentid=<?php echo $getpayrecord1[$i]['id'] ?>&datevalue=<?php echo $payment_Date ?>" class="btn btns btn-confirm px-1 py-2 d-flex align-items-center justify-content-center" role="button">
                                    <i class="bi bi-cash-stack actionIcon pe-1"></i>
                                    <span class="uploadRentReceipt.php">Send receipt</span>
                                </a>
                                <?php
                            }
                            else if($getpayrecord1[$i]['sent_status'] != NULL && $getpayrecord1[$i]['sent_status'] != "No record"){
                                ?>
                                <a href="rentReceipt.php?paymentid=<?php echo $getpayrecord1[$i]['id'] ?>&datevalue=<?php echo $payment_Date ?>" class="btn btns btn-del px-1 py-2 d-flex align-items-center justify-content-center" role="button">
                                    <i class="bi bi-receipt actionIcon pe-1"></i>
                                    <span>View receipt</span>
                                </a>
                                <?php
                            }
                            else{
                                ?>
                                <a class="btn btns btn-del px-1 py-2 d-flex align-items-center justify-content-center" role="button">
                                    <i class="bi bi-receipt actionIcon pe-1"></i>
                                    <span>No receipt</span>
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
        <?php
        }
        ?>
    </div>


<!-- ```````````````````````````````` -->
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../JavaScripts/functionNav.js"></script>

    <script>
        function blurFunction(){
            var upAvatar = document.getElementById("chevron-up-avatar");
            var downAvatar = document.getElementById("chevron-down-avatar");
            var upAvatar2 = document.getElementById("chevron-up-avatar2");
            var downAvatar2 = document.getElementById("chevron-down-avatar2");
            var upManage = document.getElementById("chevron-up-manage");
            var downManage = document.getElementById("chevron-down-manage");
             
            upAvatar.style.display = "none";
            downAvatar.style.display = "inline-block";

            upAvatar2.style.display = "none";
            downAvatar2.style.display = "inline-block";

            upManage.style.display = "none";
            downManage.style.display = "inline-block";
        }
        setInterval(function(){
                $.ajax({
                    url:"../Functions/Renters/realtimeapplicationNotif.php",
                    method:"POST",
                    data:{
                        userid:$("#txtUserId").val()
                    },
                    dataType:"text",
                    success:function(data)
                    {
                        $("#notifId").html(data);
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

            setInterval(function(){
                $.ajax({
                    url:"../Functions/Renters/realtimeNotifCount.php",
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
                    url:"../Functions/Renters/realtimeNotifCount.php",
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

<?php
}
else{
    echo "<script>window.location.href = '../../../RentA/RentersPage/starterPage.php'</script>";
}

?>











