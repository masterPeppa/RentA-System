<?php

session_start();
include('../DataBase/connection.php');
if(isset($_SESSION['rEmail'])){
    $renterEmail = $_SESSION['rEmail'];
    $selectUser = "SELECT * FROM user_renter WHERE rEmail ='$renterEmail'";
    $executeSelectUser = mysqli_query($con, $selectUser);
    $getUser = mysqli_fetch_assoc($executeSelectUser);

    $selectlease = "SELECT * FROM lease WHERE renter_id ='".$getUser['rId']."' AND lease_status='residing'";
    $executeSelectlease = mysqli_query($con, $selectlease);
    $getlease = mysqli_fetch_assoc($executeSelectlease);
    $getleaseCount = mysqli_num_rows($executeSelectlease);

    $selectcomplaintnotif = "SELECT * FROM admin_notification WHERE renter_id ='".$getUser['rId']."' AND notif_info='Complaints' AND notif_status='unread'";
    $executecomplaintnotif = mysqli_query($con, $selectcomplaintnotif);
    $getcomplaintnotif = mysqli_fetch_assoc($executecomplaintnotif);
    $getcomplaintnotifcount = mysqli_num_rows($executecomplaintnotif);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentA | Rental Concern</title>
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
                            <a class="nav-link" href="../rentals.php">Find Rentals</a>
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
                                <li><a class="dropdown-item dropdown-item-last active-dropdown" href="manageRentalConcern.php">Rental Concern</a></li>
                                
                            </ul>
                        </li>

                       <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link" href="application1Submit.php">Application</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link" href="manageMonthlyRent.php">Monthly Rent</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link active-dropdown" href="manageRentalConcern.php">Rental Concern</a>
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
                    <a href="index.php?status=logout" class="btn btn-del modal-logout-btns d-flex align-items-center justify-content-center">Yes</a>
                  </div>
            </div>
        </div>
    </div>
<!-- modal end - LOGOUT -->

<!-- MODAL SEND COMPLAINT -->
<div class="modal fade" id="complaintModal" tabindex="-1" aria-labelledby="reasonModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content modals modal-complaint">

            <div class="modal-header modal-header-logout p-3">
                <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="d-flex flex-column align-items-center justify-content-center px-md-5 px-3">
                    <img src="../imgs/question.png" alt="Log Out" class="img-logout">
                    <h5 class="text-center mt-2 modal-txt">Complaint Form</h5>
                    <p class="mt-3">Can you describe your issue in a few sentences? This will help our team understand what's going on.</p>
                    <textarea name="" id="txtComplaintsreason" class="txtarea-complaint p-3 mt-2" id="" cols="" rows="" placeholder="State reason here..."></textarea>
                </div>
            </div>

            <div class="modal-footer d-flex gap-2 p-3">
                <button type="button" class="btn admin-btns btn-cancel modal-btns px-4 py-2" data-bs-dismiss="modal">Cancel</button>
                <a onclick="sendComplaintsToAdmin()" class="btn admin-btns btn-del modal-btns px-4 py-2 d-flex align-items-center justify-content-center">Submit</a>
            </div>
        </div>
    </div>
</div>
<!-- modal end - SEND COMPLAINT --> 

<!-- MAIN -->

    <div class="container-fluid container-submit ">

    <!-- THERE'S RECORD -->
        <div class="container-fluid px-3 px-md-5 py-3">
            
                <h3 class="title">Rental Concern</h3>
                <p class="mt-3">Do you have any concerns on the property you are staying in? </p>
                <p class="">We advise you to send message to the landlord regarding it.</p>

                <?php
                if($getleaseCount == 1){
                    ?>
                <a href="../messages.php?landlordId=<?php echo $getlease['landlord_id'] ?>" class="btn btns btn-send-concern px-4 py-2 d-flex align-items-center justify-content-center mt-2" role="button">
                    <i class="bi bi-chat-heart-fill actionIcon pe-1"></i>
                    <span class="uploadRentReceipt.php">Contact landlord</span>
                </a>
                <?php
                }
                else{
                    ?>
                    <a title="Sorry, you can't message the landlord as there's no designated contact person." class="btn btns btn-send-concern px-4 py-2 d-flex align-items-center justify-content-center mt-2" role="button">
                        <i class="bi bi-chat-heart-fill actionIcon pe-1"></i>
                        <span class="uploadRentReceipt.php">Contact landlord</span>
                    </a>
                    <?php
                }
                ?>
            

            <div class="d-flex flex-column renter-info mt-3">
                <p> If the landlord is unable to resolve the issue or doesn't respond at all, just let us know.</p>
                <?php
                    if($getleaseCount == 1){
                        if($getcomplaintnotifcount <= 0){
                ?>
                <a class="btn btns btn-send-concern px-4 py-2 d-flex align-items-center justify-content-center mt-2" role="button" data-bs-toggle="modal" data-bs-target="#complaintModal">
                    <i class="bi bi-chat-heart-fill actionIcon pe-1"></i>
                    <span class="uploadRentReceipt.php">Send complaint</span>
                </a>

                <div class="d-none">
                    <input type="text" id="txtRenterid" value="<?php echo $getlease['renter_id'] ?>">
                    <input type="text" id="txtLandlordid" value="<?php echo $getlease['landlord_id'] ?>">
                    <input type="text" id="txtPropertyid" value="<?php echo $getlease['property_id'] ?>">
                </div>
                <?php
                        }
                        else{
                            ?>
                            <a title="Please wait for the admin's response before sending again." class="btn btns btn-send-concern px-4 py-2 d-flex align-items-center justify-content-center mt-2" role="button">
                                <i class="bi bi-chat-heart-fill actionIcon pe-1"></i>
                                <span class="uploadRentReceipt.php">Send complaint</span>
                            </a>
                            <?php
                        }
                    }
                    else{
                        ?>
                        <a title="Apply first!" class="btn btns btn-send-concern px-4 py-2 d-flex align-items-center justify-content-center mt-2" role="button">
                            <i class="bi bi-chat-heart-fill actionIcon pe-1"></i>
                            <span class="uploadRentReceipt.php">Send complaint</span>
                        </a>
                        <?php
                    }
                    ?>

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

        function sendComplaintsToAdmin(){
            var renterid = document.getElementById('txtRenterid');
            var landlordid = document.getElementById('txtLandlordid');
            var propertyid = document.getElementById('txtPropertyid');

            var reasonvalue = document.getElementById('txtComplaintsreason');

            if(reasonvalue.value == ""){
                reasonvalue.setCustomValidity("Please enter the reason.");
                reasonvalue.reportValidity();
            }
            else{
                $.ajax({
                url: "../Functions/Renters/sendcomplaintoadmin.php",
                method:"POST",
                data:{
                    complainant: renterid.value,
                    defendant: landlordid.value,
                    reason: reasonvalue.value
                },
                dataType:"text"
            });
            $("#complaintModal").modal("hide");
            }
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