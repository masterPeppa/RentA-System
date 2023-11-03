<?php
session_start();
include('../DataBase/connection.php');
if(isset($_SESSION['rEmail'])){
    $renterEmail = $_SESSION['rEmail'];
    $selectUser = "SELECT * FROM user_renter WHERE rEmail ='$renterEmail'";
    $executeSelectUser = mysqli_query($con, $selectUser);
    $getUser = mysqli_fetch_assoc($executeSelectUser);
    
    $select_lease = "SELECT * FROM lease WHERE renter_id ='".$getUser['rId']."' AND (sent_status='sent1' OR sent_status='sent2')";
    $execute_lease = mysqli_query($con, $select_lease);
    $checklease = mysqli_fetch_assoc($execute_lease);
    $checkexislease = mysqli_num_rows($execute_lease);

    if(isset($_GET['idnotif']) && $_GET['idnotif'] != ""){
        $update_notif="UPDATE renter_notification SET notif_status='read' WHERE id = '".$_GET['idnotif']."'";
        $newnotif_update_executed=mysqli_query($con,$update_notif);
    }
    else{
        $update_notif="UPDATE renter_notification SET notif_status='read' WHERE renter_id = '".$getUser['rId']."' AND notif_info='received-lease'";
        $newnotif_update_executed=mysqli_query($con,$update_notif);
    }
    if($checkexislease > 0){
        $updatesentstatus = "UPDATE application_data SET receive_status='received' WHERE renter_id='".$getUser['rId']."' 
        AND landlord_id='".$checklease['landlord_id']."' AND property_id='".$checklease['property_id']."'";
        $executeupdatestatus = mysqli_query($con, $updatesentstatus);
        
        $imglease = str_replace("../", "", $checklease['img_lease']);
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

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../JavaScripts/functionNav.js"></script>
    <script src="../JavaScripts/applicationQuery.js"></script>
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

<!-- MODAL CANCEL APPLICATION -->
<div class="modal fade" id="cancelApplicationModal" tabindex="-1" aria-labelledby="cancelApplicationModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content modals container_modalCancelApplication">

                <div class="modal-header modal-header-logout p-3">
                    <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body modal-body-logout">
                    <section class="section_logout">
                        
                        <div class="div-logout d-flex flex-column align-items-center justify-content-center mt-3">
                            <img src="../imgs/question.png" alt="Log Out" class="img-logout">
                            <h5 class="text-center mt-1 modal-txt">Are you sure you want to cancel your rental application?</h5>
                        </div>
                    </section>
                </div>

                <div class="modal-footer d-flex gap-2 p-3">
                    <button type="button" class="btn btn-cancel modal-logout-btns" data-bs-dismiss="modal">No</button>
                    <a onclick="cancelApply()" class="btn btn-del modal-logout-btns d-flex align-items-center justify-content-center">Yes</a>
                  </div>
            </div>
        </div>
    </div>
<!-- modal end - CANCEL APPLICATION -->

<!-- MODAL SUBMIT LEASE -->
<div class="modal fade" id="submitLeaseModal" tabindex="-1" aria-labelledby="cancelApplicationModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content modals container_modalCancelApplication">

                <div class="modal-header modal-header-logout p-3">
                    <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body modal-body-logout">
                    <section class="section_logout">
                        
                        <div class="div-logout d-flex flex-column align-items-center justify-content-center mt-1">
                            <img src="../imgs/delivered.png" alt="Submit" class="img-logout">
                            <h5 class="text-center mt-2 modal-txt">Do you really agree on all the information included in the lease agreement?</h5>
                        </div>
                    </section>
                </div>

                <div class="modal-footer d-flex gap-2 p-3">
                    <button type="button" class="btn btns btn-cancel px-3 py-2" data-bs-dismiss="modal">Review Lease</button>
                    <a onclick="submitsign()" class="btn btns btn-ok px-4 py-2 d-flex align-items-center justify-content-center">Yes</a>
                  </div>
            </div>
        </div>
    </div>
<!-- modal end - SUBMIT LEASE -->

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
                <div class="stepper-item d-flex flex-column align-items-center active">
                    <div class="step-counter d-flex align-items-center justify-content-center">3</div>
                    <div class="step-name active mt-2">Settle Lease</div>
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


    <!--  -->
    <div class="d-flex flex-column justify-content-center align-items-center ">
    <section class="agree-pad">
            <div class="d-flex flex-column">
                <h3 class="mt-5 mb-3 txt-havent">Settle Lease Agreements</h3>
                
            </div>

            <!-- UPLOADED CONTRACT -  -->
            
            <div class="d-flex justify-content-center align-items-center flex-column">
                <div class="my-3">
                    <b> Lease Agreement </b>
                    <p class="mb-1"> Attached here is the lease agreement from the landlord of your desired rental property. Please carefully review all the information.</p>
                </div>
                <div class="uploaded-contract">
                    <img src="../<?php echo $imglease ?>" alt="" class="imgLease">
                </div>
                
                <!-- <div class="mt-3">
                    <input type="file" class="showImgSize" id="uploadRenterSign" accept=".png, .jpg, .jpeg">
                    <div class="d-flex flex-column align-items-center" id="uploadsign">
                        <div class="box box-signature d-flex align-items-center justify-content-center flex-column" >
                            <canvas id="renterCanvas" class="showImgSize canvas-signature"></canvas>
                            <img src="../imgs/sample-signature.png" alt="" id="backfile" class="back img-upload-id">
                            <p class="upload back text-center">Upload signature <br>over printed name</p>
                            <p class="file-type back">JPEG or PNG only</p>
                        </div>
                    </div>
                </div> -->
                
                <div class="advance mt-5">
                    <p><b>Advance Payment Agreement</b> </p>

                    <?php
                    if($checklease['deposit_amount'] != "0"){
                        ?>
                    <div class="advance mt-5">
                        <p class="mb-3"><b><i>Security Deposit</i></b> </p>

                        <div class="row">
                            <div class="col-md-6 col-12">
                                <input type="file" class="showImgSize" id="depositFile" accept=".png, .jpg, .jpeg">
                                <div class="d-flex flex-column" id="btndeposit">
                                    <div class="box boxes box-receipt d-flex align-items-center justify-content-center flex-column" >
                                        <canvas id="depositCanvas" class="showImgSize canvas-receipt canvases"></canvas>
                                        <img src="../imgs/bill.png" alt="" id="" class="deposit img-upload-id">
                                        <p class="upload deposit">Upload receipt</p>
                                        <p class="file-type deposit">JPEG or PNG only</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 d-flex align-items-center ">
                                <p class="agreements-txt mt-md-0 mt-3">
                                    <span><b> Amount to pay = ₱<span class="pay-deposit-amt"><?php echo number_format($checklease['deposit_amount']) ?></span> </b></span> <br>
                                    This security deposit is not part of your monthly rent. 
                                    Instead, the money will be held by your landlord throughout the lease agreement. 
                                    It pays for any damage that you may cause in the unit until the end of the lease period. 
                                    If there is damage, you may lose some of the money. 
                                    Normal wear and tear should not lose the money, however. 
                                    Upon the end of lease agreement, the money will be returned to you if there's no damage and unpaid balance.
                                    <br><br>
                                    Message the landlord with regards to the payment method you will use to settle payment like Gcash, PayMaya, PeraPadala, etc. and upload the receipt here as proof of your payment.
                                </p>
                            </div>
                        </div>
                        
                    </div>
                    <?php
                    }
                    if($checklease['advance_amount'] != "0"){
                    ?>

                    <div class="advance mt-5">
                        <p class="my-3"><b><i>Advance Rental</i></b> </p>
                        <div class="row">
                            <div class="col-md-6 col-12 ">
                                <input type="file" class="showImgSize" id="advanceFile" accept=".png, .jpg, .jpeg">
                                <div class="d-flex flex-column" id="btnadvance">
                                    <div class="box boxes box-receipt d-flex align-items-center justify-content-center flex-column" >
                                        <canvas id="advanceCanvas" class="showImgSize canvas-receipt canvases"></canvas>
                                        <img src="../imgs/bill.png" alt="" id="" class="advanceHide img-upload-id">
                                        <p class="upload advanceHide">Upload receipt</p>
                                        <p class="file-type advanceHide">JPEG or PNG only</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 d-flex align-items-center ">
                                <p class="agreements-txt mt-md-0 mt-3">
                                    <span><b> Amount to pay = ₱<span class="pay-deposit-amt"><?php echo number_format($checklease['advance_amount']) ?></span> </b></span> <br> <br>
                                    This <span class="chosen-advance"> <b><?php echo $checklease['advance_period'] ?></b> </span> covers your rental payment for the entire covered month / months.
                                    <br><br>
                                    Message the landlord with regards to the payment method you will use to settle payment like Gcash, PayMaya, PeraPadala, etc. and upload the receipt here as proof of your payment.
                                </p>
                            </div>
                        </div>

                        <div class="advance mt-5">
                        <p class="my-3"><b><i>Penalty Agreement </i></b> </p>
                        <div class="row">
                            <div class="col-md-6 col-12 ">
                                <p class="agreements-txt mt-md-0 mt-3">
                                <span><b> Penalty amount to pay = ₱<span class="pay-deposit-amt"><?php echo number_format($checklease['penalty_amount']) ?></span> </b></span> <br> <br>
                                </p>
                            </div>
                            <div class="col-md-6 col-12 d-flex align-items-center ">
                                <p class="agreements-txt mt-md-0 mt-3">
                                    You have to pay this penalty if you paid your monthly rent 30 days late after the due date.
                                </p>
                            </div>
                        </div>






                    </div>
                    <?php
                    }
                    ?>
                </div>

                <br><br>
                <div class="mt-3 agree-pad d-flex justify-content-center ">
                    <p><b> I have read and hereby agree to all the agreements given to me by the landlord as of this day. </p></b>
                </div>

                


            </div>
            
            <div class="d-flex justify-content-center align-items-center mt-5">
                <div class="d-flex footer-contract justify-content-end gap-2 ">
                    <!-- <a href="../messages.php?landlordId=<?php echo $checklease['landlord_id'] ?>" role="button" class="btn btns btn-cancel-main px-4 py-2 text-light ">Message Landlord</a> -->
                    <a role="button" class="btn btns btn-cancel-main px-4 py-2 text-light" data-bs-toggle="modal" data-bs-target="#cancelApplicationModal">Cancel Application</a>
                    <a role="button" class="btn btns btn-go px-4 py-2 text-light" data-bs-toggle="modal" data-bs-target="#submitLeaseModal">Proceed</a>
                </div>
            </div>
    <div class="d-none">
        <input type="text" id="renterId" value="<?php echo $checklease['renter_id']?>">
        <input type="text" id="propertyId" value="<?php echo $checklease['property_id']?>">
        <input type="text" id="idlandlord" value="<?php echo $checklease['landlord_id']?>">
    </div>
            
        </section>

    </div>
        
        <br>

        
        

        


<!-- ```````````````````````````````` -->

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
    echo "<script>window.location.href = 'application3LeaseWait.php'</script>";
}
    }
    else{
        echo "<script>window.location.href = '../../../RentA/RentersPage/starterPage.php'</script>";
    }
    // Close the database connection
mysqli_close($con);
    ?>