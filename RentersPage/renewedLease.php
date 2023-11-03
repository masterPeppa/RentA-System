<?php

session_start();
include('../DataBase/connection.php');
if(isset($_SESSION['rEmail'])){
    $renterEmail = $_SESSION['rEmail'];
    $selectUser = "SELECT * FROM user_renter WHERE rEmail ='$renterEmail'";
    $executeSelectUser = mysqli_query($con, $selectUser);
    $getUser = mysqli_fetch_assoc($executeSelectUser);

    if(isset($_GET['notifid'])){

        $selectNotif = "SELECT * FROM renter_notification WHERE id ='".$_GET['notifid']."'";
        $executeSelectNotif = mysqli_query($con, $selectNotif);
        $getNotif = mysqli_fetch_assoc($executeSelectNotif);

        $selectlease = "SELECT * FROM lease WHERE landlord_id='".$getNotif['landlord_id']."' AND renter_id='".$getNotif['renter_id']."' 
        AND property_id='".$getNotif['property_id']."' AND lease_status='residing'";
        $executeSelectlease = mysqli_query($con, $selectlease);
        $getlease = mysqli_fetch_assoc($executeSelectlease);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentA | Lease Agreement</title>
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
    <script src="../JavaScripts/functionProgressBar.js"></script>
     

</head>
<body>

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

<!-- MODAL EXTEND -->
<div class="modal fade" id="extendContractModal" tabindex="-1" aria-labelledby="modalLogout" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content modals modal-extend">

            <div class="modal-header modal-header-logout p-3">
                <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="d-flex flex-column align-items-center justify-content-center mt-3 px-4">
                    <img src="../imgs/question-purple.png" alt="Log Out" class="img-logout">
                    <h5 class="text-center mt-1">Do you wish to request contract renewal and extend your stay here? If yes, we will notify your landlord and we'll get you his/her response.</h5>
                </div>
            </div>

            <div class="modal-footer d-flex gap-2 p-3">
                <button type="button" class="btn btn-cancel modal-logout-btns" data-bs-dismiss="modal">No</button>
                <a href="" class="btn btn-confirm modal-logout-btns d-flex align-items-center justify-content-center">Yes</a>
              </div>
        </div>
    </div>
</div>
<!-- modal end - EXTEND -->


<!-- MODAL REASON FOR REJECTION -->
<div class="modal fade" id="renewRejectedModal" tabindex="-1" aria-labelledby="modalLogout" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content modals modal-reject-reason">

            <div class="modal-header modal-header-logout p-3">
                <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="d-flex flex-column align-items-center justify-content-center mt-3 px-4">
                    <img src="../imgs/question-purple.png" alt="Log Out" class="img-logout">
                    <h5 class="text-center mt-1">Your landlord didn't agreed to your contract renewal for this reason: </h5>
                    <div class="reason-div p-3 mt-3">
                        <p class="reject-reason-txt">Please state reason submitted here...</p>
                    </div>
                </div>
            </div>

            <div class="modal-footer d-flex gap-2 p-3">
                <button type="button" class="btn btn-confirm modal-logout-btns" data-bs-dismiss="modal">Ok</button>
              </div>
        </div>
    </div>
</div>
<!-- modal end - EXTEND -->

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
                        
                        <!-- Manage -->
                        <li class="nav-item dropdown d-none d-sm-none d-md-block">
                            <button onclick="dropdownManageFunction()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block dd-renter-manage active-dropdown" type="button" id="" data-bs-toggle="dropdown" aria-expanded="false">
                                Manage
                                <i class="bi bi-chevron-down nav-icons" id="chevron-down-manage"></i>
                                <i class="bi bi-chevron-up nav-icons" id="chevron-up-manage"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-rentals" aria-labelledby="dropdrownbtn-manage">
                                <li><a class="dropdown-item dropdown-item-first" href="application1Submit.php">Application</a></li>
                                <li><a class="dropdown-item" href="manageMonthlyRent.php">Monthly Rent</a></li>
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



<!-- MAIN -->

    <div class="container-fluid px-3 px-md-5 py-3">
            
        <div class="row">
            
            <div class="col-lg-6 col-md-12 col-12 mt-5">
                <h3 class="title mt-5 mb-3 lease-type">Confirm Lease Agreement </h3>
                
                <img src="../<?php echo str_replace("../", "", $getlease['img_lease']) ?>" alt="" class="box-renewed-lease">

                <div class="mt-3 footer-upload d-flex justify-content-between align-items-center ">
                    <a onclick="GobackPage()" class="return-btns ms-2 d-flex" id=""> <span><i class="bi bi-arrow-left"></i></span>&nbsp;Back</a>
                    <a onclick="confirmLease()" role="button" class="btn send-continue px-4 py-2 text-light">
                        <span><i class="bi bi-check-circle pe-2"></i></span>
                        Confirm Lease
                    </a>
                </div>

                <div class="d-none">
                    <input type="text" id="txtRenter" value="<?php echo $renterId ?>">
                    <input type="text" id="txtpropid" value="<?php echo $propertyid ?>">
                    <input type="text" id="txtNotifid" value="<?php echo $_GET['notifid'] ?>">
                </div>
            </div>
        </div>
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
        function confirmLease(){
            var txtNotifid = document.getElementById('txtNotifid').value;
            window.location.href = "renterNotifications.php";
            removenotiffunction(txtNotifid);
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
    else {
        echo "<script>window.history.back();</script>";
    }
}
else{
    echo "<script>window.location.href = '../../../RentA/RentersPage/starterPage.php'</script>";
}
?> -->