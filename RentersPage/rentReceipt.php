<!-- <?php
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
    if($checkexislease > 0){
        $updatesentstatus = "UPDATE application_data SET receive_status='received' WHERE renter_id='".$getUser['rId']."' 
        AND landlord_id='".$checklease['landlord_id']."' AND property_id='".$checklease['property_id']."'";
        $executeupdatestatus = mysqli_query($con, $updatesentstatus);
        
        $imglease = str_replace("../", "", $checklease['img_lease']);
    ?> -->
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>RentA | Rent Receipt</title>
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
    
                    <ul class="navbar-nav navbar-nav-renter d-flex gap-2 align-items-center ms-auto">
                        <li class="nav-item px-3">
                            <a class="nav-link" href="rentals.php">Find Rentals</a>
                        </li>
                        
                        <!-- Manage Renters -->
                        <li class="nav-item dropdown d-none d-sm-none d-md-block">
                            <button onclick="dropdownManageFunction()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block dd-renter-manage active-dropdown" type="button" id="" data-bs-toggle="dropdown" aria-expanded="false">
                                Manage
                                <i class="bi bi-chevron-down nav-icons" id="chevron-down-manage"></i>
                                <i class="bi bi-chevron-up nav-icons" id="chevron-up-manage"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-rentals" aria-labelledby="dropdrownbtn-manage">
                                <li><a class="dropdown-item dropdown-item-first" href="RentersPage/application1Submit.php">Application</a></li>
                                <li><a class="dropdown-item active-dropdown" href="RentersPage/manageMonthlyRent.php">Monthly Rent</a></li>
                                <li><a class="dropdown-item dropdown-item-last" href="RentersPage/manageRentalConcern.php">Rental Concern</a></li>
                                
                            </ul>
                        </li>
    
                       <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link" href="RentersPage/application1Submit.php">Application</a>
                        </li>
    
                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link active-dropdown" href="RentersPage/manageMonthlyRent.php">Monthly Rent</a>
                        </li>
    
                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link " href="RentersPage/manageRentalConcern.php">Rental Concern</a>
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
    
        <div class="container-fluid container-submit px-md-0 px-5 py-3">
    
            <div class="d-flex flex-column ps-md-5">
                <h3 class="mb-3 txt-havent">Rent Receipt</h3>
                <?php
                    $selectpaymentdata = "SELECT * FROM payment_records WHERE id ='".$_GET['paymentid']."'";
                    $executeSelectpaymentdata = mysqli_query($con, $selectpaymentdata);
                    $getpaymentdata = mysqli_fetch_assoc($executeSelectpaymentdata);
                ?>
                        <div class="div-deposit mt-3">
    
                            <p>Payment for the month of : <span><b><?php echo $_GET['datevalue'] ?></b></span></p>
                            <p>Amount paid : <span>₱ <b><?php echo number_format($getpaymentdata['amount']) ?></b></span></p>
                            
                            <div class="mt-3 rent-receipt-img">
                                <label for="uploaded-receipt-img"><b> Receipt photo </b></label>
                                <img src="../<?php echo str_replace("../", "", $getpaymentdata['img_receipt']) ?>" alt="" class="uploaded-receipt-img mt-2">
                            </div>

                            <div class="d-flex align-items-center mt-5">
                                <div class="d-flex gap-2 back-btn ps-1">
                                    <i class="bi bi-arrow-left"></i>
                                    <span onclick="GobackPage()">Back</span>
                                </div>
                            </div>
                            </div>
                        </div>
                    
                </div>
            </div>
                
                
    
        <div class="d-none">
            <input type="text" id="renterId" value="<?php echo $checklease['renter_id']?>">
            <input type="text" id="propertyId" value="<?php echo $checklease['property_id']?>">
            <input type="text" id="idlandlord" value="<?php echo $checklease['landlord_id']?>">
        </div>
                
            </section>
    
        </div>
    
            
            
    
            
    
    
    <!-- ```````````````````````````````` -->
        <script src="../JavaScripts/functionNav.js"></script>
        <script>
            
            function blurFunction(){
                var upAvatar = document.getElementById("chevron-up-avatar");
                var downAvatar = document.getElementById("chevron-down-avatar");
                var upAvatar2 = document.getElementById("chevron-up-avatar2");
                var downAvatar2 = document.getElementById("chevron-down-avatar2");
                var upType = document.getElementById("upTypeSm");
                var downType = document.getElementById("downTypeSm");
                var upManage = document.getElementById("chevron-up-manage");
                var downManage = document.getElementById("chevron-down-manage");
             
                upManage.style.display = "none";
                downManage.style.display = "inline-block";
                 
                upAvatar.style.display = "none";
                downAvatar.style.display = "inline-block";
    
                upAvatar2.style.display = "none";
                downAvatar2.style.display = "inline-block";
    
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
    <!-- <?php
    
            
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
        ?> -->