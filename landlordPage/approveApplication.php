<?php
session_start();
include('../DataBase/connection.php');
if(isset($_SESSION['lEmail'])){
    $landlordEmail = $_SESSION['lEmail'];
    $delete_query = mysqli_query($con, "DELETE FROM landing_properties WHERE publishing_status='Not yet' AND landlord_id='".$_SESSION['landlordId']."'");
    $delete_query1 = mysqli_query($con, "DELETE FROM landing_properties_new WHERE publishing_status='Not yet' AND landlord_id='".$_SESSION['landlordId']."'");
    $selectUser = "SELECT * FROM user_landlord WHERE lEmail ='$landlordEmail'";
    $executeSelectUser = mysqli_query($con, $selectUser);
    $lgetId = mysqli_fetch_assoc($executeSelectUser);
    
    if(isset($_GET['property']) && $_GET['property'] != "" && isset($_GET['id']) && $_GET['id'] != ""){
            $propertyId = $_GET['property'];
            $renterId = $_GET['id'];
            //get property information
            $selectId = "SELECT * FROM landing_properties WHERE propertyID='$propertyId'";
            $executeSelectedid = mysqli_query($con, $selectId);
            $getPropertyinfo = mysqli_fetch_assoc($executeSelectedid);
            $setImg1 = "../" . str_replace("../", "", $getPropertyinfo['imgFeatured1']);

            //get renter information
            $selectrenter = "SELECT * FROM user_renter WHERE rId='$renterId'";
            $executeSelectrenter = mysqli_query($con, $selectrenter);
            $getrenterInfo = mysqli_fetch_assoc($executeSelectrenter);

            //get application information
            $selectApplication = "SELECT * FROM application_data WHERE renter_id='$renterId' AND landlord_id = '".$lgetId['lID']."'";
            $executeApplication = mysqli_query($con, $selectApplication);
            $getApplicationinfo = mysqli_fetch_assoc($executeApplication);

            $birthday = DateTime::createFromFormat("Y-m-d", $getrenterInfo['rBday']);
            $birthdayFormat = $birthday->format("m/d/Y");

            $imgFront = "../" . str_replace("../", "", $getApplicationinfo['front_id']);
            $imgBack = "../" . str_replace("../", "", $getApplicationinfo['back_id']);
            $imgMatch = "../" . str_replace("../", "", $getApplicationinfo['face_pic']);
            $imgDocu = "../" . str_replace("../", "", $getApplicationinfo['docu_id']);
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>RentA | Approve Application</title>
                <link rel="icon" type="image/x-icon" href="../imgs/key.ico">
                
                <!-- Bootstrap -->
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    
                <!-- Bootstrap icons -->
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
                <!--Date Picker-->
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
                <script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script>
    
                <!-- CSS -->
                <link rel="stylesheet" href="../CSS/">
                <link rel="stylesheet" href="../CSS/stylesNav.css">
                <link rel="stylesheet" href="../CSS/stylesRenterApplication.css">
                
                
                <!-- JS -->
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="../JavaScripts/functionNav.js"></script>
                <script src="../JavaScripts/applicationQuery.js"></script>
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
                                <img src="imgs/logout.png" alt="Log Out" class="img-logout">
                                <h5 class="text-center mt-1 modal-txt">Are you sure you want to log out?</h5>
                            </div>
                        </section>
                    </div>

                    <div class="modal-footer d-flex gap-2 p-3">
                        <button type="button" class="btn btn-cancel modal-logout-btns px-4 py-2" data-bs-dismiss="modal">No</button>
                        <a href="index.php?status=logout" class="btn btn-del modal-logout-btns px-4 py-2 d-flex align-items-center justify-content-center">Yes</a>
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

    <!-- MODAL CONFIRMATION -->
        <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content modals container_modalConfirm">

                    <div class="modal-header modal-header-logout p-3">
                        <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body modal-body-logout">
                        <section class="section_logout">
                            
                            <div class="div-logout d-flex flex-column align-items-center justify-content-center mt-3">
                                <img src="../imgs/checked.png" alt="Log Out" class="img-logout">
                                <h5 class="text-center mt-2 modal-txt">After approving the rental application, you'll be asked to provide a lease agreement.</h5>
                            </div>

                        </section>
                    </div>

                    <div class="modal-footer d-flex gap-2 p-3">
                        <button type="button" class="btn btn-cancel modal-btns px-4 py-2" data-bs-dismiss="modal">Review</button>
                        <a onclick="acceptApplication()" class="btn btn-ok modal-btns px-4 py-2 d-flex align-items-center justify-content-center">Proceed</a>
                    </div>
                </div>
            </div>
        </div>
    <!-- modal end - CONFIRMATION -->   
    
    <!-- MODAL REJECT -->
        <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content modals container_modalReject">

                    <div class="modal-header modal-header-logout p-3">
                        <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body modal-body-logout">
                        <section class="section_logout">
                            
                            <div class="div-logout d-flex flex-column align-items-center justify-content-center mt-3">
                                <img src="../imgs/question.png" alt="Log Out" class="img-logout">
                                <h5 class="text-center mt-2 modal-txt">Are you sure you want to reject the application?</h5>
                            </div>

                        </section>
                    </div>

                    <div class="modal-footer d-flex gap-2 p-3">
                        <button type="button" class="btn btn-cancel modal-btns px-4 py-2" data-bs-dismiss="modal">No</button>
                        <a class="btn btn-del modal-btns px-4 py-2 d-flex align-items-center justify-content-center" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#reasonModal">Yes</a>
                    </div>
                </div>
            </div>
        </div>
    <!-- modal end - REJECT --> 
    
    <!-- MODAL STATE REASON -->
    <div class="modal fade" id="reasonModal" tabindex="-1" aria-labelledby="reasonModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content modals container_modalReason">

                <div class="modal-header modal-header-logout p-3">
                    <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body modal-body-logout">
                    <section class="section_logout">
                        
                        <div class="div-logout d-flex flex-column align-items-center justify-content-center mt-3">
                            <img src="../imgs/question.png" alt="Log Out" class="img-logout">
                            <h5 class="text-center mt-2 modal-txt">Please let the renter know your reason for rejecting the application.</h5>
                            <textarea name="" id="txtReason" class="txtarea-reason p-3 mt-2" id="" cols="" rows="" placeholder="State reason here..."></textarea>
                        </div>

                    </section>
                </div>

                <div class="modal-footer d-flex gap-2 p-3">
                    <button type="button" class="btn btn-cancel modal-btns px-4 py-2" data-bs-dismiss="modal">Cancel</button>
                    <a onclick="rejectApplication()" class="btn btn-del modal-btns px-4 py-2 d-flex align-items-center justify-content-center">Submit</a>
                </div>
            </div>
        </div>
    </div>
<!-- modal end - STATE REASON --> 


    <!-- MODAL SUBMITTED -->
        <div class="modal fade" id="submittedModal" tabindex="-1" aria-labelledby="submittedModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content modals container_modalSubmitted">

                    <div class="modal-header p-3">
                        <button type="button" class="btn-close btn-close-modal" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body modal-body-logout">
                        <section class="section_logout">
                            
                            <div class="div-modal d-flex flex-column align-items-center justify-content-center mt-4">
                                <img src="../imgs/house.png" alt="" class="img-modal">
                                <h5 class="text-center mt-2">Application Submitted Successfully</h5>
                            </div>
                        </section>
                    </div>

                    <div class="modal-footer d-flex gap-2 p-3">
                        <a id="btnFinished" onclick="Ok()" class="btn btn-ok modal-btns d-flex align-items-center justify-content-center">Ok</a>
                    </div>
                </div>
            </div>
        </div>
    <!-- modal end - SUBMITTED -->

            <div class="d-none">
                <input type="text" id="txtPropertyId" value="<?php echo $propertyId ?>">
                <input type="text" id="txtrenterId" value="<?php echo $renterId ?>">
                <input type="text" id="txtLandlordid" value="<?php echo $lgetId['lID'] ?>">
            </div>

        <!-- MAIN -->

            <div class="container-fluid container-submit ">

                <section class="submit-header mt-5 px-3 px-md-5 d-flex align-items-center">
                <?php
                    if(!isset($_GET['viewInfo']) || $_GET['viewInfo'] == ""){
                        ?>
                    <h2 class="submit-header-txt">Approve Application</h2>
                    <?php
                    }
                    else{
                        ?>
                        <h2 class="submit-header-txt">Rental Application Form</h2>
                        <?php
                    }
                    ?>
                </section>

                <!-- NOTE SECTION -->\
                <?php
                    if(!isset($_GET['viewInfo']) || $_GET['viewInfo'] == ""){
                        ?>
                        <section class="section-note mt-5 mb-3">
                            <p class="mb-3"><b>Hooray!</b> </p>
                            <p>A renter wants to rent in one of your listed properties. Attached here is his/her application form. Carefully review all of the information given before approving his/her application.</p>     
                        </section>
                        <?php
                    }
                    ?>

            <!-- PROPERTY INFO SECTION -->
                <section class="section-property-info">
                    <h4 class="info-txt">Property Information</h4>
                    <div class="row mt-3">
                        <div class="col-xxl-4 col-xl-3 col-lg-4 col-md-5 col-sm-5 col-12">
                            <img src="<?php echo $setImg1 ?>" alt="" class="img-submit-page img-fluid">
                        </div>

                        <div class="col-xxl-8 col-xl-9 col-lg-8 col-md-7 col-sm-7 d-flex flex-column ps-md-4 ps-sm-3 mt-lg-2 mt-md-3 mt-sm-4 mt-4">

                            <h3 class="property-title"><?php echo $getPropertyinfo['propertyTitle'] ?></h3>
                            <div class="div-price mt-3 d-flex gap-2">
                                <h4 class="property-price"> ₱ <?php echo number_format($getPropertyinfo['propertyPrice']) ?> </h4> 
                            </div>
                            <p class="property-location mt-3"><?php echo $getPropertyinfo['propertyCity'] . ',' . $getPropertyinfo['propertyProvince']; ?></p>

                            <a href="../viewProperty.php?id=<?php echo $propertyId ?>" class="view-more mt-lg-5 mt-md-4 mt-sm-1 mt-5 mb-3">View more property details</a>

                        </div>
                    </div>
                </section>

            

                <section class="section-submit-form">
                    <div class="submit-form">
                        <div class="row">

                        <!-- RENTER INFORMATION -->
                            <div class="col-md-6 col-sm-12 form-renter-info p-5">

                                <div class="d-flex justify-content-center mb-5">
                                    <h5 class="form-label-submit">Renter's information</h5>
                                </div>

                            <!-- pakiAutofill po to since nasa registration nia na po hehe -->
                                <div class="mb-3">
                                    <label for="rFName" class="form-label form-label-submit ps-1">First Name </label>
                                    <p type="text" class="px-1 py-2" id="rFName" > <?php echo $getrenterInfo['rFname'] ?> </p>
                                </div>

                                <div class="mb-3">
                                    <label for="rLName" class="form-label form-label-submit ps-1">Last Name </label>
                                    <p type="text" class="px-1 py-2" id="rLName" > <?php echo $getrenterInfo['rLname'] ?> </p>
                                </div>

                                <div class="mb-3">
                                    <label for="rEmail" class="form-label form-label-submit ps-1">Email address </label>
                                    <p type="email" class="px-1 py-2" id="rEmail" > <?php echo $getrenterInfo['rEmail'] ?> </p>
                                </div>

                                <div class="mb-3">
                                    <label for="rNum" class="form-label form-label-submit ps-1">Mobile Number </label>
                                    <p type="text" class="px-1 py-2" id="rNum"> <?php echo $getrenterInfo['rNum'] ?> </p>
                                </div>

                                <div class="mb-3">
                                    <label for="rBday" class="form-label form-label-submit ps-1">Birthdate </label>
                                    <p type="text" class="px-1 py-2" id="rBday"> <?php echo $birthdayFormat ?> </p>
                                </div>

                                <div class="mb-3">
                                    <label for="rOccupation" class="form-label form-label-submit ps-1">Occupation </label>
                                    <p type="text" class="px-1 py-2" id="rOccupation"> <?php echo $getrenterInfo['rOccupation'] ?> </p>
                                </div>

                            <div class="">
                                <label for="rOccupants" class="form-label form-label-submit ps-1">Total number of occupants </label>
                                <p class="form-control px-3 py-2 form-control-submit form-control-submit-r" id="rOccupants" placeholder="How many are you to occupy?" disabled readonly>
                                    <?php echo $getApplicationinfo['Ocuupant_No'] ?>
                                </p>
                            </div>
                            <div class="mt-3">
                                <label for="rOccupants" class="form-label form-label-submit ps-1">Preferred monthly rent payment date </label>
                                <p class="form-control px-3 py-2 form-control-submit form-control-submit-r" id="" placeholder="" disabled readonly>
                                    Every <span><b><?php echo $getApplicationinfo['preferred_monthly_rent'] ?></b> </span>day of the month
                                </p>
                            </div>
                                
                            </div>

                            <!-- LANDLORD INFORMATION -->
                            <div class="col-md-6 col-sm-12 form-landlord-info p-5">
                                <div class="d-flex justify-content-center mb-5">
                                    <h5 class="form-label-submit">Your information</h5>
                                </div>

                                <div class="mb-3">
                                    <label for="lFName" class="form-label form-label-submit ps-1">First Name </label>
                                    <p type="text" class="px-1 py-2" id="lFName"> <?php echo $lgetId['lFname'] ?> </p>
                                </div>

                                <div class="mb-3">
                                    <label for="lLName" class="form-label form-label-submit ps-1">Last Name </label>
                                    <p type="text" class="px-1 py-2" id="lLName"> <?php echo $lgetId['lLname'] ?> </p>
                                </div>

                                <div class="mb-3">
                                    <label for="lEmail" class="form-label form-label-submit ps-1">Email address </label>
                                    <p type="email" class="px-1 py-2" id="lEmail"> <?php echo $lgetId['lEmail'] ?> </p>
                                </div>

                                <div class="mb-3">
                                    <label for="lNum" class="form-label form-label-submit ps-1">Mobile Number </label>
                                    <p type="text" class="px-1 py-2" id="lNum"> <?php echo $lgetId['lNumber'] ?> </p>
                                </div>

                                <div class="">
                                    <p class="ps-1">The landlord of this property is <br> <span class="verified-stat">FULLY VERIFIED <img src="../imgs/verified.png" alt="" style="width: 20px;"></span>  as he/she submitted necessary documents required to confirm identity and ensure legitimacy.</p>
                                </div>
                            </div>
                        </div>

                    <div class="document-form p-5">

                        <!-- RESIDENCE HISTORY -->
                        <div class="residence-history">
                            <div class="d-flex justify-content-center">
                                <h5 class="form-label-submit mb-4">Renter's Residence History</h5>
                            </div>

                            <!-- CURRENT -->
                            <div>
                                <p class="form-label-submit mb-2 ps-1">CURRENT RESIDENCY</p>
                                <div class="mb-3">
                                    <label for="rAddress" class="form-label form-label-submit ps-1">Complete Address </label>
                                    <input type="text" class="form-control px-3 py-2 form-control-submit form-control-submit-r" id="rAddress" value="<?php echo ucwords($getApplicationinfo['current_complete_address']) ?>" placeholder="Please provide your current complete address" disabled readonly>
                                </div>

                                <div class="row">

                                    <!-- Length of stay -->
                                    <div class="d-flex flex-column col-md-6 col-sm-12 mb-3">
                                            <label for="" class="form-label form-label-submit ps-1">How long do you live here? </label>
                                            <input type="text" class="form-control px-3 py-2 form-control-submit form-control-submit-r" id="rAddress" value="<?php echo $getApplicationinfo['current_year'] ?>" placeholder="Please provide your current complete address" disabled readonly>

                                            <!-- <div class="dropdown typeMenuSm">
                                                <button onclick="ddFloorFunction()" onblur="blurFunction()" value="<?php echo $getApplicationinfo['current_year'] ?>" class="btn dropdown-toggle propertyType d-flex justify-content-between rental-inputs" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <span class="btn-txt-bed-sm"><?php echo $getApplicationinfo['current_year'] ?></span>
                                                </button>
                                            </div> -->
                                        </div>

                                    <!-- RESIDENCY TYPE -->
                                    <div class="col-md-6 col-sm-12 mb-3 ps-md-3 ps-0">
                                        <label for="residencyType" class="form-label-submit ">Type of residency </label><br>
                                        <div class="btn-group gap-1"> 
                                            <?php if($getApplicationinfo['current_type_of_residence'] == "Own"){?>
                                            <input type="radio" name="rad-residency" value="Rent" id="rad-rent" onclick="radiorecidence()" class="btn-check" disabled>
                                            <label for="rad-rent" class="btnResidency rad-rent-select" id="rad-rent">Rent</label>
                                            <input type="radio" name="rad-residency" value="Own" id="rad-own" onclick="radiorecidence()" class="btn-check" checked disabled>
                                            <label for="rad-own" class="btnResidency rad-own-selected" id="rad-own">Own</label>
                                            <?php
                                            }
                                            else{
                                                ?>
                                            <input type="radio" name="rad-residency" value="Rent" id="rad-rent" onclick="radiorecidence()" class="btn-check" checked disabled>
                                            <label for="rad-rent" class="btnResidency rad-rent-selected" id="rad-rent">Rent</label>
                                            <input type="radio" name="rad-residency" value="Own" id="rad-own" onclick="radiorecidence()" class="btn-check" disabled>
                                            <label for="rad-own" class="btnResidency rad-own-select" id="rad-own">Own</label>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                    if($getApplicationinfo['current_type_of_residence'] != "Own"){
                                    ?>
                                    <!-- MONTHLY PAYMENT -->
                                    <!-- <div class="col-md-6 col-sm-12 ps-1" id="divpayment">
                                        <label for="" class="form-label form-label-submit ps-1 ">Monthly payment/rent </label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text px-3 spans ">₱</span>
                                            <input type="text" class="form-control form-control-submit p-2 form-control-submit-r" id="rcurMonthlyPayment" value="<?php echo $getApplicationinfo['current_payment'] ?>" placeholder="" disabled readonly>
                                        </div>
                                    </div> -->

                                    <!--  -->
                                    <div class="col-md-6 col-sm-12" id="divlandlordname">
                                        <div class="mb-3">
                                            <label for="rcurLandlordName" class="form-label form-label-submit ps-1">Landlord Name <span class="if-renting">if renting</span></label>
                                            <input type="text" class="form-control px-3 py-2 form-control-submit form-control-submit-r" id="rcurLandlordName" value="<?php echo $getApplicationinfo['current_landlordname'] ?>" placeholder="" disabled readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 ps-md-3 ps-0" id="divlandlordnumber">
                                        <div class="mb-3">
                                            <label for="rcurLandlordNum" class="form-label form-label-submit ps-1">Landlord Contact No.</label>
                                            <input type="text" class="form-control px-3 py-2 form-control-submit form-control-submit-r" id="rcurLandlordNum" value="<?php echo $getApplicationinfo['current_contact_number'] ?>" placeholder="" disabled readonly>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>

                                <!-- REASONS -->
                                <div class="mb-3">
                                    <label for="rReason" class="form-label form-label-submit ps-1">Reason/s for leaving</label>
                                    <input type="text" class="form-control px-3 py-2 form-control-submit form-control-submit-r" id="rcurReason" value="<?php echo $getApplicationinfo['current_reason'] ?>" placeholder="" disabled readonly>
                                </div>

                                


                            </div>

                            <!-- PRIOR -->
                            <div class="mt-5">
                                <p class="form-label-submit mb-2 ps-1">PRIOR RESIDENCY</p>

                                <div class="mb-3">
                                    <label for="pastrAddress" class="form-label form-label-submit ps-1">Complete Address</label>
                                    <input type="text" class="form-control px-3 py-2 form-control-submit form-control-submit-r" value="<?php echo ucwords($getApplicationinfo['past_address']) ?>" id="pastrAddress" placeholder="Please provide your current complete address" disabled readonly>
                                </div>

                                <div class="row">

                                <!-- Length of stay -->
                                    <div class="d-flex flex-column col-md-6 col-sm-12 mb-3">
                                        <label for="" class="form-label form-label-submit ps-1">How long do you live here?</label>
                                        <input type="text" class="form-control px-3 py-2 form-control-submit form-control-submit-r" id="rAddress" value="<?php echo $getApplicationinfo['past_year'] ?>" placeholder="Please provide your current complete address" disabled readonly>
                                        <!-- <div class="dropdown typeMenuSm">
                                            <button onclick="ddAmenityFunction()" onblur="blurFunction()" id="<?php echo $getApplicationinfo['past_year'] ?>" value="Any" class="btn dropdown-toggle propertyType d-flex justify-content-between rental-inputs" type="button" data-bs-toggle="dropdown" aria-expanded="false" disabled readonly>
                                                <span class="btn-txt-type-sm"><?php echo $getApplicationinfo['past_year'] ?></span>
                                            </button>
                                        </div> -->
                                    </div>

                                <!-- RESIDENCY TYPE -->
                                    <?php
                                    if($getApplicationinfo['past_recidency_type'] == "Own" || $getApplicationinfo['past_recidency_type'] == "Rent"){
                                    ?>
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="residencyType" class="form-label-submit ps-1">Type of residency</label><br>
                                        <div class="btn-group gap-1"> 
                                            <?php if($getApplicationinfo['past_recidency_type'] == "Rent"){
                                            ?>
                                            <input type="radio" name="rad-residency2" value="Rent" id="rad-rent2" class="btn-check" checked disabled>
                                            <label for="rad-rent2" class="btnResidency2 rad-rent-selected" id="rad-rent2">Rent</label>
                                            <input type="radio" name="rad-residency2" value="Own" id="rad-own2" class="btn-check" disabled>
                                            <label for="rad-own2" class="btnResidency2 rad-own-select" id="rad-own2">Own</label>
                                            <?php
                                            }
                                            else if($getApplicationinfo['past_recidency_type'] == "Own"){
                                            ?>
                                            <input type="radio" name="rad-residency2" value="Rent" id="rad-rent2" class="btn-check" disabled>
                                            <label for="rad-rent2" class="btnResidency2 rad-rent-select" id="rad-rent2">Rent</label>
                                            <input type="radio" name="rad-residency2" value="Own" id="rad-own2" class="btn-check" checked disabled>
                                            <label for="rad-own2" class="btnResidency2 rad-own-selected" id="rad-own2">Own</label>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>

                                    <?php if($getApplicationinfo['past_recidency_type'] == "Rent"){
                                        ?>
                                    <!-- MONTHLY PAYMENT -->
                                    <!-- <div class="col-md-6 col-sm-12 ps-1">
                                        <label for="" class="form-label form-label-submit ps-1">Monthly payment/rent</label>
                                        <div class="input-group mb-3 ">
                                            <span class="input-group-text px-3 spans ">₱</span>
                                            <input type="text" class="form-control form-control-submit p-2 form-control-submit-r" id="rMonthlyPayment" value="<?php echo $getApplicationinfo['past_monthly_payment'] ?>" placeholder="" disabled readonly>
                                        </div>
                                    </div> -->
                                    <div class="col-md-6 col-sm-12">
                                        <div class="mb-3">
                                            <label for="rLandlordName" class="form-label form-label-submit ps-1">Landlord Name <span class="if-renting">if renting</span></label>
                                            <input type="text" class="form-control px-3 py-2 form-control-submit form-control-submit-r"  value="<?php echo $getApplicationinfo['past_landlordname'] ?>" id="rLandlordName" placeholder="" disabled readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 ps-md-3 ps-0 ">
                                        <div class="mb-3">
                                            <label for="rLandlordNum" class="form-label form-label-submit ps-1">Landlord Contact No.</label>
                                            <input type="text" class="form-control px-3 py-2 form-control-submit form-control-submit-r" value="<?php echo $getApplicationinfo['past_landlordcontact'] ?>" id="rLandlordNum" placeholder="" disabled readonly>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>

                                <!-- REASONS -->
                                <div class="mb-3">
                                    <label for="rReason" class="form-label form-label-submit ps-1">Reason/s for leaving</label>
                                    <input type="text" class="form-control px-3 py-2 form-control-submit form-control-submit-r"  value="<?php echo $getApplicationinfo['past_reason'] ?>" id="rReason" placeholder="" disabled readonly>
                                </div>

                                <div class="row mt-5">
                                    <!-- EVICTED -->
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="residencyType" class="form-label-submit ps-1">Have you ever been evicted? </label><br>
                                        <div class="btn-group gap-1"> 
                                            <?php
                                            if($getApplicationinfo['evicted_info'] == "YES"){
                                                ?>
                                            <input type="radio" name="rad-evicted" value="YES" id="rad-yes" class="btn-check" checked disabled>
                                            <label for="rad-yes" class="btnEvicted yes-evicted-selected" id="rad-yes">Yes</label>
                                            <input type="radio" name="rad-evicted" value="NO" id="rad-no" class="btn-check" disabled>
                                            <label for="rad-no" class="btnEvicted not-evicted-select" id="rad-no">No</label>
                                            <?php
                                            }
                                            else{
                                                ?>
                                            <input type="radio" name="rad-evicted" value="YES" id="rad-yes" class="btn-check" disabled>
                                            <label for="rad-yes" class="btnEvicted yes-evicted-select" id="rad-yes">Yes</label>
                                            <input type="radio" name="rad-evicted" value="NO" id="rad-no" class="btn-check" checked disabled>
                                            <label for="rad-no" class="btnEvicted not-evicted-selected" id="rad-no">No</label>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 ps-md-3 ps-0 mb-3">
                                        <label for="residencyType" class="form-label-submit ps-1">Have you ever broken a lease? </label><br>
                                        <div class="btn-group gap-1"> 
                                        <?php
                                            if($getApplicationinfo['broke_lease'] == "YES"){
                                                ?>
                                            <input type="radio" name="rad-broken" value="YES" id="rad-bYes" class="btn-check" checked disabled>
                                            <label for="rad-bYes" class="btnBroken yes-broke-selected" id="rad-bYes">Yes</label>
                                            <input type="radio" name="rad-broken" value="NO" id="rad-bNo" class="btn-check" disabled>
                                            <label for="rad-bNo" class="btnBroken no-broke-select" id="rad-bNo">No</label>
                                            <?php
                                            }
                                            else{
                                                ?>
                                            <input type="radio" name="rad-broken" value="YES" id="rad-bYes" class="btn-check" disabled>
                                            <label for="rad-bYes" class="btnBroken yes-broke-select" id="rad-bYes">Yes</label>
                                            <input type="radio" name="rad-broken" value="NO" id="rad-bNo" class="btn-check" checked disabled>
                                            <label for="rad-bNo" class="btnBroken no-broke-selected" id="rad-bNo">No</label>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                


                            </div>
                        </div>


                        <br><br>

                    <!-- UPLOAD ID -->
                        <div class="confirm-identity">
                            <div class="d-flex justify-content-center">
                                <h5 class="form-label-submit mb-3">Confirm Renter's Identity</h5>
                            </div>

                            <p class="mb-1 form-label-submit">Renter's ID </p>
                            <p class="mb-3">Attached here are the front and back of the renter's government issued ID. </p>

                                <!-- IDS -->
                                <div class="d-flex justify-content-center mt-5 row">
                                    <div class="d-flex flex-column align-items-center justify-content-center col-md-6 col-12">
                                        <img src="<?php echo $imgFront ?>" alt="" class="frontback-id canvases">
                                        <p class="frontback-id-txt text-center mt-2">Front ID</p>
                                    </div>
                                    <div class="d-flex flex-column align-items-center justify-content-center col-md-6 col-12">
                                        <img src="<?php echo $imgBack ?>" alt="" class="frontback-id canvases">
                                        <p class="frontback-id-txt text-center mt-2">Back ID</p>
                                    </div>
                                </div>

                        <!-- ID MATCHING -->
                        <div class="mt-4">
                            <p class="form-label-submit mb-1">Face & ID Matching </p>
                            <p class="mb-3">Attached here is the selfie of the renter together with his/her ID. This will help you confirm his/her identity.</p>
                            
                            <div class="d-flex align-items-center justify-content-center">
                                <img src="<?php echo $imgMatch ?>" alt="" class="faceid canvases">
                            </div>
                        </div>


                        </div>

                        <!-- CLEARANCE -->
                        <div class="mt-4">
                            <p class="form-label-submit mb-1">Upload Clearance</p>
                                <p class="mb-3">Attached here is the clearance of the renter for security purposes.</p>
                                <div class="d-flex justify-content-center">
                                    <div class="box boxes box-clearance d-flex align-items-center justify-content-center flex-column frontImg">
                                        <img src="<?php echo $imgDocu ?>" alt="" class="canvases clearance-canvas">
                                    </div>
                                </div>
                        </div>

                    </div>

                    

                </section>




                <section class="footer-submit d-flex justify-content-between">
                    
                    <a onclick="GobackPage()" class="btn-back ps-2 pt-2 mt-4">
                        <i class="bi bi-arrow-left"></i>&nbsp;Back
                    </a>

                    <?php
                    if(!isset($_GET['viewInfo']) || $_GET['viewInfo'] == ""){
                        ?>
                        <div class="d-flex gap-2 mt-4">
                            <a href="" class="btn footer-btns btn-cancel-main px-4 py-2 text-light" data-bs-toggle="modal" data-bs-target="#rejectModal" id="">Reject</a>
                            <a href="" class="btn footer-btns btn-go px-4 py-2 text-light " data-bs-toggle="modal" data-bs-target="#confirmModal" id="" onclick="">Approve Application</a>
                        </div>
                        <?php
                    }
                    ?>
                </section>

                <br><br>
            </div>
        <!-- </div> -->






















        <!-- ```````````````````````````````` -->

            <script>
                function blurFunction(){
                    var upAvatar = document.getElementById("chevron-up-avatar");
                    var downAvatar = document.getElementById("chevron-down-avatar");
                    var upAvatar2 = document.getElementById("chevron-up-avatar2");
                    var downAvatar2 = document.getElementById("chevron-down-avatar2");
                    var upFloor = document.getElementById("upFloor");
                    var downFloor = document.getElementById("downFloor");
                    var upAmenity = document.getElementById("upAmenity");
                    var downAmenity = document.getElementById("downAmenity");
                    
                    upAvatar.style.display = "none";
                    downAvatar.style.display = "inline-block";

                    upAvatar2.style.display = "none";
                    downAvatar2.style.display = "inline-block";

                    upFloor.style.display = "none";
                    downFloor.style.display = "inline-block";

                    upAmenity.style.display = "none";
                    downAmenity.style.display = "inline-block";
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
            </script>
        </body>
        </html>

    <!-- <?php
        }
        else{
            echo "<script>window.location.href = 'application1Empty.php'</script>";
        }
    }
else {
    echo "<script>window.history.back();</script>";
}
    // Close the database connection
    mysqli_close($con);
?> -->