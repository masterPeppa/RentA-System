<?php
session_start();
include ("DataBase/connection.php");
include ("Functions/commonFunctions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>RentA | Find Rentals</title>
     <link rel="icon" type="image/x-icon" href="imgs/key.ico">
     <!-- Bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

     <!-- Bootstrap icons -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

     <!-- CSS -->
     <link rel="stylesheet" href="CSS/">
     <link rel="stylesheet" href="CSS/stylesNav.css">
     <link rel="stylesheet" href="CSS/stylesLoginAs.css">
     <link rel="stylesheet" href="CSS/stylesIndex.css">
     <link rel="stylesheet" href="CSS/stylesRentals.css">
</head>
<body>
<!-- Navbar - Guest -->
<?php
            if(!isset($_SESSION['rEmail']) && !isset($_SESSION['lEmail'])){
        ?>
       <!-- Navbar - Guest -->
        <div class="nav-container fixed-top">
            <nav class="navbar navbar-expand-md px-3 px-md-5">
                <div class="container-fluid">

                    <!-- burger -->
                    <button class="navbar-toggler collapsed d-flex d-sm-block d-md-none flex-column justify-content-around" type="button" data-bs-toggle="collapse" data-bs-target="#navMenuGuest" >
                        <span class="toggler-icon top-bar"></span>
                        <span class="toggler-icon middle-bar"></span>
                        <span class="toggler-icon bottom-bar"></span>
                    </button>

                    <!-- logo -->
                    <a class="navbar-brand" href="../RentA">
                        <img src="imgs/logo.png" alt="RentA" id="imgLogo">
                    </a>
                    
                    <div class="d-none">
                        <input type="text" id="txtEmail" value="">
                    </div>
                    <!-- Avatar - guest on small screen -->
                    <div class="dropdown ms-auto d-sm-block d-md-none d-sm-inline-flex d-inline-flex">
                         <button class="btn btn-show-filter d-flex align-items-center justify-content-center p-3 me-2" id="btnSmShowFilter" data-bs-toggle="modal" data-bs-target="#showSmFilters">
                              <img src="imgs/filter.png" alt="" class="img-search">
                         </button>
                        <button onclick="dropdownAvatarFunction()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block" type="button" id="dropdrownbtn-avatar" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="imgs/profile.png" alt="" class="img-avatar">
                            <i class="bi bi-chevron-down nav-icons" id="chevron-down-avatar"></i>
                            <i class="bi bi-chevron-up nav-icons" id="chevron-up-avatar"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-avatar-renter-sm " aria-labelledby="dropdrownbtn-avatar">
                            <li><a class="dropdown-item dropdown-item-first" data-bs-toggle="modal" data-bs-target="#modal_loginAs" href="#">Log In / Register</a></li>
                            <li><a class="dropdown-item dropdown-item-last" href="landlordPage/starterPage.php?action='listproperty'">List a property</a></li>
                        </ul>
                    </div>

                    <!-- links center -->
                    <div class="collapse navbar-collapse" id="navMenuGuest">

                        <ul class="navbar-nav navbar-nav-renter d-flex align-items-center ms-auto">
                            <li class="nav-item px-3">
                                <a class="nav-link" href="../RentA">Home</a>
                            </li>
                            <li class="nav-item px-4">
                                <a class="nav-link active-link" href="rentals.php">Find Rentals</a>
                            </li>
                        </ul>

                        <ul class="d-flex align-items-center ms-auto">
                            <!-- Avatar - guest big-->
                            <div class="dropdown">
                                <button onclick="dropdownAvatarGuestFunction()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block" type="button" id="dropdrownbtn-avatar" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="imgs/profile.png" alt="" class="img-avatar-guest me-1">
                                    <i class="bi bi-chevron-down nav-icons" id="chevron-down-avatar-guest"></i>
                                    <i class="bi bi-chevron-up nav-icons" id="chevron-up-avatar-guest"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-avatar-renter" aria-labelledby="dropdrownbtn-avatar">
                                    <li><a class="dropdown-item dropdown-item-first" data-bs-toggle="modal" data-bs-target="#modal_loginAs" href="#">Log In / Register</a></li>
                                    <li><a class="dropdown-item dropdown-item-last" href="landlordPage/starterPage.php?action='listproperty'">List a property</a></li>
                                </ul>
                            </div>
                        </ul>

                    </div>
                </div>
            </nav>
        </div>
    <!-- end navbar - guest -->

    <?php
                }
    ?>

<!-- Navbar - Renter -->
    <?php
    if(isset($_SESSION['rEmail'])){
        $renterEmail = $_SESSION['rEmail'];
        $selectUser = "SELECT * FROM user_renter WHERE rEmail ='$renterEmail'";
        $executeSelectUser = mysqli_query($con, $selectUser);
        $getUser = mysqli_fetch_assoc($executeSelectUser);

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
                        <a class="dropdown-item dropdown-item-first d-flex justify-content-between" href="renterNotifications.php" id="smNotifCount"> 
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex justify-content-between active-dropdown" href="../messages.php" id="smmessageCount"> 
                        </a>
                    </li>
                    <li><a class="dropdown-item" href="favorites.php">Favorites</a></li>
                    <li><a class="dropdown-item " href="RentersPage/renterProfile.php">My Profile</a></li>
                    <li><a class="dropdown-item dropdown-item-last" data-bs-toggle="modal" data-bs-target="#logoutModal">Log out</a></li>
               </ul>
               </div>

            <!-- links center -->
            <div class="collapse navbar-collapse" id="navMenuRenter">

                <ul class="navbar-nav navbar-nav-renter d-flex gap-2 align-items-center ms-auto">
                    <li class="nav-item px-3">
                        <a class="nav-link active-dropdown" href="rentals.php">Find Rentals</a>
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
                            <li><a class="dropdown-item" href="RentersPage/manageMonthlyRent.php">Monthly Rent</a></li>
                            <li><a class="dropdown-item dropdown-item-last" href="RentersPage/manageRentalConcern.php">Rental Concern</a></li>
                            
                        </ul>
                    </li>

                   <li class="nav-item d-block d-sm-block d-md-none">
                        <a class="nav-link" href="RentersPage/application1Submit.php">Application</a>
                    </li>

                    <li class="nav-item d-block d-sm-block d-md-none">
                        <a class="nav-link" href="RentersPage/manageMonthlyRent.php">Monthly Rent</a>
                    </li>

                    <li class="nav-item d-block d-sm-block d-md-none">
                        <a class="nav-link " href="RentersPage/manageRentalConcern.php">Rental Concern</a>
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
                                    <a class="dropdown-item d-flex justify-content-between" href="messages.php" id="messageCount">Messages 
                                    </a>
                                </li>
                                <li><a class="dropdown-item" href="favorites.php">Favorites</a></li>
                                <li><a class="dropdown-item" href="RentersPage/renterProfile.php">My Profile</a></li>
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
        $delete_query = mysqli_query($con, "DELETE FROM landing_properties WHERE publishing_status='Not yet' AND landlord_id='".$_SESSION['landlordId']."'");
        $delete_query1 = mysqli_query($con, "DELETE FROM landing_properties_new WHERE publishing_status='Not yet' AND landlord_id='".$_SESSION['landlordId']."'");

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
                        <li><a class="dropdown-item" href="landlordPage/landlordProfile.php">My Profile</a></li>
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
                            <button onclick="dropdownManageFunction()" onblur="blurFunction()" class="btn active btn-light dropdown-toggle d-inline-block" type="button" id="dropdrownbtn-manage" data-bs-toggle="dropdown" aria-expanded="false">
                                Manage Renters
                                <i class="bi bi-chevron-down nav-icons" id="chevron-down-manage"></i>
                                <i class="bi bi-chevron-up nav-icons" id="chevron-up-manage"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-manage" aria-labelledby="dropdrownbtn-manage">
                                <li><a class="dropdown-item dropdown-item-first" href="landlordPage/manageApplicants.php">Applicants</a></li>
                                <li><a class="dropdown-item" href="landlordPage/manageLeases.php">Leases</a></li>
                                <li><a class="dropdown-item" href="landlordPage/manageAdvancePayments.php">Advance Payments</a></li>
                                <li><a class="dropdown-item" href="landlordPage/manageResidents.php">Residents</a></li>
                                <li><a class="dropdown-item dropdown-item-last" href="landlordPage/manageResidentsRent.php">Residents' Rents</a></li>
                            </ul>
                        </li>

                       <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link" href="landlordPage/manageApplicants.php">Applicants</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link " href="landlordPage/manageLeases.php">Leases</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link" href="landlordPage/manageAdvancePayments.php">Advance Payments</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link" href="landlordPage/manageResidents.php">Residents</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link" href="landlordPage/manageResidentsRent.php">Residents' Rents</a>
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
                                <li><a class="dropdown-item" href="landlordPage/landlordrProfile.php">My Profile</a></li>
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
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="modalDelete" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content container_modalLogout">

                <div class="modal-header modal-header-logout p-3">
                    <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body modal-body-logout">
                    <section class="section_logout">
                        
                        <div class="div-logout d-flex flex-column align-items-center justify-content-center mt-3">
                            <img src="imgs/logout.png" alt="" class="img-logout">
                            <h5 class="text-center mt-1">Are you sure you want to logout?</h5>
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
          <div class="modal-dialog">
          <div class="modal-content div_loginAs ">
               <div class="modal-body ">

                    <div class="container_loginAs ">
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

   
<!-- Modal SM - Filters -->
     <div class="modal fade" id="showSmFilters" tabindex="-1" aria-labelledby="showSmFilters" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-sm-filter">
               <div class="modal-content modal-filters">
          
                    <div class="modal-header modal-header-filters">
                         <button type="button" class="btn-close btn-close-filters" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
          
                    <div class="modal-body modal-body-filters">
                         <section class="section-sm-filters">
                              <div class="wrapper-sm-filters d-flex flex-column">
                                   
                              <!-- PROPERTY TYPE -->
                                   <div>
                                        <label for="typeMenuSm" class="labels-filter ms-2 mb-2">PROPERTY TYPE</label>
                                        <div class="dropdown typeMenuSm">
                                                  <button onclick="ddsmTypeFunction()" onblur="blurFunction()" id="propertyTypeValue" value="Any" class="btn dropdown-toggle btn-type-sm propertyType d-flex justify-content-between rental-inputs" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                       <span class="btn-txt-type-sm">Any</span>
                                                       <i class="bi bi-chevron-down icons" id="downTypeSm"></i>
                                                       <i class="bi bi-chevron-up icons" id="upTypeSm"></i>
                                                  </button>
                                             <ul class="dropdown-menu dmenu dropdown-menu-ptype">
                                                  <li class="type-option-sm"><a class="dropdown-item dropdown-item-first opt-type-text-sm" href="#">Any</a></li>
                                                  <li class="type-option-sm"><a class="dropdown-item opt-type-text-sm" href="#">Apartment</a></li>
                                                  <li class="type-option-sm"><a class="dropdown-item opt-type-text-sm" href="#">Commercial</a></li>
                                                  <li class="type-option-sm"><a class="dropdown-item opt-type-text-sm" href="#">Condominium</a></li>
                                                  <li class="type-option-sm"><a class="dropdown-item opt-type-text-sm" href="#">Bed Space</a></li>
                                                  <li class="type-option-sm"><a class="dropdown-item dropdown-item-last opt-type-text-sm" href="#">Dormitory</a></li>
                                             </ul>
                                        </div>
                                   </div>

                              <!-- PROPERTY LOCATION -->
                                   <div class="d-flex flex-column">
                                        <label for="propertyLoc" class="labels-filter ms-2 mb-2 mt-3">LOCATION</label>
                                             <input type="text" oninput="ModallocationTextboxFunction(this.value)" id="modalfilterLocation" class="rental-inputs txt-location"  autocomplete="off">
                                             <div id="suggestionList1" style=""></div>
                                   </div>

                              <!-- PRICE RANGE -->
                                   <div>
                                        <label for="priceMenu" class="labels-filter ms-2 mt-2">PRICE</label>
                                        <div class="wrapper wrapper-range-sm ms-2 priceMenu">
                                   
                                             <div class="slider-sm">
                                                  <div class="progress-sm"></div>
                                             </div>
                                             <!-- SLIDER INPUT -->
                                             <div class="range-input-sm">
                                                  <input type="range" class="range-min-sm" min="0" max="100000" value="0" step="100">
                                                  <input type="range" class="range-max-sm" min="0" max="100000" value="100000" step="100">
                                             </div>

                                             <div class="price-input-sm d-flex mt-1">
                                                  <!-- MINIMUM VALUE -->
                                                  <div class="field d-flex align-items-center"> 
                                                       <input type="number" class="input-min-sm text-center" value="0">
                                                  </div>
                                        
                                                  <div class="separator d-flex align-items-center justify-content-center">-</div>
                                                  <!-- MAXIMUM VALUE -->
                                                  <div class="field d-flex align-items-center">
                                                            <input type="number" class="input-max-sm text-center" value="100000">
                                                  </div>
                                             </div>
                                        </div>
                                   
                                   </div>

                              <!-- BED COUNT -->
                                   <div>
                                        <label for="bedMenuSm" class="labels-filter ms-2 mb-2 mt-3">BEDROOM</label>
                                        <div class="dropdown bedMenuSm">
                                             <button onclick="ddsmBedFunction()" onblur="blurFunction()" class="btn dropdown-toggle btn-bed-sm mt-1 d-flex justify-content-between rental-inputs" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                  <span class="btn-txt-bed-sm">Any</span>
                                                  <i class="bi bi-chevron-down icons" id="downBedSm"></i>
                                                  <i class="bi bi-chevron-up icons" id="upBedSm"></i>
                                             </button>
                                             <ul class="dropdown-menu dmenu dropdown-menu-ptype">
                                                  <li class="bed-option-sm"><a class="dropdown-item d-item dropdown-item-first opt-bed-text-sm" href="#">Any</a></li>
                                                  <li class="bed-option-sm"><a class="dropdown-item d-item opt-bed-text-sm" href="#">1</a></li>
                                                  <li class="bed-option-sm"><a class="dropdown-item d-item opt-bed-text-sm" href="#">2</a></li>
                                                  <li class="bed-option-sm"><a class="dropdown-item d-item opt-bed-text-sm" href="#">3</a></li>
                                                  <li class="bed-option-sm"><a class="dropdown-item d-item opt-bed-text-sm" href="#">4</a></li>
                                                  <li class="bed-option-sm"><a class="dropdown-item d-item dropdown-item-last opt-bed-text-sm" href="#">5+</a></li>
                                             </ul>
                                        </div>
                                   </div>

                              <!-- BATH COUNT -->
                                   <div>
                                        <label for="bathMenuSm" class="labels-filter ms-2 mb-2 mt-3">BATHROOM</label>
                                        <div class="dropdown bathMenuSm">
                                             <button onclick="ddsmBathFunction()" onblur="blurFunction()" class="btn dropdown-toggle btn-bath-sm mt-1 d-flex justify-content-between rental-inputs" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                  <span class="btn-txt-bath-sm">Any</span> 
                                                  <i class="bi bi-chevron-down icons" id="downBathSm"></i>
                                                  <i class="bi bi-chevron-up icons" id="upBathSm"></i>
                                             </button>
                                             <ul class="dropdown-menu dmenu dropdown-menu-ptype">
                                                  <li class="bath-option-sm"><a class="dropdown-item d-item dropdown-item-first opt-bath-text-sm" href="#">Any</a></li>
                                                  <li class="bath-option-sm"><a class="dropdown-item d-item opt-bath-text-sm" href="#">1</a></li>
                                                  <li class="bath-option-sm"><a class="dropdown-item d-item opt-bath-text-sm" href="#">2</a></li>
                                                  <li class="bath-option-sm"><a class="dropdown-item d-item opt-bath-text-sm" href="#">3</a></li>
                                                  <li class="bath-option-sm"><a class="dropdown-item d-item opt-bath-text-sm" href="#">4</a></li>
                                                  <li class="bath-option-sm"><a class="dropdown-item d-item dropdown-item-last opt-bath-text-sm" href="#">5+</a></li>
                                             </ul>
                                        </div>
                                   </div>

                              <!-- FLOOR AREA -->
                                   <div>
                                        <label for="floorAreaMenuSm" class="labels-filter ms-2 mb-2 mt-3">FLOOR AREA</label>
                                        <div class="dropdown floorAreaMenuSm">
                                             <button onclick="ddsmFloorFunction()" onblur="blurFunction()" class="btn dropdown-toggle btn-floor-area-sm mt-1 d-flex justify-content-between rental-inputs" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                  <span class="btn-txt-floor-sm">Any Size</span> 
                                                  <i class="bi bi-chevron-down icons" id="downFloorSm"></i>
                                                  <i class="bi bi-chevron-up icons" id="upFloorSm"></i>
                                             </button>
                                             <ul class="dropdown-menu dmenu dropdown-menu-ptype">
                                                  <li class="floor-option-sm"><a class="dropdown-item dropdown-item-first opt-floor-text-sm" href="#">Below 20m<sup>2</sup></a></li>
                                                  <li class="floor-option-sm"><a class="dropdown-item opt-floor-text-sm" href="#">21m<sup>2</sup> - 50m<sup>2</sup></a></li>
                                                  <li class="floor-option-sm"><a class="dropdown-item opt-floor-text-sm" href="#">51m<sup>2</sup> - 100m<sup>2</sup></a></li>
                                                  <li class="floor-option-sm"><a class="dropdown-item dropdown-item-last opt-floor-text-sm" href="#">101m<sup>2</sup> & above</a></li>
                                             </ul>
                                        </div>
                                   </div>

                                   <!-- DROPDOWN AMENITIES -->
                                   <div class="d-none">
                                        <input type="text" id="dropdownValuessm" value="">
                                   </div>
                                   <div class="container dd-container">
                                        <label for="smAmenitiesMenu" class="labels-filter ms-2 mb-2 mt-3">AMENITIES</label>
                                        <div class="smAmenitiesMenu">
                                             <button onclick="ddsmAmenityFunction()" onblur="blurFunction()" class="select-btn-sm d-flex justify-content-between rental-inputs bg-light dropdown-toggle">
                                                  <span class="select-btn-txt-sm">Select Amenity</span>
                                                  <i class="bi bi-chevron-down icons" id="downAmenitySm"></i>
                                                  <i class="bi bi-chevron-up icons" id="upAmenitySm"></i>
                                             </button>
                                        
                                             <ul class="amenity-options-sm" id="smAmenityMenu" onmouseleave="blurFunction()">
                                                  <li class="amenity-option-sm d-flex justify-content-between dropdown-item dropdown-item1">
                                                       <span class="amenity-text-option-sm" >Wi-Fi</span>
                                                       <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                                  </li>
                                                  <li class="amenity-option-sm d-flex justify-content-between dropdown-item">
                                                       <span class="amenity-text-option-sm">Air conditioner</span>
                                                       <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                                  </li>
                                                  <li class="amenity-option-sm d-flex justify-content-between dropdown-item">
                                                       <span class="amenity-text-option-sm" >Soundproof walls</span>
                                                       <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                                  </li>
                                                  <li class="amenity-option-sm d-flex justify-content-between dropdown-item">
                                                       <span class="amenity-text-option-sm">Bath tub</span>
                                                       <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                                  </li>
                                                  <li class="amenity-option-sm d-flex justify-content-between dropdown-item">
                                                       <span class="amenity-text-option-sm">Sofa</span>
                                                       <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                                  </li>
                                                  <li class="amenity-option-sm d-flex justify-content-between dropdown-item">
                                                       <span class="amenity-text-option-sm">Bed</span>
                                                       <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                                  </li>
                                                  <li class="amenity-option-sm d-flex justify-content-between dropdown-item">
                                                       <span class="amenity-text-option-sm">Work Table</span>
                                                       <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                                  </li>
                                                  <li class="amenity-option-sm d-flex justify-content-between dropdown-item">
                                                       <span class="amenity-text-option-sm">Bar Stool</span>
                                                       <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                                  </li>
                                                  <li class="amenity-option-sm d-flex justify-content-between dropdown-item">
                                                       <span class="amenity-text-option-sm" >Dining Set</span>
                                                       <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                                  </li>
                                                  <li class="amenity-option-sm d-flex justify-content-between dropdown-item">
                                                       <span class="amenity-text-option-sm">Fireplace</span>
                                                       <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                                  </li>
                                                  <li class="amenity-option-sm d-flex justify-content-between dropdown-item">
                                                       <span class="amenity-text-option-sm" >Hardwood floor</span>
                                                       <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                                  </li>
                                                  <li class="amenity-option-sm d-flex justify-content-between dropdown-item">
                                                       <span class="amenity-text-option-sm">Wardrobe</span>
                                                       <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                                  </li>
                                                  <li class="amenity-option-sm d-flex justify-content-between dropdown-item">
                                                       <span class="amenity-text-option-sm" >Washer-Dryer</span>
                                                       <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                                  </li>
                                                  <li class="amenity-option-sm d-flex justify-content-between dropdown-item">
                                                       <span class="amenity-text-option-sm">Washer-Dryer Hookup</span>
                                                       <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                                  </li>
                                                  <li class="amenity-option-sm d-flex justify-content-between dropdown-item">
                                                       <span class="amenity-text-option-sm" >Dishwasher</span>
                                                       <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                                  </li>
                                                  <li class="amenity-option-sm d-flex justify-content-between dropdown-item">
                                                       <span class="amenity-text-option-sm">Range oven</span>
                                                       <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                                  </li>
                                                  <li class="amenity-option-sm d-flex justify-content-between dropdown-item">
                                                       <span class="amenity-text-option-sm" >CCTV</span>
                                                       <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                                  </li>
                                                  <li class="amenity-option-sm d-flex justify-content-between dropdown-item">
                                                       <span class="amenity-text-option-sm">24-hr security</span>
                                                       <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                                  </li>
                                                  <li class="amenity-option-sm d-flex justify-content-between dropdown-item">
                                                       <span class="amenity-text-option-sm" >Smart lock</span>
                                                       <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                                  </li>
                                                  <li class="amenity-option-sm d-flex justify-content-between dropdown-item">
                                                       <span class="amenity-text-option-sm">Video doorbell</span>
                                                       <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                                  </li>
                                                  <li class="amenity-option-sm d-flex justify-content-between dropdown-item">
                                                       <span class="amenity-text-option-sm" >Pet policy</span>
                                                       <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                                  </li>
                                                  <li class="amenity-option-sm d-flex justify-content-between dropdown-item">
                                                       <span class="amenity-text-option-sm">Court</span>
                                                       <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                                  </li>
                                                  <li class="amenity-option-sm d-flex justify-content-between dropdown-item">
                                                       <span class="amenity-text-option-sm">Garage</span>
                                                       <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                                  </li>
                                                  <li class="amenity-option-sm d-flex justify-content-between dropdown-item">
                                                       <span class="amenity-text-option-sm">Fitness Center</span>
                                                       <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                                  </li>
                                             </ul>
                                        </div>
                                   </div>
                              </div>
                         </section>
                    </div>
                    <div class="modal-footer d-flex justify-content-center wrapper-sm-filters">
                    <!-- FILTER SEARCH -->
                         <button class="btn btn-sm-filter text-light" onclick="filterButton()">
                              <img src="imgs/search.png" alt="" class="img-search">
                              Search
                         </button>
                    </div>
               </div>
          </div>
     </div>
<!-- modal end - FILTERS -->


<!-- MAIN -->
     <div class="container-fluid container-contents">
          
     <!-- FILTERS SECTION-->
          <section class="section-filters">
               <div class="nav-container nav-filter" id="filterNavbar">
                    <nav class="navbar navbar-expand-md px-3 px-md-5 navbar-filter py-3">
                         <div class="container-fluid d-grid wrapper-filter">

                         <!-- PROPERTY TYPE -->
                              <div>
                                   <label for="propertyType" class="labels-filter ms-2 mb-2">PROPERTY TYPE</label>
                                   <div class="dropdown typeMenu">
                                        <button onclick="ddTypeFunction()" onblur="blurFunction()" id="propertyTypeValue" value="Any" class="btn dropdown-toggle btn-type propertyType d-flex justify-content-between rental-inputs" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                             <span class="btn-txt-type">Any</span>
                                             <i class="bi bi-chevron-down icons" id="downType"></i>
                                             <i class="bi bi-chevron-up icons" id="upType"></i>
                                        </button>
                                        <ul class="dropdown-menu dmenu dropdown-menu-ptype">
                                             <li class="type-option"><a class="dropdown-item dropdown-item-first opt-type-text" href="#">Any</a></li>
                                             <li class="type-option"><a class="dropdown-item opt-type-text" href="#">Apartment</a></li>
                                             <li class="type-option"><a class="dropdown-item opt-type-text" href="#">Commercial</a></li>
                                             <li class="type-option"><a class="dropdown-item opt-type-text" href="#">Condominium</a></li>
                                             <li class="type-option"><a class="dropdown-item opt-type-text" href="#">Bed Space</a></li>
                                             <li class="type-option"><a class="dropdown-item dropdown-item-last opt-type-text" href="#">Dormitory</a></li>
                                        </ul>
                                   </div>
                              </div>

                         <!-- PROPERTY LOCATION -->
                              <div class="d-flex flex-column">
                                   <label for="propertyLoc" class="labels-filter ms-2 mb-2">LOCATION</label>
                                   <div class="d-flex flex-column">
                                        <input type="text" oninput="NavlocationTextboxFunction(this.value)" id="navfilterLocation" class="rental-inputs txt-location"  autocomplete="off">
                                        <div id="suggestionList" class="suggestion-list-rentals"></div>
                                   </div>
                              </div>

                         <!-- PRICE RANGE -->
                              <div>
                                   <label for="propertyLoc" class="labels-filter ms-2 mt-2">PRICE</label>
                                   <div class="wrapper wrapper-range ms-2">
                              
                                        <div class="slider">
                                             <div class="progress"></div>
                                        </div>
                                        <!-- SLIDER INPUT -->
                                        <div class="range-input">
                                             <input type="range" class="range-min" min="0" max="100000" value="0" step="100">
                                             <input type="range" class="range-max" min="0" max="100000" value="100000" step="100">
                                        </div>

                                        <div class="price-input d-flex mt-1">
                                        <!-- MINIMUM VALUE -->
                                             <div class="field d-flex align-items-center"> 
                                                  <input type="number" id="minimumValue" class="input-min text-center" value="0">
                                             </div>
                              
                                             <div class="separator d-flex align-items-center justify-content-center">-</div>
                                        <!-- MAXIMUM VALUE -->
                                             <div class="field d-flex align-items-center">
                                                  <input type="number" id="maximumValue" class="input-max text-center" value="100000">
                                             </div>
                                        </div>
                                   </div>
                              </div>

                         <!-- BED COUNT -->
                              <div>
                                   <label for="bedMenu" class="labels-filter ms-2 mb-2">BEDROOM</label>
                                   <div class="dropdown bedMenu">
                                             <button onclick="ddBedFunction()" onblur="blurFunction()" id="bedCount" value="Any" class="btn dropdown-toggle btn-bed bedCount mt-1 d-flex justify-content-between rental-inputs" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                  <span class="btn-txt-bed">Any</span> 
                                                  <i class="bi bi-chevron-down icons" id="downBed"></i>
                                                  <i class="bi bi-chevron-up icons" id="upBed"></i>
                                             </button>
                                        <ul class="dropdown-menu dmenu dropdown-menu-ptype">
                                             <li class="bed-option"><a class="dropdown-item d-item dropdown-item-first opt-bed-text" href="#">Any</a></li>
                                             <li class="bed-option"><a class="dropdown-item d-item opt-bed-text" href="#">1</a></li>
                                             <li class="bed-option"><a class="dropdown-item d-item opt-bed-text" href="#">2</a></li>
                                             <li class="bed-option"><a class="dropdown-item d-item opt-bed-text" href="#">3</a></li>
                                             <li class="bed-option"><a class="dropdown-item d-item opt-bed-text" href="#">4</a></li>
                                             <li class="bed-option"><a class="dropdown-item d-item dropdown-item-last opt-bed-text" href="#">5+</a></li>
                                        </ul>
                                   </div>
                              </div>

                         <!-- BATHROOM COUNT -->
                              <div>
                                   <label for="bathMenu" class="labels-filter ms-2 mb-2">BATHROOM</label>
                                   <div class="dropdown bathMenu">
                                        <button onclick="ddBathFunction()" onblur="blurFunction()" id="bathCount" value="Any"  class="btn dropdown-toggle btn-bath bathCount mt-1 d-flex justify-content-between rental-inputs" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                             <span class="btn-txt-bath">Any</span> 
                                             <i class="bi bi-chevron-down icons" id="downBath"></i>
                                             <i class="bi bi-chevron-up icons" id="upBath"></i>
                                        </button>
                                        <ul class="dropdown-menu dmenu dropdown-menu-ptype">
                                             <li class="bath-option"><a class="dropdown-item d-item dropdown-item-first opt-bath-text" href="#">Any</a></li>
                                             <li class="bath-option"><a class="dropdown-item d-item opt-bath-text" href="#">1</a></li>
                                             <li class="bath-option"><a class="dropdown-item d-item opt-bath-text" href="#">2</a></li>
                                             <li class="bath-option"><a class="dropdown-item d-item opt-bath-text" href="#">3</a></li>
                                             <li class="bath-option"><a class="dropdown-item d-item opt-bath-text" href="#">4</a></li>
                                             <li class="bath-option"><a class="dropdown-item d-item dropdown-item-last opt-bath-text" href="#">5+</a></li>
                                        </ul>
                                   </div>
                              </div>
              
                         <!-- FLOOR AREA -->
                              <div>
                                   <label for="floorAreaMenu" class="labels-filter ms-2 mb-2">FLOOR AREA</label>
                                   <div class="dropdown floorAreaMenu">
                                        <button onclick="ddFloorFunction()" onblur="blurFunction()" id="floorAreaValue" value="Any Size" class="btn dropdown-toggle btn-floor-area mt-1 d-flex justify-content-between rental-inputs" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                             <span class="btn-txt-floor">Any Size</span>
                                             <i class="bi bi-chevron-down icons" id="downFloor"></i>
                                             <i class="bi bi-chevron-up icons" id="upFloor"></i>
                                        </button>
                                        <ul class="dropdown-menu dmenu dropdown-menu-ptype">
                                             <li class="floor-option"><a class="dropdown-item dropdown-item-first opt-floor-text" href="#">Below 20m<sup>2</sup></a></li>
                                             <li class="floor-option"><a class="dropdown-item opt-floor-text" href="#">21m<sup>2</sup> - 50m<sup>2</sup></a></li>
                                             <li class="floor-option"><a class="dropdown-item opt-floor-text" href="#">51m<sup>2</sup> - 100m<sup>2</sup></a></li>
                                             <li class="floor-option"><a class="dropdown-item dropdown-item-last opt-floor-text" href="#">101m<sup>2</sup> & above</a></li>
                                        </ul>
                                   </div>
                              </div>
                              <div class="d-none">
                                   <input type="text" id="dropdownValues" value="">
                              </div>
                              <!-- DROPDOWN AMENITIES -->
                              <div class="container dd-container">
                                   <label for="amenitiesMenu" class="labels-filter ms-2 mb-2">AMENITIES</label>
                                   <div class="dropdown amenitiesMenu">
                                        <button onclick="ddAmenityFunction()" class="select-btn d-flex justify-content-between rental-inputs bg-light dropdown-toggle mt-1">
                                             <span class="select-btn-txt">Select Amenity</span>
                                             <i class="bi bi-chevron-down icons" id="downAmenity"></i>
                                             <i class="bi bi-chevron-up icons" id="upAmenity"></i>
                                        </button>
                                        
                                        <ul class="amenity-options dmenu dropdown-menu-ptype w-100" id="ddAmenityMenu" onmouseleave="blurFunction()">
                                             <li class="amenity-option d-flex justify-content-between dropdown-item dropdown-item1">
                                                  <span class="amenity-text-option">Wi-Fi</span>
                                                  <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                             </li>
                                             <li class="amenity-option d-flex justify-content-between dropdown-item">
                                                  <span class="amenity-text-option">Air conditioner</span>
                                                  <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                             </li>
                                             <li class="amenity-option d-flex justify-content-between dropdown-item">
                                                  <span class="amenity-text-option" >Soundproof walls</span>
                                                  <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                             </li>
                                             <li class="amenity-option d-flex justify-content-between dropdown-item">
                                                  <span class="amenity-text-option">Bath tub</span>
                                                  <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                             </li>
                                             <li class="amenity-option d-flex justify-content-between dropdown-item">
                                                  <span class="amenity-text-option">Sofa</span>
                                                  <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                             </li>
                                             <li class="amenity-option d-flex justify-content-between dropdown-item">
                                                  <span class="amenity-text-option">Bed</span>
                                                  <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                             </li>
                                             <li class="amenity-option d-flex justify-content-between dropdown-item">
                                                  <span class="amenity-text-option" >Work Table</span>
                                                  <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                             </li>
                                             <li class="amenity-option d-flex justify-content-between dropdown-item">
                                                  <span class="amenity-text-option">Bar Stool</span>
                                                  <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                             </li>
                                             <li class="amenity-option d-flex justify-content-between dropdown-item">
                                                  <span class="amenity-text-option" >Dining Set</span>
                                                  <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                             </li>
                                             <li class="amenity-option d-flex justify-content-between dropdown-item">
                                                  <span class="amenity-text-option">Fireplace</span>
                                                  <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                             </li>
                                             <li class="amenity-option d-flex justify-content-between dropdown-item">
                                                  <span class="amenity-text-option" >Hardwood floor</span>
                                                  <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                             </li>
                                             <li class="amenity-option d-flex justify-content-between dropdown-item">
                                                  <span class="amenity-text-option">Wardrobe</span>
                                                  <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                             </li>
                                             <li class="amenity-option d-flex justify-content-between dropdown-item">
                                                  <span class="amenity-text-option" >Washer-Dryer</span>
                                                  <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                             </li>
                                             <li class="amenity-option d-flex justify-content-between dropdown-item">
                                                  <span class="amenity-text-option">Washer-Dryer Hookup</span>
                                                  <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                             </li>
                                             <li class="amenity-option d-flex justify-content-between dropdown-item">
                                                  <span class="amenity-text-option" >Dishwasher</span>
                                                  <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                             </li>
                                             <li class="amenity-option d-flex justify-content-between dropdown-item">
                                                  <span class="amenity-text-option">Range oven</span>
                                                  <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                             </li>
                                             <li class="amenity-option d-flex justify-content-between dropdown-item">
                                                  <span class="amenity-text-option" >CCTV</span>
                                                  <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                             </li>
                                             <li class="amenity-option d-flex justify-content-between dropdown-item">
                                                  <span class="amenity-text-option">24-hr security</span>
                                                  <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                             </li>
                                             <li class="amenity-option d-flex justify-content-between dropdown-item">
                                                  <span class="amenity-text-option" >Smart lock</span>
                                                  <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                             </li>
                                             <li class="amenity-option d-flex justify-content-between dropdown-item">
                                                  <span class="amenity-text-option">Video doorbell</span>
                                                  <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                             </li>
                                             <li class="amenity-option d-flex justify-content-between dropdown-item">
                                                  <span class="amenity-text-option" >Pet policy</span>
                                                  <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                             </li>
                                             <li class="amenity-option d-flex justify-content-between dropdown-item">
                                                  <span class="amenity-text-option">Court</span>
                                                  <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                             </li>
                                             <li class="amenity-option d-flex justify-content-between dropdown-item">
                                                  <span class="amenity-text-option">Garage</span>
                                                  <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                             </li>
                                             <li class="amenity-option d-flex justify-content-between dropdown-item">
                                                  <span class="amenity-text-option">Fitness Center</span>
                                                  <span><i class="bi bi-check-lg icons icon-check"></i></span>
                                             </li>
                                        </ul>
                              </div>
                              </div>

                         <!-- FILTER SEARCH -->
                              <div>
                                   <button class="btn btns-filter btn-filter-search text-light d-flex align-items-center justify-content-center pe-2 px-2" onclick="filterButton()">
                                        <img src="imgs/search.png" alt="" class="img-search">
                                        Search
                                   </button>
                              </div>
                  
                         </div>
                    </nav>
               </div>
          </section>

          <?php
          if(isset($_SESSION['filterPropertytype']) || isset($_SESSION['txtLocation1']) || isset($_SESSION['filterbedcount']) || 
          isset($_SESSION['filterbathcount']) || isset($_SESSION['choiceNumber']) || isset($_SESSION['filterAmenities']) || isset($_SESSION['priceRange'])){
               //Propeerty Type Value
               if(isset($_SESSION['filterPropertytype'])){
                    $propertyType = $_SESSION['filterPropertytype'];
                    $propertyTypeValue = "AND propertyType = '$propertyType'";
               }
               else{
                    $propertyTypeValue = " ";
               }
               //Location Value
               if(isset($_SESSION['txtLocation1'])){
                    $location1 = $_SESSION['txtLocation1'];
                    if(isset($_SESSION['txtLocation2']) && !isset($_SESSION['txtLocation3'])){
                         $location2 = $_SESSION['txtLocation2'];
                         $locationValue = "AND
                         (propertyProvince LIKE '%$location1%' OR propertyCity LIKE '%$location1%' OR propertyBarangay LIKE '%$location1%')
                         AND
                         (propertyProvince LIKE '%$location2%' OR propertyCity LIKE '%$location2%' OR propertyBarangay LIKE '%$location2%')";
                    }
                    else if(isset($_SESSION['txtLocation3']) && !isset($_SESSION['txtLocation4'])){
                         $location2 = $_SESSION['txtLocation2'];
                         $location3 = $_SESSION['txtLocation3'];
                         $locationValue = "AND
                         (propertyProvince LIKE '%$location1%' OR propertyCity LIKE '%$location1%' OR propertyBarangay LIKE '%$location1%')
                         AND
                         (propertyProvince LIKE '%$location2%' OR propertyCity LIKE '%$location2%' OR propertyBarangay LIKE '%$location2%')
                         AND
                         (propertyProvince LIKE '%$location3%' OR propertyCity LIKE '%$location3%' OR propertyBarangay LIKE '%$location3%')";
                    }
                    else if(isset($_SESSION['txtLocation4'])){
                         $location2 = $_SESSION['txtLocation2'];
                         $location3 = $_SESSION['txtLocation3'];
                         $location4 = $_SESSION['txtLocation4'];
                         $locationValue = "AND
                         (propertyProvince LIKE '%$location1%' OR propertyCity LIKE '%$location1%' OR propertyBarangay LIKE '%$location1%')
                         AND
                         (propertyProvince LIKE '%$location2%' OR propertyCity LIKE '%$location2%' OR propertyBarangay LIKE '%$location2%')
                         AND
                         (propertyProvince LIKE '%$location3%' OR propertyCity LIKE '%$location3%' OR propertyBarangay LIKE '%$location3%')
                         AND
                         (propertyProvince LIKE '%$location4%' OR propertyCity LIKE '%$location4%' OR propertyBarangay LIKE '%$location4%')";
                    }
                    else{
                         $locationValue = "AND (propertyProvince LIKE '%$location1%' OR propertyCity LIKE '%$location1%' OR propertyBarangay LIKE '%$location1%')";
                    }
               }
               else{
                    $locationValue = " ";
               }
               if(isset($_SESSION['min'])){
                    //Slider Value
                    $minValue = $_SESSION['min'];
                    $maxValue = $_SESSION['max'];
               }
               else{
                    $minValue = 0;
                    $maxValue = 100000;
               }
               //count of bed
               if(isset($_SESSION['filterbedcount'])){
                    $bed = $_SESSION['filterbedcount'];
     
                    if($bed >= 5){
                         $bedValue = "AND propertyBedrooms >=" . $bed;
                    }
                    else{
                         $bedValue = "AND propertyBedrooms =" . $bed;
                    }
               }
               else{
                    $bedValue = " ";
               }
               
               //count of bath
               if(isset($_SESSION['filterbathcount'])){
                    $bath = $_SESSION['filterbathcount'];
     
                    if($bath >= 5){
                         $bathValue = "AND propertyBathroom >=" . $bath;
                    }
                    else{
                         $bathValue = "AND propertyBathroom =" . $bath;
                    }
               }
               else{
                    $bathValue = " ";
               }
               //floorArea size
               if(isset($_SESSION['choiceNumber'])){
                    $choiceFloorArea = $_SESSION['choiceNumber'];
                    if($choiceFloorArea == 1){
                         $floorAreaValues = "AND propertyFloorArea <=" . 20;
                    }
                    else if($choiceFloorArea == 2){
                         $floorAreaValues = "AND propertyFloorArea BETWEEN 21 AND 50";
                    }
                    else if($choiceFloorArea == 3){
                         $floorAreaValues = "AND propertyFloorArea BETWEEN 51 AND 100";
                    }
                    else if($choiceFloorArea == 4){
                         $floorAreaValues = "AND propertyFloorArea >=" . 101;
                    }
               }
               else{
                    $floorAreaValues = " ";
               }
               //amenities filter
               if(isset($_SESSION['filterAmenities'])){
                    $useramenitiesValues = $_SESSION['filterAmenities'];
                    $userlikeAmenities = explode(",", $useramenitiesValues);
                    $amenitiesValue = "";
                    foreach ($userlikeAmenities as $amenities) {
                         if (!empty($amenities)) {
                              if (!empty($amenitiesValue)) {
                                   $amenitiesValue .= " AND ";
                              }
                              $amenitiesValue .= "propertyAmenities LIKE '%" . $con->real_escape_string($amenities) . "%'";
                         }
                         }
                    
                         if (!empty($amenitiesValue)) {
                         $amenitiesValue = "AND ($amenitiesValue)";
                         }
               }
               else{
                    $amenitiesValue = " ";
               }
               $selectArrayValue = "SELECT * FROM landing_properties WHERE publishing_status = 'Published' AND occular_visit_status='visited' $propertyTypeValue $locationValue $bedValue $bathValue $floorAreaValues $amenitiesValue
               AND propertyPrice BETWEEN $minValue AND $maxValue";
               $execute_array = mysqli_query($con, $selectArrayValue);
               $row_count = mysqli_num_rows($execute_array);
          ?>
          <div class="container-result">
                         <!-- RESULTS FOUND SECTION -->
                              <section class="section-found-txt mt-5 d-block">
                                   <div class="">
                                        <h5><?php echo $row_count ?> listing/s found</h5>
                                        <?php
                                             if(isset($_SESSION['filterPropertytype'])){
                                        ?>
                                        <p class="searched-usual">
                                             <span class="searched-type"><?php echo $_SESSION['filterPropertytype'] ?></span> for Rent
                                        </p>
                                        <?php
                                             }
                                             if(isset($_SESSION['txtLocation1'])){
                                             ?>
                                             <p class="searched-location">
                                                  Location: 
                                                  <?php
                                                  if(isset($_SESSION['txtLocation2']) && !isset($_SESSION['txtLocation3'])){
                                                       ?>
                                                  <span class="searched-type"><?php echo ucwords($_SESSION['txtLocation1']) . " " . ucwords($_SESSION['txtLocation2']) ?></span>
                                                  <?php
                                                  }
                                                  else if(isset($_SESSION['txtLocation3']) && !isset($_SESSION['txtLocation4'])){
                                                       ?>
                                                  <span class="searched-type"><?php echo ucwords($_SESSION['txtLocation1']) . " " . ucwords($_SESSION['txtLocation2']) . " " . ucwords($_SESSION['txtLocation3']) ?></span>
                                                       <?php
                                                  }
                                                  else if(isset($_SESSION['txtLocation4'])){
                                                       ?>
                                                  <span class="searched-type"><?php echo ucwords($_SESSION['txtLocation1']) . " " . ucwords($_SESSION['txtLocation2']) . " " . ucwords($_SESSION['txtLocation3']) . " " . ucwords($_SESSION['txtLocation4']) ?></span>
                                                       <?php
                                                  }
                                                  else{
                                                       ?>
                                                       <span class="searched-type"><?php echo ucwords($_SESSION['txtLocation1'])?></span>
                                                  <?php
                                                  }
                                                  ?>
                                             </p>
                                             <?php
                                             }
                                             if(isset($_SESSION['min'])){
                                             ?> 
                                        <p class="searched-price">Ranging from
                                             <span class="searched-min-price"><?php echo  number_format($_SESSION['min']) ?></span> to 
                                             <span class="searched-max-price"><?php echo  number_format($_SESSION['max']) ?></span>
                                        </p>
                                        <?php
                                        }
                                        ?>
                                        <p class="searched-spaces">
                                             <?php
                                             if(isset($_SESSION['filterbedcount'])){
                                                  if($_SESSION['filterbedcount'] >= 5){
                                                  ?>
                                             <span><?php echo "5+" ?></span> bedroom/s ; 
                                             <?php
                                                  }
                                                  else{
                                                  ?>
                                             <span><?php echo $_SESSION['filterbedcount'] ?></span> bedroom/s ; 
                                                  <?php
                                             }
                                        }
                                             ?>
                                             <?php
                                             if(isset($_SESSION['filterbathcount'])){
                                                  if($_SESSION['filterbathcount'] >= 5){
                                                  ?>
                                             <span><?php echo "5+" ?></span> bathroom/s ;
                                             <?php
                                                  }
                                                  else{
                                                  ?>
                                             <span><?php echo $_SESSION['filterbathcount'] ?></span> bathroom/s ;
                                                  <?php
                                             }
                                        }
                                        if(isset($_SESSION['choiceNumber'])){
                                             if($choiceFloorArea == 1){
                                             ?>
                                                  Below<span> 20</span>m<sup>2</sup>
                                             <?php
                                             }
                                             else if($choiceFloorArea == 2){
                                             ?>
                                                  <span>21</span>m<sup>2</sup> - <span>50</span>m<sup>2</sup>
                                             <?php     
                                             }
                                             else if($choiceFloorArea == 3){
                                             ?>
                                                  <span>51</span>m<sup>2</sup> - <span>100</span>m<sup>2</sup>
                                             <?php
                                             }
                                             else if($choiceFloorArea == 4){
                                             ?>
                                                  <span>101</span>m<sup>2 </sup> &amp; above 
                                             <?php
                                             }
                                        }
                                             ?>
                                        </p>
                                        <?php
                                        if(isset($_SESSION['filterAmenities'])){
                                             ?>
                                        <p class="searched-amenities"> Amenities:
                                             <span><?php echo $_SESSION['filterAmenities']; ?></span>
                                        </p>
                                        <?php
                                        }
                                        ?>
                                   </div>

                              </section>
                         <?php          
                         }
                         else{
                              ?>
                              <div class="container-result">
                                   <?php
                         }
                              ?>
          <!-- CARDS SECTION -->
               <section class="mt-3 section-cards ">
                    <div class="wrapper-cards-rentals d-grid">
                    <?php 
                    if(isset($_SESSION['filterPropertytype']) || isset($_SESSION['txtLocation1']) || isset($_SESSION['filterbedcount']) || 
                    isset($_SESSION['filterbathcount']) || isset($_SESSION['choiceNumber']) || isset($_SESSION['filterAmenities']) || isset($_SESSION['priceRange'])){
                         $_SESSION['existingIds'] = array();
                         for($i = 0; $i < $row_count; $i++){
                              $selectId = "SELECT * FROM landing_properties WHERE AND publishing_status='Published' AND occular_visit_status='visited' AND propertyID NOT IN ('" . implode("','", $_SESSION['existingIds']) . "') $propertyTypeValue $locationValue $bedValue $bathValue $floorAreaValues $amenitiesValue
                                        AND propertyPrice BETWEEN $minValue AND $maxValue ORDER BY RAND() LIMIT 1";
                              
                              $executeSelectId = $con->query($selectId);

                              if ($executeSelectId->num_rows > 0) {

                              // Fetch the random row as an associative array
                              $random_row = mysqli_fetch_assoc($executeSelectId);

                              // Add the new random ID to the used IDs array in the session
                              $_SESSION['existingIds'][] = $random_row['propertyID'];

                              //set variable randomID as random id in db
                              $randomID = $random_row['propertyID'];
                              // Close the result set
                              mysqli_free_result($executeSelectId);

                              } else {
                              // Handle if no rows are found
                              $randomID = null;
                              }
                              
                              $select_properties = "SELECT * FROM landing_properties WHERE propertyID='$randomID' AND publishing_status='Published' AND occular_visit_status='visited'";
                              $property_result=mysqli_query($con, $select_properties);
                              $property_data = mysqli_fetch_assoc($property_result);
                              $imgfeatured1 = str_replace("../../", "", $property_data['imgFeatured1']);
                              $imgfeatured2 = str_replace("../../", "", $property_data['imgFeatured2']);
                              $imgfeatured3 = str_replace("../../", "", $property_data['imgFeatured3']);
                         ?>
                              <!-- CARD 1 -->
                         <div class="card card-result">
                              <!-- carousel -->
                              <div id="carousel<?php echo $i ?>" class="carousel" data-bs-interval="false">
                                   <div class="carousel-indicators">
                                   <button type="button" data-bs-target="#carousel<?php echo $i ?>" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                   <button type="button"  data-bs-target="#carousel<?php echo $i ?>" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                   <button type="button"  data-bs-target="#carousel<?php echo $i ?>" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                   </div>
                                   <div class="carousel-inner">
                                   <?php 
                                   if(!isset($_SESSION['rEmail']) && !isset($_SESSION['lEmail'])){
                                        ?>
                                        <button onclick="favoriteData('save<?php echo $i ?>','saved<?php echo $i ?>')" class=" heart-btns saveButton d-block" id="save<?php echo $i ?>" value="<?php echo $property_data['propertyID']; ?>"><i class="bi bi-heart heart-icons" ></i></button>
                                        <button onclick="favoriteData('save<?php echo $i ?>','saved<?php echo $i ?>')" class="heart-btns unsaveButton d-none" id="saved<?php echo $i ?>" value="unsave"> <i class="bi bi-heart-fill heart-icons"></i></button>
                                   <?php
                                   }
                                   else{
                                        //check if the user is landlord
                                        if(isset($_SESSION['lEmail'])){
                                             //check if the user has favorite data
                                             $select_favorite = "SELECT * FROM user_favorites WHERE favorite_id='$randomID' AND user_id='l" . $getUser['lID'] . "'";
                                             $favorite_result=mysqli_query($con, $select_favorite);
                                             $favorite_count = mysqli_num_rows($favorite_result);
                                             if($favorite_count > 0){?>
                                                  <button onclick="favoriteData('save<?php echo $i ?>','saved<?php echo $i ?>')" class=" heart-btns saveButton d-none" id="save<?php echo $i ?>" value="<?php echo $property_data['propertyID']; ?>"><i class="bi bi-heart heart-icons" ></i></button>
                                                  <button onclick="favoriteData('save<?php echo $i ?>','saved<?php echo $i ?>')" class="heart-btns unsaveButton d-block" id="saved<?php echo $i ?>" value="unsave"> <i class="bi bi-heart-fill heart-icons"></i></button>
                                             <?php
                                             }
                                             else{
                                                  ?>
                                                  <button onclick="favoriteData('save<?php echo $i ?>','saved<?php echo $i ?>')" class=" heart-btns saveButton d-block" id="save<?php echo $i ?>" value="<?php echo $property_data['propertyID']; ?>"><i class="bi bi-heart heart-icons" ></i></button>
                                                  <button onclick="favoriteData('save<?php echo $i ?>','saved<?php echo $i ?>')" class="heart-btns unsaveButton d-none" id="saved<?php echo $i ?>" value="unsave"> <i class="bi bi-heart-fill heart-icons"></i></button>
                                             <?php
                                             }
                                        }
                                        //check if the user is renter
                                        else if(isset($_SESSION['rEmail'])){
                                             $select_favorite = "SELECT * FROM user_favorites WHERE favorite_id='$randomID' AND user_id='r" . $getUser['rId'] . "'";
                                             $favorite_result=mysqli_query($con, $select_favorite);
                                             $favorite_count = mysqli_num_rows($favorite_result);
                                             if($favorite_count > 0){?>
                                                  <button onclick="favoriteData('save<?php echo $i ?>','saved<?php echo $i ?>')" class=" heart-btns saveButton d-none" id="save<?php echo $i ?>" value="<?php echo $property_data['propertyID']; ?>"><i class="bi bi-heart heart-icons" ></i></button>
                                                  <button onclick="favoriteData('save<?php echo $i ?>','saved<?php echo $i ?>')" class="heart-btns unsaveButton d-block" id="saved<?php echo $i ?>" value="unsave"> <i class="bi bi-heart-fill heart-icons"></i></button>
                                             <?php
                                             }
                                             else{
                                                  ?>
                                                  <button onclick="favoriteData('save<?php echo $i ?>','saved<?php echo $i ?>')" class=" heart-btns saveButton d-block" id="save<?php echo $i ?>" value="<?php echo $property_data['propertyID']; ?>"><i class="bi bi-heart heart-icons" ></i></button>
                                                  <button onclick="favoriteData('save<?php echo $i ?>','saved<?php echo $i ?>')" class="heart-btns unsaveButton d-none" id="saved<?php echo $i ?>" value="unsave"> <i class="bi bi-heart-fill heart-icons"></i></button>
                                             <?php
                                             }
                                        }
                                   }
                                   ?>

                                   <div class="carousel-item active">
                                        <img src="<?php echo $imgfeatured1; ?>" class="d-block card-img" alt="...">
                                   </div>
                                   <div class="carousel-item">
                                        <img src="<?php echo $imgfeatured2; ?>" class="d-block card-img" alt="...">
                                   </div>
                                   <div class="carousel-item">
                                        <img src="<?php echo $imgfeatured3; ?>" class="d-block card-img" alt="...">
                                   </div>
                                   </div>
                                   <button class="carousel-control-prev" type="button" data-bs-target="#carousel<?php echo $i ?>" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                   </button>
                                   <button class="carousel-control-next" type="button" data-bs-target="#carousel<?php echo $i ?>" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                   </button>
                                   </div>
                                   <!-- card body -->
                                   <div class="card-body px-3 mt-3">
                                   <h5 class="card-title txts-bld ms-1"><?php echo $property_data['propertyTitle']; ?></h5>
                                   <div class="div-location d-flex mt-3">
                                        <i class="bi bi-geo-alt-fill ms-1 "></i> 
                                        <p class="card-text mt-1">&nbsp;<?php echo $property_data['propertyBarangay'] . ', ' .  $property_data['propertyCity']; ?></p>
                                   </div>
                                   
                                   <div class="div-price d-flex align-items-center gap-2 mt-2">
                                        <p class="card-price ms-1">₱ <?php echo number_format($property_data['propertyPrice']); ?></p>
                                        <p class="card-per txts-bld"> per month</p>
                                   </div>
                                   <!-- DETAILS -->
                                   <div class="div-details d-flex mt-3 align-items-center gap-4 ps-1">
                                        <div class="d-flex gap-2 align-items-center justify-content-center">
                                             <img src="imgs/bedroomIcon.png" alt="Bedroom" class="card-icons bed-icon">
                                             <span class="quantity"><?php echo $property_data['propertyBedrooms']; ?></span>
                                        </div>

                                        <div class="d-flex gap-2 align-items-center justify-content-center">
                                             <img src="imgs/bathroomIcon.png" alt="Bathroom" class="card-icons">
                                             <span class="quantity"><?php echo $property_data['propertyBathroom']; ?></span>
                                        </div>

                                        <div class="d-flex gap-2 align-items-center justify-content-center">
                                             <img src="imgs/sqmIcon.png" alt="Floor Area" class="card-icons">
                                             <span class="quantity"><?php echo $property_data['propertyFloorArea']; ?> <span> m<sup>2</sup></span> </span>
                                        </div>
                                   </div>

                                   <div class="d-flex justify-content-center mt-3">
                                        <a href="<?php echo 'viewProperty.php?id=' . $property_data['propertyID']; ?>"  target="_blank" class="btn btn-view-property px-5 py-2">View Property</a>
                                   </div>
                              </div>
                         </div>
                              <?php
                         }
                    }
                    else{
                         $select_query = "SELECT * FROM landing_properties WHERE publishing_status='Published' AND occular_visit_status='visited'";
                         $result=mysqli_query($con, $select_query);
                         $row_count = mysqli_num_rows($result);
                         $_SESSION['existingIds'] = array();
                         for($i = 0; $i < $row_count; $i++){
                              //select the id that not exist in the session array
                              $selectId = "SELECT * FROM landing_properties WHERE publishing_status='Published' AND occular_visit_status='visited' AND propertyID NOT IN ('" . implode("','", $_SESSION['existingIds']) . "') ORDER BY RAND() LIMIT 1";
                              $executeSelectId = $con->query($selectId);

                              if ($executeSelectId->num_rows > 0) {

                              // Fetch the random row as an associative array
                              $random_row = mysqli_fetch_assoc($executeSelectId);

                              // Add the new random ID to the used IDs array in the session
                              $_SESSION['existingIds'][] = $random_row['propertyID'];

                              //set variable randomID as random id in db
                              $randomID = $random_row['propertyID'];
                              // Close the result set
                              mysqli_free_result($executeSelectId);

                              } else {
                              // Handle if no rows are found
                              $randomID = null;
                              }
                              
                              $select_properties = "SELECT * FROM landing_properties WHERE propertyID='$randomID' AND publishing_status='Published' AND occular_visit_status='visited'";
                              $property_result=mysqli_query($con, $select_properties);
                              $property_data = mysqli_fetch_assoc($property_result);
                              $imgfeatured1 = str_replace("../../", "", $property_data['imgFeatured1']);
                              $imgfeatured2 = str_replace("../../", "", $property_data['imgFeatured2']);
                              $imgfeatured3 = str_replace("../../", "", $property_data['imgFeatured3']);
                         ?>
                         <!-- CARD 1 -->
                         <div class="card card-result">
                              <!-- carousel -->
                              <div id="carousel<?php echo $i ?>" class="carousel" data-bs-interval="false">
                                   <div class="carousel-indicators">
                                   <button type="button" data-bs-target="#carousel<?php echo $i ?>" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                   <button type="button"  data-bs-target="#carousel<?php echo $i ?>" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                   <button type="button"  data-bs-target="#carousel<?php echo $i ?>" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                   </div>
                                   <div class="carousel-inner">
                                   <?php 
                                   if(!isset($_SESSION['rEmail']) && !isset($_SESSION['lEmail'])){
                                        ?>
                                        <button onclick="favoriteData('save<?php echo $i ?>','saved<?php echo $i ?>')" class=" heart-btns saveButton d-block" id="save<?php echo $i ?>" value="<?php echo $property_data['propertyID']; ?>"><i class="bi bi-heart heart-icons" ></i></button>
                                        <button onclick="favoriteData('save<?php echo $i ?>','saved<?php echo $i ?>')" class="heart-btns unsaveButton d-none" id="saved<?php echo $i ?>" value="unsave"> <i class="bi bi-heart-fill heart-icons"></i></button>
                                   <?php
                                   }
                                   else{
                                        //check if the user is landlord
                                        if(isset($_SESSION['lEmail'])){
                                             //check if the user has favorite data
                                             $select_favorite = "SELECT * FROM user_favorites WHERE favorite_id='$randomID' AND user_id='l" . $getUser['lID'] . "'";
                                             $favorite_result=mysqli_query($con, $select_favorite);
                                             $favorite_count = mysqli_num_rows($favorite_result);
                                             if($favorite_count > 0){?>
                                                  <button onclick="favoriteData('save<?php echo $i ?>','saved<?php echo $i ?>')" class=" heart-btns saveButton d-none" id="save<?php echo $i ?>" value="<?php echo $property_data['propertyID']; ?>"><i class="bi bi-heart heart-icons" ></i></button>
                                                  <button onclick="favoriteData('save<?php echo $i ?>','saved<?php echo $i ?>')" class="heart-btns unsaveButton d-block" id="saved<?php echo $i ?>" value="unsave"> <i class="bi bi-heart-fill heart-icons"></i></button>
                                             <?php
                                             }
                                             else{
                                                  ?>
                                                  <button onclick="favoriteData('save<?php echo $i ?>','saved<?php echo $i ?>')" class=" heart-btns saveButton d-block" id="save<?php echo $i ?>" value="<?php echo $property_data['propertyID']; ?>"><i class="bi bi-heart heart-icons" ></i></button>
                                                  <button onclick="favoriteData('save<?php echo $i ?>','saved<?php echo $i ?>')" class="heart-btns unsaveButton d-none" id="saved<?php echo $i ?>" value="unsave"> <i class="bi bi-heart-fill heart-icons"></i></button>
                                             <?php
                                             }
                                        }
                                        //check if the user is renter
                                        else if(isset($_SESSION['rEmail'])){
                                             $select_favorite = "SELECT * FROM user_favorites WHERE favorite_id='$randomID' AND user_id='r" . $getUser['rId'] . "'";
                                             $favorite_result=mysqli_query($con, $select_favorite);
                                             $favorite_count = mysqli_num_rows($favorite_result);
                                             if($favorite_count > 0){?>
                                                  <button onclick="favoriteData('save<?php echo $i ?>','saved<?php echo $i ?>')" class=" heart-btns saveButton d-none" id="save<?php echo $i ?>" value="<?php echo $property_data['propertyID']; ?>"><i class="bi bi-heart heart-icons" ></i></button>
                                                  <button onclick="favoriteData('save<?php echo $i ?>','saved<?php echo $i ?>')" class="heart-btns unsaveButton d-block" id="saved<?php echo $i ?>" value="unsave"> <i class="bi bi-heart-fill heart-icons"></i></button>
                                             <?php
                                             }
                                             else{
                                                  ?>
                                                  <button onclick="favoriteData('save<?php echo $i ?>','saved<?php echo $i ?>')" class=" heart-btns saveButton d-block" id="save<?php echo $i ?>" value="<?php echo $property_data['propertyID']; ?>"><i class="bi bi-heart heart-icons" ></i></button>
                                                  <button onclick="favoriteData('save<?php echo $i ?>','saved<?php echo $i ?>')" class="heart-btns unsaveButton d-none" id="saved<?php echo $i ?>" value="unsave"> <i class="bi bi-heart-fill heart-icons"></i></button>
                                             <?php
                                             }
                                        }
                                   }
                                   ?>

                                   <div class="carousel-item active">
                                        <img src="<?php echo $imgfeatured1; ?>" class="d-block card-img" alt="...">
                                   </div>
                                   <div class="carousel-item">
                                        <img src="<?php echo $imgfeatured2; ?>" class="d-block card-img" alt="...">
                                   </div>
                                   <div class="carousel-item">
                                        <img src="<?php echo $imgfeatured3; ?>" class="d-block card-img" alt="...">
                                   </div>
                                   </div>
                                   <button class="carousel-control-prev" type="button" data-bs-target="#carousel<?php echo $i ?>" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                   </button>
                                   <button class="carousel-control-next" type="button" data-bs-target="#carousel<?php echo $i ?>" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                   </button>
                                   </div>
                                   <!-- card body -->
                                   <div class="card-body px-3 mt-3">
                                   <h5 class="card-title txts-bld ms-1"><?php echo $property_data['propertyTitle']; ?></h5>
                                   <div class="div-location d-flex mt-3">
                                        <i class="bi bi-geo-alt-fill ms-1 "></i> 
                                        <p class="card-text mt-1">&nbsp;<?php echo $property_data['propertyBarangay'] . ', ' .  $property_data['propertyCity']; ?></p>
                                   </div>
                                   
                                   <div class="div-price d-flex align-items-center gap-2 mt-2">
                                        <p class="card-price ms-1">₱ <?php echo number_format($property_data['propertyPrice']); ?></p>
                                        <p class="card-per txts-bld"> per month</p>
                                   </div>

                                   <div class="div-details d-flex mt-3 align-items-center gap-4 ps-1">
                                        <div class="d-flex gap-2 align-items-center justify-content-center">
                                             <img src="imgs/bedroomIcon.png" alt="Bedroom" class="card-icons bed-icon">
                                             <span class="quantity"><?php echo $property_data['propertyBedrooms']; ?></span>
                                        </div>

                                        <div class="d-flex gap-2 align-items-center justify-content-center">
                                             <img src="imgs/bathroomIcon.png" alt="Bathroom" class="card-icons">
                                             <span class="quantity"><?php echo $property_data['propertyBathroom']; ?></span>
                                        </div>

                                        <div class="d-flex gap-2 align-items-center justify-content-center">
                                             <img src="imgs/sqmIcon.png" alt="Floor Area" class="card-icons">
                                             <span class="quantity"><?php echo $property_data['propertyFloorArea']; ?> <span> m<sup>2</sup></span> </span>
                                        </div>
                                   </div>

                                   <div class="d-flex justify-content-center mt-3">
                                        <a href="<?php echo 'viewProperty.php?id=' . $property_data['propertyID']; ?>"  target="_blank" class="btn btn-view-property px-5 py-2">View Property</a>
                                   </div>

                                   <!-- <div class="d-flex justify-content-center mt-3">
                                        <a class="btn btn-view-property px-5 py-2" href="<?php echo 'viewProperty.php?id=' . $property_data['propertyID']; ?>"  target="_blank">View Property</a>
                                   </div> -->
                              </div>
                         </div>
                         <?php
                              }
                         }
                         ?>
                    </div>
               </section>

          </div>
          <div class="d-none">
          <button onclick="dropdownManageFunction()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block" type="button" id="dropdrownbtn-manage" data-bs-toggle="dropdown" aria-expanded="false">
               Manage Renters
                    <i class="bi bi-chevron-down" id="chevron-down-avatar"></i>
                    <i class="bi bi-chevron-up" id="chevron-up-avatar"></i>
                    <i class="bi bi-chevron-down" id="chevron-down-avatar-guest"></i>
                    <i class="bi bi-chevron-up" id="chevron-up-avatar-guest"></i>
                    <i class="bi bi-chevron-down" id="chevron-down-avatar"></i>
                    <i class="bi bi-chevron-up" id="chevron-up-avatar"></i>
                    <i class="bi bi-chevron-down" id="chevron-down-avatar2"></i>
                    <i class="bi bi-chevron-up" id="chevron-up-avatar2"></i>
                    <i class="bi bi-chevron-down icons" id="chevron-down-avatar"></i>
                    <i class="bi bi-chevron-up icons" id="chevron-up-avatar"></i>
                    <i class="bi bi-chevron-down icons" id="chevron-down-manage"></i>
                    <i class="bi bi-chevron-up icons" id="chevron-up-manage"></i>
                    <i class="bi bi-chevron-down icons" id="chevron-down-avatar2"></i>
                    <i class="bi bi-chevron-up icons" id="chevron-up-avatar2"></i>
          </button>
     </div>
     </div>
     <br> <br>



<?php
if(isset($_SESSION['txtLocation1'])){
     unset($_SESSION['txtLocation1']);
}
if(isset($_SESSION['filterPropertytype'])){
     unset($_SESSION['filterPropertytype']);
}
if(isset($_SESSION['filterbedcount'])){
     unset($_SESSION['filterbedcount']);
}
if(isset($_SESSION['filterbathcount'])){
     unset($_SESSION['filterbathcount']);
}
if(isset($_SESSION['txtLocation2'])){
     unset($_SESSION['txtLocation2']);
}
if(isset($_SESSION['txtLocation3'])){
     unset($_SESSION['txtLocation3']);
}
if(isset($_SESSION['txtLocation4'])){
     unset($_SESSION['txtLocation4']);
}
if(isset($_SESSION['choiceNumber'])){
     unset($_SESSION['choiceNumber']);
}
if(isset($_SESSION['filterAmenities'])){
     unset($_SESSION['filterAmenities']);
}
if(isset($_SESSION['searchdata'])){
     unset($_SESSION['searchdata']);
}
if(isset($_SESSION['min'])){
     unset($_SESSION['min']);
}
if(isset($_SESSION['max'])){
     unset($_SESSION['max']);
}
if(isset($_SESSION['priceRange'])){
     unset($_SESSION['priceRange']);
}
?>










<!-- ```````````````````````````````` -->
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="JavaScripts/functionRentals.js"></script>
    <script src="JavaScripts/functionNav.js"></script>

    <script>
          function blurFunction(){
               var up = document.getElementById("chevron-up-manage");
               var down = document.getElementById("chevron-down-manage");
               var upAvatar = document.getElementById("chevron-up-avatar");
               var downAvatar = document.getElementById("chevron-down-avatar");
               var upAvatar2 = document.getElementById("chevron-up-avatar2");
               var downAvatar2 = document.getElementById("chevron-down-avatar2");
               var upAvatarGuest = document.getElementById("chevron-up-avatar-guest"); 
               var downAvatarGuest = document.getElementById("chevron-down-avatar-guest"); 
               var upType = document.getElementById("upType");
               var downType = document.getElementById("downType");
               var upBed = document.getElementById("upBed");
               var downBed = document.getElementById("downBed");
               var upBath = document.getElementById("upBath");
               var downBath = document.getElementById("downBath");
               var upFloor = document.getElementById("upFloor");
               var downFloor = document.getElementById("downFloor");
               var upAmenity = document.getElementById("upAmenity");
               var downAmenity = document.getElementById("downAmenity");
               // SM
               var upTypeSm = document.getElementById("upTypeSm");
               var downTypeSm = document.getElementById("downTypeSm");
               var upBedSm = document.getElementById("upBedSm");
               var downBedSm = document.getElementById("downBedSm");
               var upBathSm = document.getElementById("upBathSm");
               var downBathSm = document.getElementById("downBathSm");
               var upFloorSm = document.getElementById("upFloorSm");
               var downFloorSm = document.getElementById("downFloorSm");
               var upAmenitySm = document.getElementById("upAmenitySm");
               var downAmenitySm = document.getElementById("downAmenitySm");
               // 
               var ddAmenityMenu = document.getElementById("ddAmenityMenu");

               up.style.display = "none";
               down.style.display = "inline-block";

               upAvatar.style.display = "none";
               downAvatar.style.display = "inline-block";

               upAvatar2.style.display = "none";
               downAvatar2.style.display = "inline-block";

               upAvatarGuest.style.display = "none";
               downAvatarGuest.style.display = "inline-block";

               upType.style.display = "none";
               downType.style.display = "inline-block";

               upBed.style.display = "none";
               downBed.style.display = "inline-block";

               upBath.style.display = "none";
               downBath.style.display = "inline-block";

               upFloor.style.display = "none";
               downFloor.style.display = "inline-block";

               upAmenity.style.display = "none";
               downAmenity.style.display = "inline-block";

               // SM
               upTypeSm.style.display = "none";
               downTypeSm.style.display = "inline-block";

               upBedSm.style.display = "none";
               downBedSm.style.display = "inline-block";

               upBathSm.style.display = "none";
               downBathSm.style.display = "inline-block";

               upFloorSm.style.display = "none";
               downFloorSm.style.display = "inline-block";

               upAmenitySm.style.display = "none";
               downAmenitySm.style.display = "inline-block";

               // 
               ddAmenityMenu.style.display = "none";
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

            document.addEventListener("click", function(event) {
            if (event.target.classList.contains("btnSuggestionRental")) {
                var btnSuggest = event.target.value;
                document.getElementById("navfilterLocation").value = btnSuggest;
                document.getElementById("modalfilterLocation").value = btnSuggest;
                document.getElementById("suggestionList").style.visibility = "hidden";
                document.getElementById("suggestionList1").style.visibility = "hidden";
            }
        });
    </script>
</body>
</html>
<?php
// Close the database connection
mysqli_close($con);
?>