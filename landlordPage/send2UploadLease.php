<?php
    include ('../DataBase/connection.php');
    session_start();
    if(isset($_SESSION['lEmail'])){
    $landlordEmail = $_SESSION['lEmail'];
    $delete_query = mysqli_query($con, "DELETE FROM landing_properties WHERE publishing_status='Not yet' AND landlord_id='".$_SESSION['landlordId']."'");
    $delete_query1 = mysqli_query($con, "DELETE FROM landing_properties_new WHERE publishing_status='Not yet' AND landlord_id='".$_SESSION['landlordId']."'");
    $selectUser = "SELECT * FROM user_landlord WHERE lEmail	='$landlordEmail'";
    $executeSelectUser = mysqli_query($con, $selectUser);
    $lgetId = mysqli_fetch_assoc($executeSelectUser);
    if(isset($_GET['renter'])){
        $renterId = $_GET['renter'];
    }
    else{
        $renterId = "";
    }

    if(isset($_GET['property'])){
        $propertyid = $_GET['property'];
    }
    else{
        $propertyid = "";
    }
    $electProperty = "SELECT * FROM landing_properties WHERE propertyID ='$propertyid'";
    $executeselectproperty = mysqli_query($con, $electProperty);
    $getPropertInfo = mysqli_fetch_assoc($executeselectproperty);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentA | Send Lease Agreement</title>
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
    <link rel="stylesheet" href="../CSS/stylesResAndLeases.css">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    
</head>
<body>
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
                            <button onclick="dropdownManageFunction()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block" type="button" id="dropdrownbtn-manage" data-bs-toggle="dropdown" aria-expanded="false">
                                Manage Renters
                                <i class="bi bi-chevron-down nav-icons" id="chevron-down-manage"></i>
                                <i class="bi bi-chevron-up nav-icons" id="chevron-up-manage"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-manage" aria-labelledby="dropdrownbtn-manage">
                                <li><a class="dropdown-item dropdown-item-first" href="manageApplicants.php">Applicants</a></li>
                                <li><a class="dropdown-item" href="manageLeases.php">Leases</a></li>
                                <li><a class="dropdown-item" href="manageAdvancePayments.php">Advance Payments</a></li>
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
                            <a class="nav-link" href="manageAdvancePayments.php">Advance Payments</a>
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
                    <a href="index.php?status=logout" class="btn btn-del modal-logout-btns d-flex align-items-center justify-content-center">Yes</a>
                </div>
            </div>
        </div>
    </div>
<!-- modal end - LOGOUT -->
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

<!-- MAIN -->


    <div class="container-fluid container-approved-applicants px-3 px-md-5 py-3">
        
        <h3 class="title">Send Lease Agreement</h3>

        <div class="row">
            <div class="col-lg-6 col-md-12 col-12">
                <p class="mt-5 mb-3 lease-type">Advance Payment Agreement </p>
                <p class="mb-4 ps-1 pe-5">What kind of payment do you need from the renter to fully settle this agreement? <br>
                You can select only one or both depending on your agreement with the potential renter.</p>

                <div class="d-flex flex-column gap-5">

                    <div class="row d-flex align-items-center ">
                        <div class="col-6">
                            <div class="d-flex gap-2 align-items-center">
                                <div class="checkbox-wrapper-39">
                                    <label>
                                        <input onclick="depositCheckbox()" type="checkbox" id="cbDeposit"/> 
                                        <span class="checkbox"></span>
                                    </label>
                                </div>
                                <span><b> Security Deposit </b></span> 
                            </div>
                        </div>

                        <div class="col-6 pe-md-5 pe-0">
                            <div class="input-group" id="depositInput">
                                <span class="input-group-text mt-2 span-peso" id="">₱</span>
                                <input type="text" class="form-control mt-2 input-containers" onkeydown="return /^([0-9]|Backspace)*$/i.test(event.key) || event.key.length > 1" id="txtdeposit" minlength="1" maxlength="8" placeholder="Enter deposit amount">
                            </div>
                        </div>
                        <div class="col-12 ps-1 pe-5 pt-3">
                            <p>Security deposits are not a part of the monthly rent.
                                This sum of money will be held by you throughout the lease agreement. 
                                It pays for any damage the renter caused in the unit until the end of the lease period. 
                                If there is damage, the renter will lose some of the money. 
                                Normal wear and tear should not lose the money, however. 
                                Upon the end of lease agreement, you are required to return this money if there is no damage and unpaid balance.</p>
                        </div>
                    </div>
                    


                    <div class="row d-flex align-items-center ">
                        <div class="col-6">
                            <div class="d-flex gap-2 align-items-center">
                                <div class="checkbox-wrapper-39">
                                    <label>
                                        <input onclick="amountcheckbox()" type="checkbox" id="cbAmount"/> 
                                        <span class="checkbox"></span>
                                    </label>
                                </div>
                                <span id="amountValue"><b> Advance Rental <span class="inputAmount">- </b> <span class="inputAmount"> ₱ </span><span class="computed-advance inputAmount" id="advanceTextValue">0</span></span></span> 
                            </div>
                            <div class="d-none">
                                <input type="text" id="txtAmountAdvance" value="<?php echo $getPropertInfo['propertyPrice'] ?>">
                            </div>
                        </div>

                        <div class="col-6 pe-md-5 pe-0">
                            <div class="dropdown advanceMenu inputAmount">
                                <button onblur="blurFunction()" id="btnAdvanceamountvalue" value="Please select one" class="btn dropdown-toggle d-flex justify-content-between rental-inputs advance-input btn-advance" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="advanceValue">Please select one</span>
                                    <i class="bi bi-chevron-down icons" id="downTypeSm"></i>
                                    <i class="bi bi-chevron-up icons" id="upTypeSm"></i>
                                </button>
                                <ul class="dropdown-menu dmenu dropdown-menu-ptype w-100">
                                    <li class="advance-option"><a class="dropdown-item dropdown-item-first dropdownAdvance">1 month advance</a></li>
                                    <li class="advance-option"><a class="dropdown-item dropdownAdvance">2 months advance</a></li>
                                    <li class="advance-option"><a class="dropdown-item dropdown-item-last dropdownAdvance">3 months advance</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 ps-1 pe-5 pt-3">
                            <p></p>
                        </div>

                        <p class="mt-5 mb-3 lease-type">Penalty Agreement </p>
                        <div class="row d-flex align-items-center ">
                        <div class="col-6">
                            <div class="d-flex gap-2 align-items-center">
                                <div class="checkbox-wrapper-39">
                                    <label>
                                        <input onclick="penaltyCheckbox()" type="checkbox" id="cbpenalty"/> 
                                        <span class="checkbox"></span>
                                    </label>
                                </div>
                                <span><b> Penalty Amount </b></span> 
                            </div>
                        </div>

                        <div class="col-6 pe-md-5 pe-0">
                            <div class="input-group" id="penaltyInput">
                                <span class="input-group-text mt-2 span-peso" id="">₱</span>
                                <input type="text" class="form-control mt-2 input-containers" onkeydown="return /^([0-9]|Backspace)*$/i.test(event.key) || event.key.length > 1" id="txtpenalty" minlength="1" maxlength="8" placeholder="Enter deposit amount">
                            </div>
                        </div>
                        <div class="col-12 ps-1 pe-5 pt-3">
                            <p>This penalty amount must be paid by the renter if he/she does not pay 30 days after the rent due date..</p>
                        </div>
                    </div>

                    </div>
                </div>
            </div>



            <div class="col-lg-6 col-md-12 col-12">
                <p class="mt-5 mb-3 lease-type">Upload Lease Agreement </p>
                
                <div class="d-flex">
                    <input type="file" class="showImgSize" id="uploadLandlordSign" accept=".png, .jpg, .jpeg">
                    <div class=" d-flex flex-column align-items-center" id="uploadlease">
                        <div class="box box-contract d-flex align-items-center justify-content-center flex-column" >
                            <canvas id="landlordCanvas" class="showImgSize"></canvas>
                            <img src="../imgs/contract.png" alt="" id="" class="back img-upload-id">
                            <p class="upload back">Upload document</p>
                            <p class="file-type back">JPEG or PNG only</p>
                        </div>
                    </div>
                </div>

                <!-- <div></div> -->
                <div class="mt-3 footer-upload d-flex justify-content-between align-items-center ">
                    <a onclick="GobackPage()" class="return-btns ms-2 d-flex" id=""> <span><i class="bi bi-arrow-left"></i></span>&nbsp;Back</a>
                    <a onclick="Sendleasetorenter()" role="button" class="btn send-continue px-4 py-2 text-light">
                        <span><i class="bi bi-send-plus pe-2"></i></span>
                        Send Lease
                    </a>
                </div>



                <div class="d-none">
                    <input type="text" id="txtRenter" value="<?php echo $renterId ?>">
                    <input type="text" id="txtpropid" value="<?php echo $propertyid ?>">
                </div>
            </div>
        </div>
    </div>
        





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
                var upType = document.getElementById("upTypeSm");
                var downType = document.getElementById("downTypeSm");


                upAvatar.style.display = "none";
                downAvatar.style.display = "inline-block";

                upAvatar2.style.display = "none";
                downAvatar2.style.display = "inline-block";

                upManage.style.display = "none";
                downManage.style.display = "inline-block";

                upType.style.display = "none";
                downType.style.display = "inline-block";
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
            
            function depositCheckbox() {
                const cbDeposit = document.getElementById('cbDeposit');
                var txtDeposit = document.getElementById('depositInput');
                if (cbDeposit.checked) {
                    txtDeposit.style.visibility = 'visible';
                } else {
                    txtDeposit.style.visibility = 'hidden';
                }
            }

            function penaltyCheckbox() {
                const cbpenalty = document.getElementById('cbpenalty');
                var txtpenalty = document.getElementById('penaltyInput');
                if (cbpenalty.checked) {
                    txtpenalty.style.visibility = 'visible';
                } else {
                    txtpenalty.style.visibility = 'hidden';
                }
            }

            function amountcheckbox() {
                const cbAmount = document.getElementById('cbAmount');
                var txtAmount = document.getElementsByClassName("inputAmount");

                if (cbAmount.checked) {
                    for (var i = 0; i < txtAmount.length; i++) {
                        txtAmount[i].style.visibility = 'visible';
                    }
                } else {
                    for (var i = 0; i < txtAmount.length; i++) {
                        txtAmount[i].style.visibility = 'hidden';
                    }
                }
            }


    </script>



</body>
</html>
<?php
    }
    else{
        echo "<script>window.history.back();</script>";
    }
    ?>