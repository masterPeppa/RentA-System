<?php
session_start();
include('../DataBase/connection.php');
if(isset($_SESSION['rEmail'])){
    $renterEmail = $_SESSION['rEmail'];
    $selectUser = "SELECT * FROM user_renter WHERE rEmail ='$renterEmail'";
    $executeSelectUser = mysqli_query($con, $selectUser);
    $getUser = mysqli_fetch_assoc($executeSelectUser);

    $getId = "SELECT * FROM application_data WHERE renter_id='".$getUser['rId']."' AND send_status = '5' AND
    agreement != 'finished'";
    $rcheckId = mysqli_query($con, $getId);
    $rcountidexistence = mysqli_num_rows($rcheckId);
    $rcheckidexistence = mysqli_fetch_assoc($rcheckId);
    if($rcountidexistence > 0){
        $selectcomment = "SELECT * FROM feedback_data WHERE renter_id='".$getUser['rId']."'";
        $executecomment = mysqli_query($con, $selectcomment);
        $getcomment = mysqli_num_rows($executecomment);
        if($getcomment == 0){
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

     <!-- CSS -->
     <link rel="stylesheet" href="../CSS/">
     <link rel="stylesheet" href="../CSS/stylesNav.css">
     <link rel="stylesheet" href="../CSS/stylesRenterApplication.css">

     <!--JQuery-->
    <script defer src="../JavaScripts/feedbackFunction.js"></script>
     

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
                        <a class="dropdown-itemd-flex justify-content-between" href="../messages.php" id="smmessageCount">
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
                                <img src="<?php echo $getUser['rImgProfile'] ?>" alt="" class="img-avatar me-1">
                                <i class="bi bi-chevron-down nav-icons" id="chevron-down-avatar2"></i>
                                <i class="bi bi-chevron-up nav-icons" id="chevron-up-avatar2"></i>

                            <span id="notifyCircle">
                            </span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-avatar-renter" aria-labelledby="dropdrownbtn-avatar">
                                <li>
                                    <a class="dropdown-item dropdown-item-first  d-flex justify-content-between" href="renterNotifications.php" id="notifCount"> 
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
            <div class="modal-content modals container_modalLogout">

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

<!-- MODAL FEEDBACK -->
<div class="modal" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content modals container_modalFeedback">

                <div class="modal-header pt-4 px-3 pb-3 row">
                    <div class="col-2">
                    </div>
                    <div class="col-8 d-flex justify-content-center">
                        <h4 class="feedback-title">Write a Feedback</h4>
                    </div>
                    <div class="col-2 d-flex justify-content-end">
                        <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    
                </div>

                <div class="modal-body">
                    <div class="feedback-container">

                        <h5 class="">How was your experience?</h5>
                    <!-- CLEANLINESS -->
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <p class="feedback-label">Cleanliness</p>
                            <div class="stars-container d-flex gap-2">
                                <i class="bi bi-star-fill stars stars1"></i>
                                <i class="bi bi-star-fill stars stars1"></i>
                                <i class="bi bi-star-fill stars stars1"></i>
                                <i class="bi bi-star-fill stars stars1"></i>
                                <i class="bi bi-star-fill stars stars1"></i>
                            </div>
                        </div>
                    <!-- COMMUNICATION -->
                        <div class="d-flex justify-content-between align-items-center mt-1">
                            <p class="feedback-label">Communication</p>
                            <div class="stars-container d-flex gap-2">
                                <i class="bi bi-star-fill stars stars2"></i>
                                <i class="bi bi-star-fill stars stars2"></i>
                                <i class="bi bi-star-fill stars stars2"></i>
                                <i class="bi bi-star-fill stars stars2"></i>
                                <i class="bi bi-star-fill stars stars2"></i>
                            </div>
                        </div>

                    <!-- ACCURACY -->
                        <div class="d-flex justify-content-between align-items-center mt-1">
                            <p class="feedback-label">Accuracy</p>
                            <div class="stars-container d-flex gap-2">
                                <i class="bi bi-star-fill stars stars3"></i>
                                <i class="bi bi-star-fill stars stars3"></i>
                                <i class="bi bi-star-fill stars stars3"></i>
                                <i class="bi bi-star-fill stars stars3"></i>
                                <i class="bi bi-star-fill stars stars3"></i>
                            </div>
                        </div>

                        <!-- LOCATION -->
                        <div class="d-flex justify-content-between align-items-center mt-1">
                            <p class="feedback-label">Location</p>
                            <div class="stars-container d-flex gap-2">
                                <i class="bi bi-star-fill stars stars4"></i>
                                <i class="bi bi-star-fill stars stars4"></i>
                                <i class="bi bi-star-fill stars stars4"></i>
                                <i class="bi bi-star-fill stars stars4"></i>
                                <i class="bi bi-star-fill stars stars4"></i>
                            </div>
                        </div>

                        <div class="d-none">
                            <input type="text" id="txtCleanliness" value="0">
                            <input type="text" id="txtCommunication" value="0">
                            <input type="text" id="txtaccuracy" value="0">
                            <input type="text" id="txtlocation" value="0">
                            <input type="text" id="txtLandlordId" value="<?php echo $rcheckidexistence['landlord_id'] ?>">
                            <input type="text" id="txtrenterId" value="<?php echo $rcheckidexistence['renter_id'] ?>">
                            <input type="text" id="txtpropertyId" value="<?php echo $rcheckidexistence['property_id'] ?>">
                        </div>

                        <h5 class="mt-3">Tell us more</h5>
                        <div class="d-flex mt-1">
                            <textarea name="" id="txtComment" cols="100" rows="" class="tell-more-box px-3 py-2"></textarea>
                        </div>

                    </div>
                </div>

                <div class="modal-footer d-flex gap-2 px-3 pb-3">
                    <button type="button" class="btn btns btn-cancel px-4 py-2" data-bs-dismiss="modal">Cancel</button>
                    <a onclick="submitfeedback()" class="btn btns btn-go px-4 py-2 text-light d-flex align-items-center justify-content-center" >Submit</a>
                </div>
            </div>
        </div>
    </div>
<!-- modal end - FEEDBACK -->

<!-- MODAL FFEDBACK INCOMPLETE -->
<div class="modal" id="incompleteFeedbackModal" tabindex="-1" aria-labelledby="incompleteFeedbackModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content modals container_modalFeedback2">

            <div class="modal-header modal-header-logout p-3">
                <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body modal-body-logout">
                <section class="section_logout">
                    
                    <div class="div-logout d-flex flex-column align-items-center justify-content-center mt-3">
                        <img src="../imgs/warning.png" alt="Log Out" class="img-logout">
                        <h5 class="text-center mt-1">Please tell us more about your stay.</h5>
                    </div>
                </section>
            </div>

            <div class="modal-footer d-flex gap-2 p-3">
                <button type="button" class="btn btn-cancel modal-logout-btns" data-bs-toggle="modal" data-bs-target="#feedbackModal">Ok</button>
              </div>
        </div>
    </div>
</div>
<!-- modal end - LOGOUT -->

<!-- MAIN -->

    <div class="container-fluid container-submit ">

        <section class="submit-header mt-5 px-3 px-md-5 d-flex align-items-center">
            <h2 class="submit-header-txt">Application</h2>
        </section>

    <!-- PROGRESS BAR -->
        <section class="section-progress d-flex align-items-center justify-content-center">
           
            <div class="stepper-wrapper d-flex justify-content-between w-100">

                <div class="stepper-item d-flex flex-column align-items-center completed">
                    <div class="step-counter d-flex align-items-center justify-content-center">
                        <img src="../imgs/house-check.png" alt="" style="width: 25px;">
                    </div>
                    <div class="step-name mt-2">Application</div>
                </div>
                <div class="stepper-item d-flex flex-column align-items-center completed">
                    <div class="step-counter d-flex align-items-center justify-content-center">
                        <img src="../imgs/house-check.png" alt="" style="width: 25px;">
                    </div>
                    <div class="step-name mt-2">Approval</div>
                </div>
                <div class="stepper-item d-flex flex-column align-items-center completed">
                    <div class="step-counter d-flex align-items-center justify-content-center">
                        <img src="../imgs/house-check.png" alt="" style="width: 25px;">
                    </div>
                    <div class="step-name mt-2">Settle Lease</div>
                </div>
                <div class="stepper-item d-flex flex-column align-items-center completed">
                    <div class="step-counter d-flex align-items-center justify-content-center">
                        <img src="../imgs/house-check.png" alt="" style="width: 25px;">
                    </div>
                    <div class="step-name mt-2">Move-in</div>
                </div>
                <div class="stepper-item d-flex flex-column align-items-center active">
                    <div class="step-counter d-flex align-items-center justify-content-center">5</div>
                    <div class="step-name mt-2 active">Feedback</div>
                </div>
              </div>

        </section>


    <!-- PROPERTY INFO SECTION -->
        <section class="section-empty mt-5">
            <div class="d-flex flex-column gap-5 justify-content-center align-items-center">
                <h3 class="mt-5 txt-havent text-center">Enjoy your stay!</h3>
                <p class="text-center">We encourage you to leave a feedback to let others know about your experience.</p>
                <a href="" role="button" class="px-4 py-2 btns-application btn-share" data-bs-toggle="modal" data-bs-target="#feedbackModal">Share my experience</a>
            </div>
        </section>


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
             
            upAvatar.style.display = "none";
            downAvatar.style.display = "inline-block";

            upAvatar2.style.display = "none";
            downAvatar2.style.display = "inline-block";
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
<!-- <?php
            }
            else{
                echo "<script>window.location.href = 'application5Done.php'</script>";
            }
        }
        else{
                echo "<script>window.location.href = 'application1Submit.php'</script>";
        }
    }
    else{
        echo "<script>window.location.href = '../../../RentA/RentersPage/starterPage.php'</script>";
    }
    // Close the database connection
mysqli_close($con);
    ?> -->