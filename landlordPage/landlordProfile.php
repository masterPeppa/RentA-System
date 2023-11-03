<?php
    include ('../DataBase/connection.php');
    session_start();
    if(isset($_SESSION['lEmail'])){
    $landlordEmail = $_SESSION['lEmail'];
    $delete_query = mysqli_query($con, "DELETE FROM landing_properties WHERE publishing_status='Not yet' AND landlord_id='".$_SESSION['landlordId']."'");
    $selectUser = "SELECT * FROM user_landlord WHERE lEmail	='$landlordEmail'";
    $executeSelectUser = mysqli_query($con, $selectUser);
    $lgetId = mysqli_fetch_assoc($executeSelectUser);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentA | My Profile</title>
    <link rel="icon" type="image/x-icon" href="../imgs/key.ico">
    
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- CSS -->
    <link rel="stylesheet" href="../CSS/">
    <link rel="stylesheet" href="../CSS/stylesNav.css">
    <link rel="stylesheet" href="../CSS/stylesProfile.css">

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
                        <li><a class="dropdown-item active-dropdown" href="landlordProfile.php">My Profile</a></li>
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
                            <button onclick="dropdownManageFunction()" onblur="blurFunction()" class="btn active btn-light dropdown-toggle d-inline-block" type="button" id="dropdrownbtn-manage" data-bs-toggle="dropdown" aria-expanded="false">
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
                                <li><a class="dropdown-item active-dropdown " href="landlordProfile.php">My profile</a></li>
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
    <div class="container-fluid">
        <div class="main-section d-flex flex-column justify-content-center align-items-center ">
            <div class="prof-containers">
                <div class="d-flex justify-content-between ">
                    <div>
                        <div class="d-flex mb-1 align-items-center">
                            <h3 class="title ">My Profile  • </h3> 
                            <h5 class="title " style="color: #8c52ff;">&nbsp;Landlord</h5>
                        </div>
                        <h5><span class="prof-name"><?php echo $lgetId['lFname'] . " ". $lgetId['lLname'] ?></span>, <span class="prof-email"><?php echo $lgetId['lEmail'] ?></span> </h5>
                    </div>

                <!-- PROFILE PIC-->
                    <div class="d-flex flex-column">
                        <img src="<?php echo $lgetId['lImgProfile'] ?>" alt="" class="prof-img">
                        <div class="d-flex justify-content-center ">
                            <div class="d-none">
                                <input type="file" id="newprofile" accept=".png, .jpg, .jpeg">
                            </div>
                            <button id="editProfilepic" class="d-flex align-items-center justify-content-center gap-1 edit-img w-75">
                                <i class="bi bi-camera-fill"></i>
                                <a class="links py-1 text-decoration-none ">Edit</a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="prof-containers">
            <!-- VERIFIED -->
                <div class="div-verified py-4 div-profile">
                    <div class="d-flex flex-column gap-2 ">
                        <div class="d-flex justify-content-between ">
                            <h5>Verification</h5>
                        <?php
                            if($lgetId['lStatus'] == "rejected"){
                        ?>
                        </div>
                        <div class="d-flex justify-content-between ">
                            <div>
                            <p class="">REJECTED</p>
                            <p>The admin had not verified your documents due to:
                                <br><span class="rejected-reason"><b><?php echo $lgetId['rejected_reason']?></b></span>
                            </p>
                            </div>
                            <div>
                                <a href='Verification/idVerification.php?action=resending' class="links">Reverify</a>
                            </div>
                        </div>
                        
                        <?php
                        }
                        else if($lgetId['lStatus'] == "fully-verified"){
                        ?>
                        </div>
                            <p class="">FULLY VERIFIED</p>
                            <p>You can already list your property.</p>
                        <?php
                        }
                        else if($lgetId['lStatus'] == "semi-verified"){
                        ?>
                        </div>
                            <p class="">VERIFYING</p>
                            <p>The admin is still reviewing your verification documents.</p>
                        <?php
                        }
                        ?>
                    </div>
                </div>

            <!-- PASSWORD -->
                <div class="div-profile py-4">
                    <div class="d-flex flex-column gap-2 ">
                        <div class="d-flex justify-content-between ">
                            <h5>Password</h5>
                            <a class="edit-pass links">Edit</a>
                            <a class="cancel-pass d-none links">Cancel</a>
                        </div>
                        
                        <p class="p-pass">••••••••</p>
                    </div>
        
                    <div class="form-pass d-none">
                        <p class="mt-3">Password must contain a minimum of 8 characters.</p>
                        <div class="row mt-3">
                            <div class="col-6 pe-1">
                                <div class="input-block form_inputs d-flex flex-row " >
                                    <input type="password" name="" id="lPassword" class="input_left prof-inputs px-3 py-2" minlength="8" required="required" placeholder=" " autocomplete="off">
                                    <span class="placeholder span_placeholder"> Current password </span>
            
                                    <span class="input-group-text span_right btn" id="toggle_password1">
                                        <i class="bi bi-eye-slash span_icons icon1" id=""></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-6 ps-1">
                                <div class="input-block form_inputs d-flex flex-row " >
                                    <input type="password" name="" id="lnewPassword" class="input_left prof-inputs px-3 py-2" minlength="8" required="required" placeholder=" " autocomplete="off">
                                    <span class="placeholder span_placeholder"> New password </span>
            
                                    <span class="input-group-text span_right btn" id="toggle_password2">
                                        <i class="bi bi-eye-slash span_icons icon2" id=""></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-6 mt-3 d-flex align-items-end">
                                <a href="../forgotPassword.php?user=landlord" class="links">Need a new password?</a>
                                
                            </div>
                            <div class="col-6 ps-1 mt-3"  >
                                <div class="input-block form_inputs  d-flex flex-row " >
                                    <input type="password" name="" id="lconfirmnewPassword" class="input_left prof-inputs px-3 py-2" minlength="8"  required="required" placeholder=" " autocomplete="off">
                                    <span class="placeholder span_placeholder"> Confirm password </span>
            
                                    <span class="input-group-text span_right btn" id="toggle_password3">
                                        <i class="bi bi-eye-slash span_icons icon3" id=""></i>
                                    </span>
                                </div>
                            </div>
                            
                        </div>
                        <button class="btns-profile btn-save-pass px-4 text-light mt-3" id="save_new_pass">Save</button>
                    </div>
                </div>

            <!-- NAME -->
                <div class="div-profile py-4 ">
                    <div class="d-flex flex-column gap-2 ">
                        <div class="d-flex justify-content-between ">
                            <h5>Legal name</h5>
                            <a class="edit-name links">Edit</a>
                            <a class="cancel-name d-none links">Cancel</a>
                        </div>
                        
                        <p class="p-name"><?php echo $lgetId['lFname'] . " ". $lgetId['lLname'] ?></p>
                    </div>
        
                    <div class="form-name d-none">
                        <div class="row mt-3 ">
                            <div class="col-6 pe-1">
                                <div class="input-block form_inputs mb-3" >
                                    <input type="text" name="" id="llandlordf" class="prof-inputs px-3 py-2" required="required" spellcheck="false" placeholder=" " autocomplete="off">
                                    <span class="placeholder"> First Name </span>
                                </div>
                            </div>
                            <div class="col-6 ps-1">
                                <div class="input-block form_inputs mb-3" >
                                    <input type="text" name="" id="llandlordlast" class="prof-inputs px-3 py-2" required="required" spellcheck="false" placeholder=" " autocomplete="off">
                                    <span class="placeholder"> Last Name </span>
                                </div>
                            </div>
                        </div>
                        <button class="btns-profile btn-save-name px-4 text-light" id="btnsavename">Save</button>
                    </div>
                </div>

                <!-- PHONE NUMBER -->
                <div class="div-profile py-4">
                    <div class="d-flex flex-column gap-2 ">
                        <div class="d-flex justify-content-between ">
                            <h5>Phone Number</h5>
                            <a class="edit-num links">Edit</a>
                            <a class="cancel-num d-none links">Cancel</a>
                        </div>
                        
                        <p class="p-num"><?php echo $lgetId['lNumber'] ?></p>
                    </div>

                    <div class="form-num d-none">
                        <div class="input-block form_inputs mb-3 mt-3" >
                            <input type="text" name="" id="txtNumber" class="prof-inputs px-3 py-2"  minlength="11" maxlength="11" onkeydown="return /^([0-9]|Backspace)*$/i.test(event.key) || event.key.length > 1" required="required" spellcheck="false" placeholder=" " autocomplete="off">
                            <span class="placeholder"> New Phone No. </span>
                        </div>
                        <button class="btns-profile btn-save-num px-4 text-light" id="btnEditNumber">Save</button>
                    </div>
                </div>

                <!-- ADDRESS -->
                <div class="div-profile py-4">
                    <div class="d-flex flex-column gap-2 ">
                        <div class="d-flex justify-content-between ">
                            <h5>Address</h5>
                            <a class="edit-address links">Edit</a>
                            <a class="cancel-address d-none links">Cancel</a>
                        </div>
                        
                        <p class="p-address"><?php echo $lgetId['lHouseNo'] . ", ". $lgetId['lBrgy'] . ", " . $lgetId['lCity'] . ", " . $lgetId['lProvince'] . ", ". $lgetId['lRegion'] ?></p>
                        
                         
                         
                          
                    </div>

                    <div class="form-address d-none">
                        <div class="row mt-3 ">
                            <div class="col-6 pe-1">
                                <div class="input-block form_inputs mb-3" >
                                    <input type="text" name="" id="txtRegion" class="prof-inputs px-3 py-2" required="required" spellcheck="false" placeholder=" " autocomplete="off">
                                    <span class="placeholder"> Region </span>
                                </div>
                            </div>
                            <div class="col-6 ps-1">
                                <div class="input-block form_inputs mb-3" >
                                    <input type="text" name="" id="txtProvince" class="prof-inputs px-3 py-2" required="required" spellcheck="false" placeholder=" " autocomplete="off">
                                    <span class="placeholder"> Province </span>
                                </div>
                            </div>
                            <div class="col-6 pe-1">
                                <div class="input-block form_inputs mb-3" >
                                    <input type="text" name="" id="txtCity" class="prof-inputs px-3 py-2" required="required" spellcheck="false" placeholder=" " autocomplete="off">
                                    <span class="placeholder"> City </span>
                                </div>
                            </div>
                            <div class="col-6 ps-1">
                                <div class="input-block form_inputs mb-3" >
                                    <input type="text" name="" id="txtBarangay" class="prof-inputs px-3 py-2" required="required" spellcheck="false" placeholder=" " autocomplete="off">
                                    <span class="placeholder"> Brgy </span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-block form_inputs mb-3" >
                                    <input type="text" name="" id="txtHouseNo" class="prof-inputs px-3 py-2" required="required" spellcheck="false" placeholder=" " autocomplete="off">
                                    <span class="placeholder"> House No / Street </span>
                                </div>
                            </div>
                        </div>
                        <button class="btns-profile btn-save-address px-4 text-light" id="btnEditLocation">Save</button>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>


    <script>
        $('.edit-pass').click(function(){
            $('.form-pass').removeClass('d-none');
            $('.p-pass').addClass('d-none');
            $('.edit-pass').addClass('d-none');
            $('.cancel-pass').removeClass('d-none');
        });

        $('.cancel-pass').click(function(){
            $('.form-pass').addClass('d-none');
            $('.p-pass').removeClass('d-none');
            $('.edit-pass').removeClass('d-none');
            $('.cancel-pass').addClass('d-none');
        });

        $('.edit-name').click(function(){
            $('.form-name').removeClass('d-none');
            $('.p-name').addClass('d-none');
            $('.edit-name').addClass('d-none');
            $('.cancel-name').removeClass('d-none');
        });

        $('.cancel-name').click(function(){
            $('.form-name').addClass('d-none');
            $('.p-name').removeClass('d-none');
            $('.edit-name').removeClass('d-none');
            $('.cancel-name').addClass('d-none');
        });

        $('.edit-num').click(function(){
            $('.form-num').removeClass('d-none');
            $('.p-num').addClass('d-none');
            $('.edit-num').addClass('d-none');
            $('.cancel-num').removeClass('d-none');
        });

        $('.cancel-num').click(function(){
            $('.form-num').addClass('d-none');
            $('.p-num').removeClass('d-none');
            $('.edit-num').removeClass('d-none');
            $('.cancel-num').addClass('d-none');
        });

        $('.edit-address').click(function(){
            $('.form-address').removeClass('d-none');
            $('.p-address').addClass('d-none');
            $('.edit-address').addClass('d-none');
            $('.cancel-address').removeClass('d-none');
        });

        $('.cancel-address').click(function(){
            $('.form-address').addClass('d-none');
            $('.p-address').removeClass('d-none');
            $('.edit-address').removeClass('d-none');
            $('.cancel-address').addClass('d-none');
        });
    
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
    </script>





    <!-- JS -->
    <script src="../JavaScripts/functionNav.js"></script>
    <script src="../JavaScripts/editprofile.js"></script>
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
    </script>



</body>
</html>
<?php
    }
    else{
        echo "<script>window.history.back();</script>";
    }
    ?>