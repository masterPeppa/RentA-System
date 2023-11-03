<?php
session_start();
include ("DataBase/connection.php");
if(isset($_SESSION['rEmail']) || isset($_SESSION['lEmail'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentA | Favorites</title>
    <link rel="icon" type="image/x-icon" href="imgs/key.ico">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <!-- CSS -->
    <link rel="stylesheet" href="CSS/">
    <link rel="stylesheet" href="CSS/stylesNav.css">
    <link rel="stylesheet" href="CSS/stylesFavorites.css">
    <link rel="stylesheet" href="CSS/stylesIndex.css">

    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

</head>
<body>
<!-- Navbar - Renter -->
<?php
    if(isset($_SESSION['rEmail'])){
        $renterEmail = $_SESSION['rEmail'];
        $selectUser = "SELECT * FROM user_renter WHERE rEmail ='$renterEmail'";
        $executeSelectUser = mysqli_query($con, $selectUser);
        $getUser = mysqli_fetch_assoc($executeSelectUser);

        $favorite_user_id = 'r'.$getUser['rId'];

        $userProfile = str_replace("../", "", $getUser['rImgProfile']);
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
            <a class="navbar-brand" href="../../RentA">
                <img src="imgs/logo.png" alt="RentA" id="imgLogo">
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
                        <a class="dropdown-item dropdown-item-first d-flex justify-content-between" href="RentersPage/renterNotifications.php" id="smNotifCount"> 
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex justify-content-between active-dropdown" href="messages.php" id="smmessageCount"> 
                        </a>
                    </li>
                    <li><a class="dropdown-item active-dropdown" href="favorites.php">Favorites</a></li>
                    <li><a class="dropdown-item " href="RentersPage/renterProfile.php">My Profile</a></li>
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
                        <button onclick="dropdownManageFunction()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block dd-renter-manage" type="button" id="" data-bs-toggle="dropdown" aria-expanded="false">
                            Manage
                            <i class="bi bi-chevron-down nav-icons" id="chevron-down-manage"></i>
                            <i class="bi bi-chevron-up nav-icons" id="chevron-up-manage"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-rentals" aria-labelledby="dropdrownbtn-manage">
                            <li><a class="dropdown-item dropdown-item-first" href="RentersPage/application1Submit.php">Application</a></li>
                            <li><a class="dropdown-item" href="RentersPage/manageMonthlyRent.html">Monthly Rent</a></li>
                            <li><a class="dropdown-item dropdown-item-last" href="RentersPage/manageRentalConcern.html">Rental Concern</a></li>
                            
                        </ul>
                    </li>

                   <li class="nav-item d-block d-sm-block d-md-none">
                        <a class="nav-link" href="RentersPage/application1Submit.php">Application</a>
                    </li>

                    <li class="nav-item d-block d-sm-block d-md-none">
                        <a class="nav-link" href="RentersPage/manageMonthlyRent.html">Monthly Rent</a>
                    </li>

                    <li class="nav-item d-block d-sm-block d-md-none">
                        <a class="nav-link " href="RentersPage/manageRentalConcern.html">Rental Concern</a>
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
                                <a class="dropdown-item dropdown-item-first d-flex justify-content-between" href="RentersPage/renterNotifications.php" id="notifCount">
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex justify-content-between" href="messages.php" id="messageCount"> 
                                </a>
                            </li>
                            <li><a class="dropdown-item active-dropdown" href="favorites.php">Favorites</a></li>
                            <li><a class="dropdown-item " href="RentersPage/renterProfile.php">My Profile</a></li>
                            <li><a class="dropdown-item dropdown-item-last" data-bs-toggle="modal" data-bs-target="#logoutModal">Log out</a></li>
                        </ul>
                    </div>
                </ul>
            </div>
        </div>
    </nav>
</div>
        <?php
    }
    ?>
    <!-- end navbar renter -->

    <!-- Navbar - Landlord -->
<?php
    if(isset($_SESSION['lEmail'])){
        $landlordEmail = $_SESSION['lEmail'];
        $selectUser = "SELECT * FROM user_landlord WHERE lEmail	='$landlordEmail'";
        $executeSelectUser = mysqli_query($con, $selectUser);
        $getUser = mysqli_fetch_assoc($executeSelectUser);

        $favorite_user_id = 'l'.$getUser['lID'];

        $userProfile = str_replace("../", "", $getUser['lImgProfile']);
        ?>
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
                <a class="navbar-brand" href="../RentA">
                    <img src="imgs/logo.png" alt="RentA" id="imgLogo">
                </a>
                
                <!-- Avatar - Landlord on small screen -->
                <div class="dropdown ms-auto d-sm-block d-md-none">
                    <button onclick="dropdownAvatarFunction()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block" type="button" id="dropdrownbtn-avatar" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo $userProfile ?>" alt="" class="img-avatar me-1">
                        <i class="bi bi-chevron-down nav-icons" id="chevron-down-avatar"></i>
                        <i class="bi bi-chevron-up nav-icons" id="chevron-up-avatar"></i>
                        <div class="d-none">
                            <input type="text" id="txtUserId" value="<?php echo $getUser['lID'] ?>">
                        </div>
                    <span id="smnotifyCircle">
                    </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-avatar-sm " aria-labelledby="dropdrownbtn-avatar">
                        <li>
                            <a class="dropdown-item dropdown-item-first d-flex justify-content-between" href="landlordPage/landlordNotifications.php" id="lsmNotifCount"> 
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex justify-content-between" href="messages.php" id="smmessageCount">
                            </a>
                        </li>
                        <li><a class="dropdown-item active-dropdown" href="favorites.php">Favorites</a></li>
                        <li><a class="dropdown-item" href="">My Profile</a></li>
                        <li><a class="dropdown-item dropdown-item-last" data-bs-toggle="modal" data-bs-target="#logoutModal">Log out</a></li>
                    </ul>
                </div>

                <!-- links center -->
                <div class="collapse navbar-collapse" id="navMenuLandlord">

                    <ul class="navbar-nav navbar-nav-landlord d-flex align-items-center">
                        
                        <li class="nav-item px-3">
                            <a class="nav-link" href="landlordPage/manageProperty.php">My Properties</a>
                        </li>

                        <!-- Manage Renters -->
                        <li class="nav-item dropdown d-none d-sm-none d-md-block">
                            <button onclick="dropdownManageFunction()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block" type="button" id="dropdrownbtn-manage" data-bs-toggle="dropdown" aria-expanded="false">
                                Manage Renters
                                <i class="bi bi-chevron-down nav-icons" id="chevron-down-manage"></i>
                                <i class="bi bi-chevron-up nav-icons" id="chevron-up-manage"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-manage" aria-labelledby="dropdrownbtn-manage">
                                <li><a class="dropdown-item dropdown-item-first" href="landlordPage/manageApplicants.php">Applicants</a></li>
                                <li><a class="dropdown-item" href="landlordPage/manageLeases.php">Approved Applicants</a></li>
                                <li><a class="dropdown-item dropdown-item-last" href="#">Residents & Leases</a></li>
                            </ul>
                        </li>

                       <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link" href="">Manage Applicants</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link" href="">Approved Applicants</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link" href="">Residents & Leases</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link listProperty" onclick="checklistProperty()">List a Property</a>
                        </li>

                    </ul>
                    
                    <ul class="d-flex align-items-center ms-auto">
                        <!-- Avatar - Landlord big-->
                        <div class="dropdown me-2 d-none d-sm-none d-md-block ">
                            <button onclick="dropdownAvatarFunction2()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block" type="button" id="dropdrownbtn-avatar" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?php echo $userProfile ?>" alt="" class="img-avatar me-1">
                                <i class="bi bi-chevron-down nav-icons" id="chevron-down-avatar2"></i>
                                <i class="bi bi-chevron-up nav-icons" id="chevron-up-avatar2"></i>
                                <span id="notifyCircle">
                                </span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-avatar-renter" aria-labelledby="dropdrownbtn-avatar">
                                <li>
                                    <a class="dropdown-item dropdown-item-first d-flex justify-content-between" href="landlordPage/landlordNotifications.php" id="lnotifCount"> 
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex justify-content-between" href="messages.php" id="messageCount"> 
                                    </a>
                                </li>
                                <li><a class="dropdown-item active-dropdown" href="favorites.php">Favorites</a></li>
                                <li><a class="dropdown-item" href="landlordPage/landlordProfile.php">My Profile</a></li>
                                <li><a class="dropdown-item dropdown-item-last" data-bs-toggle="modal" data-bs-target="#logoutModal">Log out</a></li>
                            </ul>
                        </div>

                        <!-- List property button -->
                        <div class=" nav-item d-none d-sm-none d-md-block">
                            <a onclick="checklistProperty()" class="btn btns listProperty btn_listProperty pt-2">List a Property</a>
                        </div>
                    </ul>

                </div>
            </div>
        </nav>
    </div>
    <?php
    }
    ?>
    <!-- end navbar - landlord -->
    
<!-- MODAL NOT VERIFIED YET -->
<div class="modal fade" id="cantListModal" tabindex="-1" aria-labelledby="reasonModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content modals modal_cantList">

                <div class="modal-header modal-header-logout p-3">
                    <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="d-flex flex-column align-items-center justify-content-center px-md-5 px-3">
                        <img src="imgs/warning.png" alt="" class="img-logout">
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
    <!-- Modal - Login as-->
    <div class="modal fade" id="modal_loginAs" tabindex="-1" aria-labelledby="modal_loginAs" aria-hidden="true">
            <div class="modal-dialog vertical-align-center">
                <div class="modal-content vertical-align-center ">
                    <div class="modal-body">

                        <div class="container_loginAs">
                            <header class="text-center mt-5">Which one are you?</header>
                            <div class="row mt-5 d-flex align-items-center justify-content-center">
                    
                                <div class="col-md-6 col-12 d-flex align-items-center justify-content-end pe-5 columns btnRenter">
                                    <div class="aRenter box boxes-loginAs d-flex flex-column justify-content-center align-items-center ">
                                        <img src="imgs/aRenter.png" alt="I'm a Renter" class="img-renter d-md-block d-none">
                                        <p class="mt-4 btn-margin p-label">I'm a Renter</p>
                                    </div>
                                </div>
                    
                                <div class="col-md-6 col-12 d-flex align-items-center justify-content-start ps-5 columns btnLandlord">
                                    <div class="aLandlord box boxes-loginAs d-flex flex-column justify-content-center align-items-center">
                                        <img src="imgs/aLandlord.png" alt="I'm a Landlord" class="img-landlord d-md-block d-none ">
                                        <p class="mt-4 btn-margin p-label">I'm a Landlord</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
<!-- modal end - Login as -->

    <!-- MAIN -->
     <div class="container-favorites">
          <h3 class="ms-1">Favorites</h3>
         
     <!-- CARDS SECTION -->
          <section class="mt-5 section-cards">
               <div class="wrapper-cards-favorites d-grid" id="cardContainer">

               
               </div>
          </section>

     </div>
     <div class="d-none">
          <input type="text" value="<?php echo $favorite_user_id ?>" id="txtFavid">
     </div>




    <!-- JS -->
    <script src="JavaScripts/functionNav.js"></script>

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
                    url:"Functions/realtimeMessageCount.php",
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
                    url:"Functions/realtimeMessageCount.php",
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
                    url:"Functions/realtimeNotif.php",
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
                    url:"Functions/realtimeNotif.php",
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
                    url:"Functions/realTimeFavorite.php",
                    method:"POST",
                    data:{
                        favId:$("#txtFavid").val()
                    },
                    dataType:"text",
                    success:function(data)
                    {
                        $("#cardContainer").html(data);
                    }
                });
            }, 700);
            setInterval(function(){
                $.ajax({
                    url:"Functions/Renters/realtimeapplicationNotif.php",
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
                    url:"Functions/Landlord/realtimeNotifCount.php",
                    method:"POST",
                    data:{
                        userid:$("#txtUserId").val()
                    },
                    dataType:"text",
                    success:function(data)
                    {
                        $("#lnotifCount").html(data);
                    }
                });
            }, 700);
            setInterval(function(){
                $.ajax({
                    url:"Functions/Landlord/realtimeNotifCount.php",
                    method:"POST",
                    data:{
                        userid:$("#txtUserId").val()
                    },
                    dataType:"text",
                    success:function(data)
                    {
                        $("#lsmNotifCount").html(data);
                    }
                });
            }, 700);

            setInterval(function(){
                $.ajax({
                    url:"Functions/Renters/realtimeNotifCount.php",
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
                    url:"Functions/Renters/realtimeNotifCount.php",
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
     echo "<script>window.location.href = '../RentA'</script>";
}
// Close the database connection
mysqli_close($con);
?>