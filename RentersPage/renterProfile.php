<?php

session_start();
include('../DataBase/connection.php');
if(isset($_SESSION['rEmail'])){

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

<!-- Navbar - Renter -->
<?php
    $renterEmail = $_SESSION['rEmail'];
    $selectUser = "SELECT * FROM user_renter WHERE rEmail ='$renterEmail'";
    $executeSelectUser = mysqli_query($con, $selectUser);
    $getUser = mysqli_fetch_assoc($executeSelectUser);
    ?>
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
            <a class="navbar-brand" href="../">
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
                    <li><a class="dropdown-item active-dropdown " href="renterProfile.php">My Profile</a></li>
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
                            <button onclick="dropdownManageFunction()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block dd-renter-manage" type="button" id="" data-bs-toggle="dropdown" aria-expanded="false">
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
                                    <a class="dropdown-item d-flex justify-content-between" href="../messages.php" id="messageCount">Messages 
                                    </a>
                                </li>
                                <li><a class="dropdown-item" href="../favorites.php">Favorites</a></li>
                                <li><a class="dropdown-item active-dropdown" href="renterProfile.php">My Profile</a></li>
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
    <div class="container-fluid">
        <div class="main-section renter-prof d-flex flex-column justify-content-center align-items-center ">
            <div class="prof-containers">
                <div class="d-flex justify-content-between ">
                    <div>
                        <div class="d-flex mb-1 align-items-center">
                            <h3 class="title">My Profile  • </h3> 
                            <h5 class="title " style="color: #8c52ff;">&nbsp;Renter</h5>
                        </div>
                        <h5><span class="prof-name"><?php echo $getUser['rFname'] . " " . $getUser['rLname'] ?></span>, <span class="prof-email"><?php echo $getUser['rEmail'] ?></span> </h5>
                    </div>

                <!-- PROFILE PIC-->
                    <div class="d-flex flex-column">
                        <div class="d-none">
                            <input type="file" id="renternewprofile" accept=".png, .jpg, .jpeg">
                        </div>
                        <img src="<?php echo $getUser['rImgProfile'] ?>" alt="" class="prof-img">
                        <div class="d-flex justify-content-center ">
                            <button id="editRenterProfile" class="d-flex align-items-center justify-content-center gap-1 edit-img w-75">
                                <i class="bi bi-camera-fill"></i>
                                <a class="links py-1 text-decoration-none ">Edit</a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="prof-containers">
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
                                    <input type="password" name="" id="rPassword" class="input_left prof-inputs px-3 py-2" minlength="8" onblur="checkPass()" required="required" placeholder=" " autocomplete="off">
                                    <span class="placeholder span_placeholder"> Current password </span>
            
                                    <span class="input-group-text span_right btn" id="toggle_password4">
                                        <i class="bi bi-eye-slash span_icons icon4" id=""></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-6 ps-1">
                                <div class="input-block form_inputs d-flex flex-row " >
                                    <input type="password" name="" id="rnewPassword" class="input_left prof-inputs px-3 py-2" minlength="8" onblur="checkPass()" required="required" placeholder=" " autocomplete="off">
                                    <span class="placeholder span_placeholder"> New password </span>
            
                                    <span class="input-group-text span_right btn" id="toggle_password5">
                                        <i class="bi bi-eye-slash span_icons icon5" id=""></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-6 mt-3 d-flex align-items-end">
                                <a href="" class="links">Need a new password?</a>
                                
                            </div>
                            <div class="col-6 ps-1 mt-3"  >
                                <div class="input-block form_inputs  d-flex flex-row " >
                                    <input type="password" name="" id="rconfirmnewPassword" class="input_left prof-inputs px-3 py-2" minlength="8" onblur="checkPass()" required="required" placeholder=" " autocomplete="off">
                                    <span class="placeholder span_placeholder"> Confirm password </span>
            
                                    <span class="input-group-text span_right btn" id="toggle_password6">
                                        <i class="bi bi-eye-slash span_icons icon6" id=""></i>
                                    </span>
                                </div>
                            </div>
                            
                        </div>
                        <button id="save_new_rpass" class="btns-profile btn-save-pass px-4 text-light mt-3">Save</button>
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
                        
                        <p class="p-name"><?php echo $getUser['rFname'] . " " . $getUser['rLname'] ?></p>
                    </div>
        
                    <div class="form-name d-none">
                        <div class="row mt-3 ">
                            <div class="col-6 pe-1">
                                <div class="input-block form_inputs mb-3" >
                                    <input type="email" name="" id="rrenterf" class="prof-inputs px-3 py-2" required="required" spellcheck="false" placeholder=" " autocomplete="off">
                                    <span class="placeholder"> First Name </span>
                                </div>
                            </div>
                            <div class="col-6 ps-1">
                                <div class="input-block form_inputs mb-3" >
                                    <input type="email" name="" id="rrenterlast" class="prof-inputs px-3 py-2" required="required" spellcheck="false" placeholder=" " autocomplete="off">
                                    <span class="placeholder"> Last Name </span>
                                </div>
                            </div>
                        </div>
                        <button id="btnsavername" class="btns-profile btn-save-name px-4 text-light">Save</button>
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
                        
                        <p class="p-num"><?php echo $getUser['rNum'] ?></p>
                    </div>

                    <div class="form-num d-none">
                        <div class="input-block form_inputs mb-3 mt-3" >
                            <input type="email" name="" id="rNumber" minlength="11" maxlength="11" onkeydown="return /^([0-9]|Backspace)*$/i.test(event.key) || event.key.length > 1" class="prof-inputs px-3 py-2" required="required" spellcheck="false" placeholder=" " autocomplete="off">
                            <span class="placeholder"> New Phone No. </span>
                        </div>
                        <button id="btnrEditNumber" class="btns-profile btn-save-num px-4 text-light">Save</button>
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