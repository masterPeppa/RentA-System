
<?php
    include ('../DataBase/connection.php');
    session_start();
    if(isset($_SESSION['lEmail'])){
    $landlordEmail = $_SESSION['lEmail'];
    $selectUser = "SELECT * FROM user_landlord WHERE lEmail	='$landlordEmail'";
    $executeSelectUser = mysqli_query($con, $selectUser);
    $lgetId = mysqli_fetch_assoc($executeSelectUser);
    $delete_query = mysqli_query($con, "DELETE FROM landing_properties WHERE publishing_status='Not yet' AND landlord_id='".$_SESSION['landlordId']."'");
    $delete_query1 = mysqli_query($con, "DELETE FROM landing_properties_new WHERE publishing_status='Not yet' AND landlord_id='".$_SESSION['landlordId']."'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentA | Advanced Payments</title>
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
                                <li><a class="dropdown-item active-dropdown" href="manageAdvancePayments.php">Advance Payments</a></li>
                                <li><a class="dropdown-item" href="manageResidents.php">Residents</a></li>
                                <li><a class="dropdown-item dropdown-item-last" href="manageResidentsRent.php">Residents' Rents</a></li>
                            </ul>
                        </li>

                       <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link" href="manageApplicants.php">Applicants</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link " href="manageLeases.php">Leases</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link active-dropdown" href="manageAdvancePayments.php">Advance Payments</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link" href="manageResidents.php">Residents</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link" href="manageResidentsRent.php">Residents' Rents</a>
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
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="modalDelete" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content container_modalLogout">

                <div class="modal-header modal-header-logout p-3">
                    <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body modal-body-logout">
                    <section class="section_logout">
                        
                        <div class="div-logout d-flex flex-column align-items-center justify-content-center mt-3">
                            <img src="../imgs/logout.png" alt="" class="img-logout">
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
    date_default_timezone_set('Asia/Manila');
    $currentDate = date("Y-m-d");
    $fiveDaysAgo = date("Y-m-d", strtotime("-5 days", strtotime($currentDate)));

    $selectReceipt = "SELECT * FROM receipt WHERE landlord_id='" . $lgetId['lID'] . "' ORDER BY payment_date_time ASC";
    $executeReceipt = mysqli_query($con, $selectReceipt);
    $row_Receipt = mysqli_fetch_all($executeReceipt, MYSQLI_ASSOC);


    if(count($row_Receipt) == 0){
    ?>
<!-- NO APPLICANTS -->
    <div class="container-fluid container-no-approved-applicants px-3 px-md-5 py-3">
        <header>
            <h3 class="title">Advanced Payments</h3>
            <p class="mt-3">You currently have no payment transaction.</p>
        </header>

        <!-- refresh button -->
        <div class="d-flex gap-2 mt-3">
        <button class="btn refresh-btn" onclick="refreshPage()" id="btnrefresh">
            </button>
        </div>
    </div>

    
    <?php 
    }
    ?>
<!-- THERE'S APPROVED APPLICANTS -->
    <div class="container-fluid container-approved-applicants px-3 px-md-5 py-3">
    <?php
        if(count($row_Receipt) > 0){
        ?>
        <header>
            <h3 class="title">Advanced Payments</h3>
            <p class="mt-3">You currently have <span class="total-applicants"><?php echo count($row_Receipt) ?></span> payment transaction/s.</p>
        </header>

        <!-- refresh button -->
        <div class="d-flex gap-2 mt-3">
        <button class="btn refresh-btn" onclick="refreshPage()" id="refreshButton">
            </button>
        </div>
        
    <!-- TABLE -->
        <table role="table" class="table-manage-applicants">
        <!-- HEADER -->
            <thead role="rowgroup" class="headers">
                <tr role="row" class="headers">
                    <th role="columnheader" class="py-3 pe-5">Status</th>
                    <th role="columnheader" class="py-3 pe-3">Property info</th>
                    <th role="columnheader" class="py-3 pe-5">Name</th>
                    <th role="columnheader" class="py-3 pe-5">Payment type</th>
                    <th role="columnheader" class="py-3 pe-5">Amount</th>
                    <th role="columnheader" class="py-3 pe-5">Date paid</th>
                    <th role="columnheader" class="py-3 pe-3">Actions</th>
                </tr>
            </thead>

        <!-- DATA -->
            <tbody role="rowgroup">
            <?php
            if(count($row_Receipt) == 0){
                ?>
                <div class="d-none">
                    <input type="text" id="currentValue0" value="null">
                </div>
                <?php
            }
                ?>
            <?php
                    for($i = 0; $i < count($row_Receipt); $i++){
                        $propertyId = $row_Receipt[$i]['property_id'];
                        $renterId = $row_Receipt[$i]['renter_id'];
                        
                        $selectProperty = "SELECT * FROM landing_properties WHERE propertyID='$propertyId'";
                        $executeProperty = mysqli_query($con, $selectProperty);
                        $getProperty = mysqli_fetch_assoc($executeProperty);

                        $selectrenter= "SELECT * FROM user_renter WHERE rId='$renterId'";
                        $executerenter = mysqli_query($con, $selectrenter);
                        $getrenterinfo = mysqli_fetch_assoc($executerenter);

                        $selectlease= "SELECT * FROM lease WHERE renter_id='$renterId' AND property_id='$propertyId'";
                        $executelease = mysqli_query($con, $selectlease);
                        $getleaseinfo = mysqli_fetch_assoc($executelease);
                          
                        $selectdelete = "SELECT * FROM receipt WHERE landlord_id='" . $lgetId['lID'] . "' AND renter_id='$renterId' AND property_id='$propertyId' AND date_send_lease < '$fiveDaysAgo' AND (payment_status='Not yet' OR payment_status IS NULL)";
                        $executedelete = mysqli_query($con, $selectdelete);
                        $delete_count = mysqli_num_rows($executedelete);

                        if($delete_count > 0){
                            $deletereceipt = "DELETE FROM receipt WHERE landlord_id='" . $lgetId['lID'] . "' AND renter_id='$renterId' AND property_id='$propertyId' AND date_send_lease < '$fiveDaysAgo' AND (payment_status='Not yet' OR payment_status IS NULL)";
                            $executeDelete = mysqli_query($con, $deletereceipt);

                            $deletelease= "DELETE FROM lease WHERE landlord_id='" . $lgetId['lID'] . "' AND renter_id='$renterId' AND property_id='$propertyId'";
                            $executeDeletelease = mysqli_query($con, $deletelease);

                            $deleteapplication= "DELETE FROM application_data WHERE landlord_id='" . $lgetId['lID'] . "' AND renter_id='$renterId' AND property_id='$propertyId'";
                            $executeDeleteapplication = mysqli_query($con, $deleteapplication);

                            echo '<script type="text/javascript">
                                        window.location.href = window.location.href;
                                    </script>';
                        }
                    ?>
                <tr role="row" class="border-bottom">
                    <td role="cell" class="py-3 pe-2 manage-payment-header" id="statusBody<?php echo $i ?>">
                    <div class="d-none">
                        <input type="text" id="currentValue<?php echo $i ?>" value="<?php echo $row_Receipt[$i]['payment_status']?>">
                    </div>
                    <?php
                    if(count($row_Receipt) == 0){
                        echo "<span class='status-red'><i class='bi bi-circle-fill pe-1'></i></span><span class='status-red'>No receipt yet</span>";
                        $datepaid = '--/--/----';
                    }
                    else{
                        if($row_Receipt[$i]['payment_date_time'] == NULL){
                            $datepaid = '--/--/----';
                        }
                        else{
                            $datepaid = date("m/d/Y", strtotime($row_Receipt[$i]['payment_date_time']));
                        }
                        if($row_Receipt[$i]['payment_status'] == "Not yet"){
                            echo "<span class='status-red'><i class='bi bi-circle-fill pe-1'></i></span><span class='status-red'>No receipt yet</span>";
                        }
                        else if($row_Receipt[$i]['payment_status'] == "paid"){
                            echo "<span class='status-green'><i class='bi bi-circle-fill pe-1'></i></span><span class='status-green'>Paid</span>";
                        }
                        else if($row_Receipt[$i]['payment_status'] == "approved"){
                            echo "<span class='status-signed'><i class='bi bi-circle-fill pe-1'></i></span><span class='status-signed'>Approved</span>";
                        }
                        else if($row_Receipt[$i]['payment_status'] == "rejected"){
                            echo "<span class='status-red'><i class='bi bi-circle-fill pe-1'></i></span><span class='status-red'>Invalid</span>";
                        }
                    }
                    ?>
                    </td>
                    <td role="cell" class="py-3 pe-2 manage-payment-header"><?php echo $getProperty['propertyTitle'] ?></td>
                    <td role="cell" class="py-3 pe-2 manage-payment-header"><?php echo $getrenterinfo['rFname'] , " ", $getrenterinfo['rLname'] ?></td>
                    <td role="cell" class="py-3 pe-2 manage-payment-header">
                        <div class="d-flex flex-column gap-2">
                            <?php
                            if($getleaseinfo['deposit_amount'] != 0 || $getleaseinfo['deposit_amount'] == NULL){
                                ?>
                                <p class="p-deposit">Security Deposit</p>
                                <?php
                            }
                            else{
                                ?>
                                <p class="p-deposit"></p>
                                <?php
                            }
                            if($getleaseinfo['advance_amount'] != 0 || $getleaseinfo['advance_amount'] == NULL){
                                ?>
                                <p class="p-advance"><?php echo $getleaseinfo['advance_period'] ?></p>
                                <?php
                            }
                            else{
                                ?>
                                <p class="p-advance"></p>
                                <?php
                            }
                            ?>
                        </div>
                    </td>
                    <td role="cell" class="py-3 pe-2 manage-payment-header">
                    <div class="d-flex flex-column gap-2">
                    <?php
                            if($getleaseinfo['deposit_amount'] != 0){
                                ?>
                                <p class="div-p-deposit">₱ <span class="p-deposit-amt"> <?php echo number_format($getleaseinfo['deposit_amount']) ?> </span></p>
                                <?php
                            }
                            if($getleaseinfo['advance_amount'] != 0){
                                ?>
                                <p class="div-p-advance">₱ <span class="p-advance-amt"> <?php echo number_format($getleaseinfo['advance_amount']) ?> </span></p>
                                <?php
                            }
                            ?>
                        </div>    
                    </td>
                    <?php
                    if($row_Receipt[$i]['payment_date_time'] == NULL){
                        ?>
                        <td role="cell" class="py-3 pe-2 manage-payment-header">Not yet paid</td>
                    <?php
                    }
                    else {
                        $dbdatetime = $row_Receipt[$i]['payment_date_time'];
                        $datetime = new DateTime($dbdatetime);
                        $date = $datetime->format('m-d-Y');
                        $dbdatedata = $datetime->format('Y-m-d H:i:s');
                        ?>
                        <td role="cell" class="py-3 pe-2 manage-payment-header"><?php echo $date ?></td>
                        <?php
                    }
                    ?>
                    
                    <td role="cell" class="py-3 manage-payment-header">
                            <div class="d-flex flex-column gap-2">
                                <div class="">
                                    <!-- magkakaron lang laman page na to once na nagsend na ng resibo si renter -->
                                    <?php
                                    if($row_Receipt[$i]['payment_status'] == "paid"){
                                        ?>
                                        <div class="">
                                            <!-- <a href="send1LeaseAgreement.php?renterId=<?php echo $getrenterinfo['rId'] ?>&propertyid=<?php echo $propertyId ?>" class="btn btns-manage-applicants px-1 py-2 d-flex align-items-center justify-content-center" role="button"> -->
                                            <a href="proof.php?rentid=<?php echo $renterId ?>&date=<?php echo $dbdatedata ?>" class="btn btns-manage-applicants px-1 py-2 d-flex align-items-center justify-content-center" role="button">
                                                <i class="bi bi-check-lg actionIcon pe-1"></i>
                                                <span>Check receipt</span>
                                            </a>
                                        </div>
                                        <?php
                                    }
                                    else if($row_Receipt[$i]['payment_status'] == "approved"){
                                        ?>
                                        <!-- lalabas lang po to pag ang status is APPROVED -->
                                        <div class="">
                                            <a href="proofApproved.php?rentid=<?php echo $renterId ?>&date=<?php echo $dbdatedata ?>" class="btn btns-manage-applicants px-1 py-2 d-flex align-items-center justify-content-center" role="button">
                                                <i class="bi bi-receipt actionIcon pe-1"></i>
                                                <span>View Receipt</span>
                                            </a>
                                        </div>
                                        <?php
                                    }
                                    else if($row_Receipt[$i]['payment_status'] == "rejected"){
                                        ?>
                                        <!-- lalabas lang po to pag ang status is INVALID -->
                                        <div class="">
                                            <a onclick="requestNewReceipt()" class="renterId btn btns btn-del px-1 py-2 d-flex align-items-center justify-content-center" data-value="<?php echo $renterId ?>" role="button">
                                                <i class="bi bi-send-plus actionIcon pe-1"></i>
                                                <span>Request new</span>
                                            </a>
                                        </div>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <!-- lalabas lang po to pag ang status is INVALID -->
                                        <div class="">
                                            Waiting...
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </td>
              </tr>
              <?php
                }
                ?>
            </tbody>
          </table>
          <?php
    }
    ?>
    <div class="d-none">
        <input type="text" id="txtiteratecount" value="<?php echo count($row_Receipt)?>">
        <input type="text" id="txtreqnew" value="">
    </div>
    </div>





    <!-- JS -->
    <script src="../JavaScripts/functionNav.js"></script>

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
            var i = document.getElementById('txtiteratecount').value - 1;
            var j = 0;
            var intervalId;

            intervalId = setInterval(function () {
                if (document.getElementById('currentValue0').value != "null") {
                    $.ajax({
                        url: "../Functions/Landlord/refreshAdvancePayment.php",
                        method: "POST",
                        data: {
                            userid: $("#txtUserId").val(),
                            currentValue: $("#currentValue" + i).val(),
                            currentiterationcount: $("#txtiteratecount").val(),
                            iterate: i
                        },
                        dataType: "text",
                        success: function (data) {
                            if (i <= 0 && data == "<i class='bi bi-arrow-clockwise'></i><span>Refresh</span>") {
                                $("#btnrefresh").html(data);
                                $("#refreshButton").html(data);
                                clearInterval(intervalId);
                            }
                            else if(i <= 0 && data == ""){
                                i = document.getElementById('txtiteratecount').value - 1;
                                j = 0;
                            }
                            else{
                                i--;
                                j++;
                            }
                        }
                    });
                }
            }, 700);


    </script>



</body>
</html>
<?php
    }
    else{
        echo "<script>window.location.href = '../../../RentA/landlordPage/starterPage.php'</script>";
    }
    ?>
