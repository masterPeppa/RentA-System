 <?php
session_start();
include('../DataBase/connection.php');
if(isset($_SESSION['rEmail'])){
    $renterEmail = $_SESSION['rEmail'];
    $selectUser = "SELECT * FROM user_renter WHERE rEmail ='$renterEmail'";
    $executeSelectUser = mysqli_query($con, $selectUser);
    $getUser = mysqli_fetch_assoc($executeSelectUser);

    $dateFormat = DateTime::createFromFormat("Y-m-d", $getUser['rBday']);
    $birthdate = $dateFormat->format("m/d/Y");

    $userProfile = $getUser['rImgProfile'];

    //update the image in data base
    $getId = "SELECT * FROM application_data WHERE renter_id='".$getUser['rId']."' AND send_status != '0' AND
    agreement != 'finished'";
    $rcheckId = mysqli_query($con, $getId);
    $rcountidexistence = mysqli_num_rows($rcheckId);
    $rcheckidexistence = mysqli_fetch_assoc($rcheckId);

    if($rcountidexistence > 0){
        $updatesentstatus = "UPDATE application_data SET receive_status='received' WHERE renter_id='".$getUser['rId']."' 
        AND landlord_id='".$rcheckidexistence['landlord_id']."' AND property_id='".$rcheckidexistence['property_id']."'";
        $executeupdatestatus = mysqli_query($con, $updatesentstatus);
        if($rcheckidexistence['send_status'] == "1"){
            echo "<script>window.location.href = 'application2Approval.php'</script>";
        }
        else if($rcheckidexistence['send_status'] == "2"){
            echo "<script>window.location.href = 'application3LeaseWait.php'</script>";
        }
        else if($rcheckidexistence['send_status'] == "3"){
            echo "<script>window.location.href = 'application3LeaseWait.php'</script>";
        }
        else if($rcheckidexistence['send_status'] == "4"){
            echo "<script>window.location.href = 'application4Move.php'</script>";
        }
        else if($rcheckidexistence['send_status'] == "5" && $rcheckidexistence['agreement'] == "applied"){
            echo "<script>window.location.href = 'application5Feedback.php'</script>";
        }
        else if($rcheckidexistence['send_status'] == "rejected"){
            echo "<script>window.location.href = 'application2Rejected.php'</script>";
        }
    }
    else{
        
        if(isset($_SESSION['applyProperty'])){
            echo "<script type='text/javascript'>
                setTimeout(function(){
                    window.location.href='application1Submit.php?property=".$_SESSION['applyProperty']."';
                });
            </script>";
            unset($_SESSION['applyProperty']);
        }        
        else if(isset($_GET['property']) && $_GET['property'] != ""){
            $propertyId = $_GET['property'];
            //get property information
            $selectId = "SELECT * FROM landing_properties WHERE propertyID='$propertyId'";
            $executeSelectedid = mysqli_query($con, $selectId);
            $getPropertyinfo = mysqli_fetch_assoc($executeSelectedid);
            $setImg1 = "../" . str_replace("../", "", $getPropertyinfo['imgFeatured1']);

            //get landlord information
            $selectLandlord = "SELECT * FROM user_landlord WHERE lID='".$getPropertyinfo['landlord_id']."'";
            $executeSelectLandlord = mysqli_query($con, $selectLandlord);
            $getLandlordInfo = mysqli_fetch_assoc($executeSelectLandlord);
            ?> 
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>RentA | Application Page</title>
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
                        <img src="<?php echo $userProfile ?>" alt="" class="img-avatar">
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
                        <a class="dropdown-item d-flex justify-content-between" href="../messages.php" id="smmessageCount"> 
                        </a>
                    </li>
                    <li><a class="dropdown-item" href="../favorites.php">Favorites</a></li>
                    <li><a class="dropdown-item " href="renterProfile.php">My Profile</a></li>
                    <li><a class="dropdown-item dropdown-item-last" data-bs-toggle="modal" data-bs-target="#logoutModal">Log out</a></li>
                </ul>
                </div>

                <!-- links center -->
                <div class="collapse navbar-collapse" id="navMenuRenter">

                    <ul class="navbar-nav navbar-nav-renter d-flex align-items-center ms-auto">
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
                                <li><a class="dropdown-item dropdown-item-first active-dropdown" href="application1Submit.php">Application</a></li>
                                <li><a class="dropdown-item" href="manageMonthlyRent.php">Monthly Rent</a></li>
                                <li><a class="dropdown-item dropdown-item-last" href="manageRentalConcern.php">Rental Concern</a></li>
                                
                            </ul>
                    </li>

                       <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link" href="application1Submit.php">Application</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link" href="manageMonthlyRent.php">Monthly Rent</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link " href="manageRentalConcern.php">Rental Concern</a>
                        </li>
                    </ul>

                    <ul class="d-flex align-items-center ms-auto">
                        <!-- Avatar - Renter big-->
                        <div class="dropdown ">
                            <button onclick="dropdownAvatarFunction2()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block" type="button" id="dropdrownbtn-avatar" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?php echo $userProfile ?>" alt="" class="img-avatar me-1">
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
                                    <a class="dropdown-item d-flex justify-content-between" href="../messages.php" id="messageCount">Messages 
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


        <!-- MODAL SUBMITTED -->
            <div class="modal fade" id="submitdoneModal" tabindex="-1" aria-labelledby="submittedModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content modals container_modalSubmitted">

                        <div class="modal-header p-3">
                            <button type="button" class="btn-close btn-close-modal" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body modal-body-logout">
                            <section class="section_logout">
                                
                                <div class="div-modal d-flex flex-column align-items-center justify-content-center mt-4">
                                    <img src="../imgs/house-check1.png" alt="" class="img-modal">
                                    <h5 class="text-center mt-2">Application Submitted Successfully</h5>
                                </div>
                            </section>
                        </div>

                        <div class="modal-footer d-flex gap-2 p-3">
                            <a id="btnFinished" onclick="Ok()" class="btn btn-ok modal-logout-btns d-flex align-items-center justify-content-center">Ok</a>
                        </div>
                    </div>
                </div>
            </div>
        <!-- modal end - SUBMITTED -->

        <!-- modal preparation -->
        <div class="modal fade" data-bs-backdrop="static" id="preparationModal" tabindex="-1" aria-labelledby="submittedModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content modals container_modalPrep">

                        <!-- <div class="modal-header p-3">
                            <button type="button" class="btn-close btn-close-modal" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div> -->

                        <div class="modal-body modal-body-logout pt-2">
                            <section class="section_logout">
                                
                                <div class="div-prep-modal d-flex flex-column">
                                    <p class="mt-2 px-5">Upon application, you'll need these documents for verification purposes: 
                                        <br> <br>
                                        <b>1 Government issued ID either: </b> <br>
                                        &emsp;Driver's License <br>
                                        &emsp;Passport <br>
                                        &emsp;HDMF (Pag-Ibig) ID <br>
                                        &emsp;UMID<br> 
                                        &emsp;SSS ID <br>
                                        &emsp;Philsys ID <br>
                                        &emsp;Philippine Postal ID<br>
                                        &emsp;PRC ID <br>
                                        &emsp;ePhilID <br> <br>
                                        
                                        <b> 1 Clearance either: </b><br>
                                        &emsp;Barangay Clearance <br>
                                        &emsp;Police Clearance <br>
                                        &emsp;NBI Clearance<br> <br> 

                                        
                                        <b> Do you wish to proceed now? </b> <br> 
                                        <span class="tip"><b>Tip: </b> You can save this property to your favorites <i class="bi bi-heart"></i> while preparing your documents and apply later on. </span>

                                    </p>

                                </div>
                            </section>
                        </div>

                        <div class="modal-footer d-flex gap-2 p-3">
                        <a onclick="GobackPage()" class="btn btn-cancel modal-logout-btns d-flex align-items-center justify-content-center">No</a>
                        <button type="button" class="btn btn-ok modal-logout-btns" data-bs-dismiss="modal">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        <!--end - modal preparation -->

        <!-- MAIN -->

            <div class="container-fluid container-submit ">

                <section class="submit-header mt-5 px-3 px-md-5 d-flex align-items-center">
                    <h2 class="submit-header-txt">Application</h2>
                </section>

            
            <!-- PROGRESS BAR -->
                <section class="section-progress d-flex align-items-center justify-content-center">
                
                    <div class="stepper-wrapper d-flex justify-content-between w-100">
                        <div class="stepper-item d-flex flex-column align-items-center active">
                            <div class="step-counter d-flex align-items-center justify-content-center">1</div>
                            <div class="step-name mt-2 active">Application</div>
                        </div>
                        <div class="stepper-item d-flex flex-column align-items-center">
                            <div class="step-counter d-flex align-items-center justify-content-center">2</div>
                            <div class="step-name mt-2">Approval</div>
                        </div>
                        <div class="stepper-item d-flex flex-column align-items-center">
                            <div class="step-counter d-flex align-items-center justify-content-center">3</div>
                            <div class="step-name mt-2">Settle Lease</div>
                        </div>
                        <div class="stepper-item d-flex flex-column align-items-center">
                            <div class="step-counter d-flex align-items-center justify-content-center">4</div>
                            <div class="step-name mt-2">Move-in</div>
                        </div>
                        <div class="stepper-item d-flex flex-column align-items-center">
                            <div class="step-counter d-flex align-items-center justify-content-center">5</div>
                            <div class="step-name mt-2">Feedback</div>
                        </div>
                    </div>

                </section>

        <!-- <div class="pad d-flex flex-column justify-content-center align-items-center"> -->
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
                            <p class="property-location mt-3"><?php echo $getPropertyinfo['propertyCity'] . ', ' . $getPropertyinfo['propertyProvince']; ?></p>

                            <a href="../viewProperty.php?id=<?php echo $propertyId   ?>" class="view-more mt-lg-5 mt-md-4 mt-sm-1 mt-5">View more property details</a>

                        </div>
                    </div>
                </section>

            <!-- NOTE SECTION -->
                <section class="section-note">
                    <p><b>Note:</b> Please review all the information about the property before submitting an application.
                        After it, please complete this rental application form for the property above. 
                        The information you provide is for appplying for tenancy and will be used for reference check. 
                        Your privacy is protected under the <b><i>Privacy Act 2020</i> </b> .</p>
                </section>

                <section class="section-submit-form">
                    <div class="submit-form">
                        <div class="row">

                        <!-- RENTER INFORMATION -->
                            <div class="col-md-6 col-sm-12 form-renter-info p-5">

                                <div class="d-flex justify-content-center mb-4">
                                    <h5 class="form-label-submit">Your information</h5>
                                </div>
                                

                                <div class="mb-3">
                                    <label for="rFName" class="form-label form-label-submit ps-1">First Name</label>
                                    <p type="text" onkeydown="return /^([a-z A-Z])*$/i.test(event.key)" class="px-1 py-2 " id="rFName" > <?php echo $getUser['rFname'] ?> </p>
                                </div>

                                <div class="mb-3">
                                    <label for="rLName" class="form-label form-label-submit ps-1">Last Name </label>
                                    <p type="text" onkeydown="return /^([a-z A-Z])*$/i.test(event.key)" class="px-1 py-2" id="rLName"> <?php echo $getUser['rLname'] ?> </p>
                                </div>

                                <div class="mb-3">
                                    <label for="rEmail" class="form-label form-label-submit ps-1">Email address </label>
                                    <p type="email" class="px-1 py-2" id="rEmail"> <?php echo $getUser['rEmail'] ?> </p>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="rNum" class="form-label form-label-submit ps-1">Mobile Number </label>
                                    <p type="text" minlength="11" maxlength="11" onkeydown="return /^([0-9]|Backspace)*$/i.test(event.key) || event.key.length > 1" class="px-1 py-2" id="rNum"> <?php echo $getUser['rNum'] ?> </p>
                                    </div>

                                <div class="mb-3">
                                    <label for="rBday" class="form-label form-label-submit ps-1">Birthdate </label>
                                    <p type="text" class="px-1 py-2" id="rBday"> <?php echo $birthdate ?> </p>
                                </div>

                                <div class="mb-3">
                                    <label for="rOccupation" class="form-label form-label-submit ps-1">Occupation</label>
                                    <p type="text" onkeydown="return /^([a-z A-Z])*$/i.test(event.key)" class="px-1 py-2" id="rOccupation"> <?php echo $getUser['rOccupation'] ?> </p>
                                </div>

                                <div class="mb-3">
                                    <label for="rOccupants" class="form-label form-label-submit ps-1">How many are you to occupy? <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="3" onkeyup="checkmaxoccupants(this, document.getElementById('maxoccupantvalue').value)" onkeydown="return /^([0-9]|Backspace)*$/i.test(event.key) || event.key.length > 1" class="form-control px-3 py-2 form-control-submit" id="rOccupants" value="" placeholder="Maximum of <?php echo $getPropertyinfo['maxOccupants'] ?>">
                                </div>

                                <div class="d-none">
                                    <input type="text" id="maxoccupantvalue" value="<?php echo $getPropertyinfo['maxOccupants'] ?>">
                                </div>

                                <div class="">
                                    <label for="" class="form-label form-label-submit ps-1">Preferred monthly rent payment date <span class="text-danger">*</span></label>
                                    <div class="d-flex flex-wrap align-items-center gap-2 ps-1 mt-2">
                                            <p>Every</p>
                                            <div class="w-50">
                                                <div class="dropdown preferred-date-menu">
                                                    <button onclick="ddBedFunction()" onblur="blurFunction()" id="preferredDateValue" value="Please select one" class="btn dropdown-toggle preferred-date-data d-flex justify-content-between align-items-center gap-2 rental-inputs" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <span class="preferreddatespanvalue">Select one</span>
                                                        <i class="bi bi-chevron-down icons" id="downBed"></i>
                                                        <i class="bi bi-chevron-up icons" id="upBed"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dmenu dropdown-menu-living w-100">
                                                    <li class="advance-option"><a class="dropdown-item dropdownNth">1st</a></li>
                                                    <li class="advance-option"><a class="dropdown-item dropdownNth">2nd</a></li>
                                                    <li class="advance-option"><a class="dropdown-item dropdownNth">3rd</a></li>
                                                    <li class="advance-option"><a class="dropdown-item dropdownNth">4th</a></li>
                                                    <li class="advance-option"><a class="dropdown-item dropdownNth">5th</a></li>
                                                    <li class="advance-option"><a class="dropdown-item dropdownNth">6th</a></li>
                                                    <li class="advance-option"><a class="dropdown-item dropdownNth">7th</a></li>
                                                    <li class="advance-option"><a class="dropdown-item dropdownNth">8th</a></li>
                                                    <li class="advance-option"><a class="dropdown-item dropdownNth">9th</a></li>
                                                    <li class="advance-option"><a class="dropdown-item dropdownNth">10th</a></li>
                                                    <li class="advance-option"><a class="dropdown-item dropdownNth">11th</a></li>
                                                    <li class="advance-option"><a class="dropdown-item dropdownNth">12th</a></li>
                                                    <li class="advance-option"><a class="dropdown-item dropdownNth">13th</a></li>
                                                    <li class="advance-option"><a class="dropdown-item dropdownNth">14th</a></li>
                                                    <li class="advance-option"><a class="dropdown-item dropdownNth">15th</a></li>
                                                    <li class="advance-option"><a class="dropdown-item dropdownNth">16th</a></li>
                                                    <li class="advance-option"><a class="dropdown-item dropdownNth">17th</a></li>
                                                    <li class="advance-option"><a class="dropdown-item dropdownNth">18th</a></li>
                                                    <li class="advance-option"><a class="dropdown-item dropdownNth">19th</a></li>
                                                    <li class="advance-option"><a class="dropdown-item dropdownNth">20th</a></li>
                                                    <li class="advance-option"><a class="dropdown-item dropdownNth">21st</a></li>
                                                    <li class="advance-option"><a class="dropdown-item dropdownNth">22nd</a></li>
                                                    <li class="advance-option"><a class="dropdown-item dropdownNth">23rd</a></li>
                                                    <li class="advance-option"><a class="dropdown-item dropdownNth">24th</a></li>
                                                    <li class="advance-option"><a class="dropdown-item dropdownNth">25th</a></li>
                                                    <li class="advance-option"><a class="dropdown-item dropdownNth">26th</a></li>
                                                    <li class="advance-option"><a class="dropdown-item dropdownNth">27th</a></li>
                                                    <li class="advance-option"><a class="dropdown-item dropdownNth">28th</a></li>
                                                    <li class="advance-option"><a class="dropdown-item dropdownNth">29th</a></li>
                                                    <li class="advance-option"><a class="dropdown-item dropdownNth">30th</a></li>
                                                    <li class="advance-option"><a class="dropdown-item dropdownNth">31st</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <p>day of the month</p>
                                        </div>
                                </div>
                                    
                            </div>

                            <!-- LANDLORD INFORMATION -->
                            <div class="col-md-6 col-sm-12 form-landlord-info p-5">
                                <div class="d-flex justify-content-center mb-4">
                                    <h5 class="form-label-submit">Landlord's information</h5>
                                </div>

                                <div class="mb-3">
                                    <label for="lFName" class="form-label form-label-submit ps-1">First Name</label>
                                    <p type="text" class="px-1 py-2" id="lFName" value=""> <?php echo $getLandlordInfo['lFname'] ?> </p>
                                </div>

                                <div class="mb-3">
                                    <label for="lLName" class="form-label form-label-submit ps-1">Last Name</label>
                                    <p type="text" class="px-1 py-2 " id="lLName" value=""> <?php echo $getLandlordInfo['lLname'] ?> </p>
                                </div>

                                <div class="mb-3">
                                    <label for="lEmail" class="form-label form-label-submit ps-1">Email address</label>
                                    <p type="email" class="px-1 py-2 " id="lEmail" value=""> <?php echo $getLandlordInfo['lEmail'] ?> </p>
                                </div>

                                <div class="mb-3">
                                    <label for="lNum" class="form-label form-label-submit ps-1">Mobile Number</label>
                                    <p type="text" class="px-1 py-2" id="lNum" value=""> <?php echo $getLandlordInfo['lNumber'] ?> </p>
                                </div>

                                <div class="">
                                    <p class="ps-1">The landlord of this property is <br> <span class="verified-stat">FULLY VERIFIED </span> as he/she submitted necessary documents required to confirm identity and ensure legitimacy.</p>
                                </div>
                            </div>
                        </div>

                    <div class="document-form p-5">

                        <!-- RESIDENCE HISTORY -->
                        <div class="residence-history">
                            <div class="d-flex justify-content-center">
                                <h5 class="form-label-submit mb-3">Residence History</h5>
                            </div>

                            <!-- CURRENT -->
                            <div>
                                <p class="form-label-submit mb-2 ps-1">CURRENT RESIDENCY</p>
                                <div class="mb-3">
                                    <label for="rAddress" class="form-label form-label-submit ps-1">Complete Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control px-3 py-2 form-control-submit" id="rAddress" placeholder="Please provide your current complete address">
                                </div>

                                
                                <!-- <label for="" class="form-label form-label-submit ps-1">Dates of residence  <span class="text-danger">*</span></label>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text px-2 spans">From</span>
                                    <input type="text" class="form-control form-control-submit p-2" maxlength="10" minlength="10" onkeydown="return /^([0-9]|Backspace|\/)*$/i.test(event.key) || event.key.length > 1" pattern="\d{2}/\d{2}/\d{4}" placeholder="mm/dd/yyyy " id="rFrom">
                                    <span class="input-group-text px-2 spans">to</span>
                                    <input type="text" class="form-control form-control-submit p-2" maxlength="10" minlength="10" onkeydown="return /^([0-9]|Backspace|\/)*$/i.test(event.key) || event.key.length > 1" pattern="\d{2}/\d{2}/\d{4}" placeholder="mm/dd/yyy" id="rTo">
                                </div> -->

                                <div class="row">
                                    <!-- Length of stay -->
                                    <div class="d-flex flex-column col-md-6 col-sm-12 mb-3">
                                        <label for="" class="form-label form-label-submit ps-1">How long do you live here? <span class="text-danger">*</span></label>
                                        <div class="dropdown current-residence-menu">
                                            <button onclick="ddTypeFunction()" onblur="blurFunction()" id="currentResidenceValue" value="Please select one" class="btn dropdown-toggle current-btnresidency d-flex justify-content-between rental-inputs" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <span class="current-btn-txt-residence">Please select one</span>
                                                <i class="bi bi-chevron-down icons" id="downType"></i>
                                                <i class="bi bi-chevron-up icons" id="upType"></i>
                                            </button>
                                            <ul class="dropdown-menu dmenu dropdown-menu-living w-100">
                                                <li class="current-residence-option"><a class="dropdown-item current-opt-type-text">Less than 1 month</a></li>
                                                <li class="current-residence-option"><a class="dropdown-item current-opt-type-text">1 - 3 months</a></li>
                                                <li class="current-residence-option"><a class="dropdown-item current-opt-type-text">4 - 6 months</a></li>
                                                <li class="current-residence-option"><a class="dropdown-item current-opt-type-text">7 - 11 months</a></li>
                                                <li class="current-residence-option"><a class="dropdown-item current-opt-type-text">1 year</a></li>
                                                <li class="current-residence-option"><a class="dropdown-item current-opt-type-text">2 years</a></li>
                                                <li class="current-residence-option"><a class="dropdown-item current-opt-type-text">3 years</a></li>
                                                <li class="current-residence-option"><a class="dropdown-item current-opt-type-text">More than 3 years</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- RESIDENCY TYPE -->
                                    <div class="col-md-6 col-sm-12 mb-3 ps-md-3 ps-0">
                                        <label for="residencyType" class="form-label-submit">Type of residency <span class="text-danger">*</span></label><br>
                                        <div class="btn-group gap-1"> 
                                            <input type="radio" name="rad-residency" value="Rent" id="rad-rent" onclick="radiorecidence()" class="btn-check">
                                            <label for="rad-rent" class="btnResidency" id="rad-rent">Rent</label>
                                            <input type="radio" name="rad-residency" value="Own" id="rad-own" onclick="radiorecidence()" class="btn-check">
                                            <label for="rad-own" class="btnResidency" id="rad-own">Own</label>
                                        </div>
                                    </div>
                                </div>

                                

                                <div class="row">
                                  
                                    <!--  -->
                                    <div class="col-md-6 col-sm-12 d-none" id="divlandlordname">
                                        <div class="mb-3">
                                            <label for="rcurLandlordName" class="form-label form-label-submit ps-1">Landlord Name <span class="if-renting">for reference</span><span class="text-danger">*</span></label>
                                            <input type="text" onkeydown="return /^([a-z A-Z])*$/i.test(event.key)" class="form-control px-3 py-2 form-control-submit" id="rcurLandlordName" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 ps-md-3 ps-sm-0 ps-0 d-none" id="divlandlordnumber">
                                        <div class="mb-3">
                                            <label for="rcurLandlordNum" class="form-label form-label-submit ps-1">Landlord Contact No. <span class="text-danger">*</span></label>
                                            <input type="text" maxlength="11" minlength="11" onkeydown="return /^([0-9]|Backspace)*$/i.test(event.key) || event.key.length > 1" class="form-control px-3 py-2 form-control-submit" id="rcurLandlordNum" placeholder="">
                                        </div>
                                    </div>
                                </div>

                                <!-- REASONS -->
                                <div class="mb-3">
                                    <label for="rReason" class="form-label form-label-submit ps-1">Reason/s for leaving</label>
                                    <input type="text" class="form-control px-3 py-2 form-control-submit" id="rcurReason" placeholder="">
                                </div>

                                


                            </div>

                            <!-- PRIOR -->
                            <div class="mt-5">
                                <p class="form-label-submit mb-2 ps-1">PRIOR RESIDENCY <span class="text-secondary">(if any)</span></p>

                                <div class="mb-3">
                                    <label for="pastrAddress" class="form-label form-label-submit ps-1">Complete Address</label>
                                    <input type="text" class="form-control px-3 py-2 form-control-submit" value="" id="pastrAddress" placeholder="Please provide your current complete address">
                                </div>

                                <div class="row">

                                    <!-- Length of stay -->
                                    <div class="d-flex flex-column col-md-6 col-sm-12 mb-3">
                                        <label for="" class="form-label form-label-submit ps-1">How long do you live here?</label>
                                        <div class="dropdown past-residence-menu">
                                            <button onclick="ddsmTypeFunction()" onblur="blurFunction()" id="pastResidenceValue" value="Please select one" class="btn dropdown-toggle past-btnresidency d-flex justify-content-between rental-inputs" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <span class="past-btn-txt-residence">Please select one</span>
                                                <i class="bi bi-chevron-down icons" id="downTypeSm"></i>
                                                <i class="bi bi-chevron-up icons" id="upTypeSm"></i>
                                            </button>
                                            <ul class="dropdown-menu dmenu dropdown-menu-living w-100">
                                                <li class="past-residence-option"><a class="dropdown-item past-opt-type-text">Less than 1 month</a></li>
                                                <li class="past-residence-option"><a class="dropdown-item past-opt-type-text">1-3 months</a></li>
                                                <li class="past-residence-option"><a class="dropdown-item past-opt-type-text">4-6 months</a></li>
                                                <li class="past-residence-option"><a class="dropdown-item past-opt-type-text">7-11 months</a></li>
                                                <li class="past-residence-option"><a class="dropdown-item past-opt-type-text">1 year</a></li>
                                                <li class="past-residence-option"><a class="dropdown-item past-opt-type-text">2 years</a></li>
                                                <li class="past-residence-option"><a class="dropdown-item past-opt-type-text">3 years</a></li>
                                                <li class="past-residence-option"><a class="dropdown-item past-opt-type-text">More than 3 years</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- RESIDENCY TYPE -->
                                    <div class="col-md-6 col-sm-12 mb-3 ps-md-3 ps-sm-0 ps-0">
                                        <label for="residencyType" class="form-label-submit ps-1">Type of residency</label><br>
                                        <div class="btn-group gap-1"> 
                                            <input type="radio" name="rad-residency2" value="Rent" id="rad-rent2" onclick="pastradiorecidence()" class="btn-check">
                                            <label for="rad-rent2" class="btnResidency2" id="rad-rent2">Rent</label>
                                            <input type="radio" name="rad-residency2" value="Own" id="rad-own2" onclick="pastradiorecidence()" class="btn-check">
                                            <label for="rad-own2" class="btnResidency2" id="rad-own2">Own</label>
                                        </div>
                                    </div>


                                    

                                    <!-- MONTHLY PAYMENT -->
                                    <!-- <div class="col-md-6 col-sm-12 d-none ps-xl-3 ps-sm-0" id="pastdivpayment">
                                        <label for="" class="form-label form-label-submit ps-1">Monthly payment/rent</label>
                                        <div class="input-group mb-3 ">
                                            <span class="input-group-text px-3 spans ">₱</span>
                                            <input type="text" maxlength="6" onkeyup="checkMobileNumber()" onkeydown="return /^([0-9]|Backspace)*$/i.test(event.key) || event.key.length > 1" class="form-control form-control-submit p-2" id="rMonthlyPayment" value="" placeholder="">
                                        </div>
                                    </div> -->
                                    <div class="col-md-6 col-sm-12 d-none" id="pastdivlandlordname">
                                        <div class="mb-3">
                                            <label for="rLandlordName" class="form-label form-label-submit ps-1">Landlord Name <span class="if-renting">if renting</span></label>
                                            <input type="text" onkeydown="return /^([a-z A-Z])*$/i.test(event.key)" class="form-control px-3 py-2 form-control-submit"  value="" id="rLandlordName" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 ps-xl-3 ps-sm-0 d-none" id="pastdivlandlordnumber">
                                        <div class="mb-3">
                                            <label for="rLandlordNum" class="form-label form-label-submit ps-1">Landlord Contact No.</label>
                                            <input type="text" minlength="11" maxlength="11" onkeydown="return /^([0-9]|Backspace)*$/i.test(event.key) || event.key.length > 1" class="form-control px-3 py-2 form-control-submit" id="rLandlordNum" placeholder="">
                                        </div>
                                    </div>
                                </div>

                                <!-- REASONS -->
                                <div class="mb-3">
                                    <label for="rReason" class="form-label form-label-submit ps-1">Reason/s for leaving</label>
                                    <input type="text" class="form-control px-3 py-2 form-control-submit"  value="" id="rReason" placeholder="">
                                </div>

                                <div class="row mt-5">
                                    <!-- EVICTED -->
                                    <div class="col-md-6 col-sm-12 mb-5">
                                        <label for="residencyType" class="form-label-submit ps-1">Have you ever been evicted? <span class="text-danger">*</span></label><br>
                                        <div class="btn-group gap-1"> 
                                            <input type="radio" name="rad-evicted" value="YES" id="rad-yes" class="btn-check">
                                            <label for="rad-yes" class="btnEvicted" id="rad-yes">Yes</label>
                                            <input type="radio" name="rad-evicted" value="NO" id="rad-no" class="btn-check">
                                            <label for="rad-no" class="btnEvicted" id="rad-no">No</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 ps-md-3 ps-0 mb-3">
                                        <label for="residencyType" class="form-label-submit ps-1">Have you ever broken a lease? <span class="text-danger">*</span></label><br>
                                        <div class="btn-group gap-1"> 
                                            <input type="radio" name="rad-broken" value="YES" id="rad-bYes" class="btn-check">
                                            <label for="rad-bYes" class="btnBroken" id="rad-bYes">Yes</label>
                                            <input type="radio" name="rad-broken" value="NO" id="rad-bNo" class="btn-check">
                                            <label for="rad-bNo" class="btnBroken" id="rad-bNo">No</label>
                                        </div>
                                    </div>
                                </div>

                                


                            </div>
                        </div>


                        <br><br>

                    <!-- UPLOAD ID -->
                        <div class="confirm-identity">
                            <div class="d-flex justify-content-center">
                                <h5 class="form-label-submit mb-3">Confirm Identity</h5>
                            </div>

                            <p class="mb-1 form-label-submit">Upload ID <span class="text-danger">*</span></p>
                            <p class="mb-3">For verifying your identity, please upload any 
                                <span class="gov-id" title="Driver's License &#10;Passport &#10;HDMF (Pag-Ibig) ID &#10;UMID &#10;SSS ID &#10;Philsys ID &#10;Philippine Postal ID&#10;PRC ID &#10;ePhilID"><b><u> Government issued ID </u></b></span>. Please ensure that the information is not blurred and
                                the front of your identity card clearly shows your face.</p>

                                <section class="section-upload mt-4">

                                    <div class="row d-flex align-items-center justify-content-center">
                        
                                        <input type="file" class="showImgSize" id="frontuploadFile" accept=".png, .jpg, .jpeg">
                                        <div class="col-md-6 col-12 col-id-front columns d-flex flex-column align-items-center" id="uploadFilefront">
                                            <div class="box boxes box-id d-flex align-items-center justify-content-center flex-column frontImg">
                                                <canvas id="frontcanvas" class="showImgSize canvases"></canvas>
                                                <img src="../imgs/id-front.png" alt="" id="frontfile" class="front img-upload-id">
                                                <p class="upload front">Upload front</p>
                                                <p class="file-type front">JPEG or PNG only</p>
                                            </div>
                                            <p class="upload p-filename mt-1" id="frontfileName">nahdine.jpg</p>
                                        </div>
                                        
                                        <input type="file" class="showImgSize" id="uploadFileback" accept=".png, .jpg, .jpeg">
                                        <div class="col-md-6 col-12 col-id-back columns d-flex flex-column align-items-center" id="btn_backUpload">
                                            <div class="box boxes box-id d-flex align-items-center justify-content-center flex-column" >
                                                <canvas id="backCanvas" class="showImgSize canvases"></canvas>
                                                <img src="../imgs/id-back.png" alt="" id="backfile" class="back img-upload-id">
                                                <p class="upload back">Upload back</p>
                                                <p class="file-type back">JPEG or PNG only</p>
                                            </div>
                                            <p class="upload p-filename mt-1" id="backFileName">nahdine.jpg</p>
                                        </div>
                                        
                                    </div>
                                </section>

                        <!-- ID MATCHING -->
                        <div class="mt-4">
                            <p class="form-label-submit mb-1">Capture Selfie <span class="text-danger">*</span></p>
                            Please provide a selfie holding the government ID you provided. Make sure your face and the photo in your ID are clear for faster verification.
                            
                            <div class="d-flex align-items-center justify-content-center">
                                <section class="section-matching mt-4 d-flex" id="imgmatchId">
                                    <div class="d-flex flex-column justify-content-center ">
                                        <div class="outer-container d-flex align-items-center justify-content-center">
                                            <div class="container-match-vid">
                                                <video id="idmatchwebcam" autoplay playsinline class="img_Capture"></video>
                                            </div>
                                        </div>
                                        
                                        <footer class="d-flex justify-content-center mt-3">
                                            <button class="btns proceed-btns py-2" id="btn_capturematchid"> <i class="bi bi-camera"> </i> &nbsp;Take Photo</button>
                                        </footer>
                                    </div>
                                </section>
                    
                                <section class="section-confirm-back mt-4 d-none" id="imgmatchIdResult">
                                    <div class="d-flex flex-column">
                                        <div class="outer-container d-flex align-items-center justify-content-center">
                                            <div class="container-match-pic">
                                                <canvas id="idmatchcanvas" class="img_Capture"></canvas>
                                            </div>
                                        </div>
                                        <footer class="d-flex flex-row gap-2 justify-content-between mt-3">
                                            <button class="return-btns btn-retake ms-1" id="btn_retakematch"><span><i class="bi bi-arrow-left"></i></span>&nbsp;Retake Photo</button>
                                            <button class="btns proceed-btns py-2" id="btn_confirmmatchId"><i class="bi bi-check-circle"></i> &nbsp;Submit Photo</button>
                                        </div>
                                    </div>

                                <!-- CLEARANCE -->
                                    <div class="mt-4">
                                        <p class="form-label-submit mb-1">Upload Clearance <span class="text-danger">*</span></p>
                                        <p class="mb-3">Please upload either barangay clearance, police clearance or NBI clearance issued not more than 6 months ago for security purposes.</p>
                                        <div class="d-flex justify-content-center">
                                            <input type="file" class="showImgSize" id="docuuploadFile" accept=".png, .jpg, .jpeg">
                                            <div class="col-md-6 col-12 col-id-docu columns d-flex flex-column align-items-center" id="uploadFiledocu">
                                                <div class="box boxes box-clearance d-flex align-items-center justify-content-center flex-column docuImg">
                                                    <canvas id="docucanvas" class="showImgSize canvases clearance-canvas"></canvas>
                                                    <!-- <img src="../imgs/id-docu.png" alt="" id="docufile" class="docu img-upload-id"> -->
                                                    <i class="bi bi-file-earmark-text docu"></i>
                                                    <p class="upload docu">Upload clearance</p>
                                                    <p class="file-type docu">JPEG or PNG only</p>
                                                </div>
                                                <p class="upload p-filename mt-1" id="docufileName">nahdine.jpg</p>
                                            </div>
                                        </div>
                                        

                                    </div>
                                </section>
                            </div>

                            
                        </div>
                        </div>


                    </div>
                </section>

                <section class="footer-submit d-flex justify-content-end gap-2 mt-md-0 mt-sm-5 mt-5">
                    <a onclick="cancelApplication()" class="btn footer-btns px-4 py-2 btn-cancel" id="btnCancelApplication">Cancel</a>
                    <button class="btn footer-btns px-4 py-2 btn-go text-light" id="btnSubmitApplication" onclick="validation()">Submit Application</button>
                </section>
                <br><br>

                <div class="d-none">
                    <input type="text" id="imgFronttext" value="">
                    <input type="text" id="imgBacktext" value="">
                    <input type="text" id="imgDocuText" value="">
                    <input type="text" id="imgmatchtext" value="">
                    <input type="text" id="past_recidency" value="">
                    <input type="text" id="txtLandlordid" value="<?php echo $getPropertyinfo['landlord_id']; ?>">
                    <input type="text" id="txtRenterid" value="<?php echo $getUser['rId']; ?>">
                    <input type="text" id="txtPropertyId" value="<?php echo $_GET['property']; ?>">
                </div>
            </div>
        <!-- </div> -->






















        <!-- ```````````````````````````````` -->
            <!-- JS -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script>
            <script src="../JavaScripts/functionNav.js"></script>
            <script src="../JavaScripts/applicationQuery.js"></script>
            <script>
                function checkmaxoccupants(inputElement, maxValue) {
                    var maxInputValue = inputElement.value;
                    var txtMaxValue = document.getElementById('rOccupants');
                    
                    if (parseInt(maxInputValue) > parseInt(maxValue)) {
                        inputElement.value = "";
                        txtMaxValue.style.boxShadow = '0 0 5px 0px red !important';
                        txtMaxValue.style.border = '1px solid red !important';
                    }
                }


                function blurFunction(){
                    var upAvatar = document.getElementById("chevron-up-avatar");
                    var downAvatar = document.getElementById("chevron-down-avatar");
                    var upAvatar2 = document.getElementById("chevron-up-avatar2");
                    var downAvatar2 = document.getElementById("chevron-down-avatar2");
                    var upType = document.getElementById("upType");
                    var downType = document.getElementById("downType");
                    var upTypeSm = document.getElementById("upTypeSm");
                    var downTypeSm = document.getElementById("downTypeSm");
                    var upBed = document.getElementById("upBed");
                    var downBed = document.getElementById("downBed");
                    
                    upAvatar.style.display = "none";
                    downAvatar.style.display = "inline-block";

                    upAvatar2.style.display = "none";
                    downAvatar2.style.display = "inline-block";

                    upType.style.display = "none";
                    downType.style.display = "inline-block";

                    upTypeSm.style.display = "none";
                    downTypeSm.style.display = "inline-block";

                    upBed.style.display = "none";
                    downBed.style.display = "inline-block";


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
            window.onload = function () {
                const modal = new bootstrap.Modal(document.getElementById('preparationModal'));
                
                modal.show();
            }
            </script>
        </body>
        </html>

<?php
        }
        else{
            echo "<script>window.location.href = 'application1Empty.php'</script>";
        }
    }
}
else {
    if(isset($_GET['id']) && $_GET['id'] == "1"){
        echo "<script>window.location.href = 'starterPage.php?id=".$_GET['id']."'</script>";
    }
    else {
        echo "<script>window.location.href = '../../../RentA/RentersPage/starterPage.php'</script>";
    }
}
    // Close the database connection
    mysqli_close($con);
?> 