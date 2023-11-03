<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentA | View Property</title>
    <link rel="icon" type="image/x-icon" href="imgs/key.ico">

    <!-- Bootstrap CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- CSS -->
    <link rel="stylesheet" href="CSS/">
    <link rel="stylesheet" href="CSS/stylesNavView.css">
    <link rel="stylesheet" href="CSS/stylesLoginAs.css">
    <link rel="stylesheet" href="CSS/stylesViewProperty.css">
    <link rel="stylesheet" href="CSS/stylesModalAmenity.css">
    <link rel="stylesheet" href="CSS/stylesModalReviews.css">
    
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    
    <!-- map api -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    
</head>
<body>
    
    <!-- marker design -->
    <style>
        .txtMarker{
            width: 90px;
            height: 35px;
            font-weight: bold;
            text-align: center;
        }

        .leaflet-popup-tip-container {
           display: none;
        }
    </style>

    <script>
        //map
        document.addEventListener('DOMContentLoaded', function() {
            const modal = new bootstrap.Modal(document.getElementById('listingReviewModal'));
            if(document.getElementById('txtVisitedStatus').value == 'null'){
                modal.show();
            }
            if("l"+document.getElementById("txtActiveUserId").value == document.getElementById("txtViewedProperty").value){
                modal.show();
            }
            var latitude = parseFloat(document.getElementById('txtLatitude').value);
            var longitude = parseFloat(document.getElementById('txtLongitude').value);
            // Create a map centered at a specific location
            var map = L.map('propertyLocation').setView([latitude, longitude], 13);

            // Add a tile layer from OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

            // Add a marker at a specific location with the custom icon
            var marker = L.marker([latitude, longitude]).addTo(map);
            
            marker.bindPopup('<div class="txtMarker">I am over <br>here</div>').openPopup();

            // Disable dragging of the marker
            marker.dragging.disable();
            
            map.removeControl(map.zoomControl);
            map.removeControl(map.attributionControl);

        });
    </script>
<?php
    session_start();
    include('DataBase/connection.php');
    $propertystatus = "";
    $propertyId = $_GET['id'];
    $selectId = "SELECT * FROM landing_properties WHERE propertyID='$propertyId'";
    $executeSelectedid = mysqli_query($con, $selectId);
    $getPropertyinfo = mysqli_fetch_assoc($executeSelectedid);
    $setImg1 = str_replace("../../", "", $getPropertyinfo['imgFeatured1']);
    $setImg2 = str_replace("../../", "", $getPropertyinfo['imgFeatured2']);
    $setImg3 = str_replace("../../", "", $getPropertyinfo['imgFeatured3']);
    
    //get the property owner name
    $ownerId = $getPropertyinfo['landlord_id'];
    $selectOwnersId = "SELECT * FROM user_landlord WHERE lID='$ownerId'";
    $executeOwnerSelected = mysqli_query($con, $selectOwnersId);
    $getOwnerInfo = mysqli_fetch_assoc($executeOwnerSelected);
    $ownerProfile  = str_replace("../", "", $getOwnerInfo['lImgProfile']);

    //get all amenities
    $amenitiesArray = explode(", ", $getPropertyinfo['propertyAmenities']);

    //get all nearby places
    if($getPropertyinfo['propertyNearby'] != NULL){
        $nearbyArray = explode("~", $getPropertyinfo['propertyNearby']);
    
        //separate the $nearbyArray to ay place name, place type, and km
        $firstNearby = explode(",", $nearbyArray[0]);
        $secondNearby = explode(",", $nearbyArray[1]);
        $thirdNearby = explode(",", $nearbyArray[2]);
        $fourthNearby = explode(",", $nearbyArray[3]);

    //set the first to fourth neaby place for condition to specify what nearby places will be displayed for the specific label
    $checkNearby = array($firstNearby[1], $secondNearby[1], $thirdNearby[1], $fourthNearby[1]);

    

}
    $selectcomment = "SELECT * FROM feedback_data WHERE property_id='".$_GET['id']."' ORDER BY commentdate DESC";
    $executecomment = mysqli_query($con, $selectcomment);
    $getcomment = mysqli_fetch_all($executecomment, MYSQLI_ASSOC);

    if(count($getcomment) > 0) {

        //whole value
        $sumRate = 0;
        //cleanliness
        $cleanlinessrate = 0;
        //communication
        $communicationrate = 0;
        //accuracy
        $accuracyrate = 0;
        //accuracy
        $locationrate = 0;
        for($rate = 0; $rate < count($getcomment); $rate++){
            $sumRate += $getcomment[$rate]['cleanliness'] + $getcomment[$rate]['communication'] + $getcomment[$rate]['accuracy'] + $getcomment[$rate]['proplocation'];
            $cleanlinessrate += $getcomment[$rate]['cleanliness'];
            $communicationrate += $getcomment[$rate]['communication'];
            $accuracyrate += $getcomment[$rate]['accuracy'];
            $locationrate += $getcomment[$rate]['proplocation'];
        }
        //whole rate
        $totalrate = round(($sumRate*5)/(20*count($getcomment)), 1);
        //cleanliness total rate
        $cleanlinessrate = round(($cleanlinessrate*5)/(5*count($getcomment)), 1);
        //communication total rate
        $communicationrate = round(($communicationrate*5)/(5*count($getcomment)), 1);
        //accuracy total rate$accuracyrat
        $accuracyrate = round(($accuracyrate*5)/(5*count($getcomment)), 1);
        //location total rate$accuracyrat
        $locationrate = round(($locationrate*5)/(5*count($getcomment)), 1);

    }

?>
<div class="d-none">
    <?php if(count($getcomment) > 0){
        ?>
        <input type="text" id="reviews" value="NotEmpty">
        <input type="text" id="cleanlinessrate" value="<?php echo $cleanlinessrate ?>">
        <input type="text" id="communicationrate" value="<?php echo $communicationrate ?>">
        <input type="text" id="accuracyrate" value="<?php echo $accuracyrate ?>">
        <input type="text" id="locationrate" value="<?php echo $locationrate ?>">
        <?php
    }
    else{
        ?>
        <input type="text" id="reviews" value="Empty">
        <?php
    }
    ?>

</div>
    <div class="container-fluid d-flex-flex-column">
<!-- Navbar - Guest -->
<?php
            if(!isset($_SESSION['rEmail']) && !isset($_SESSION['lEmail']) && !isset($_SESSION['useradmin'])){
                $activeuserid = "NULL";
        ?>
        <div class="nav-container fixed-top" id="navGuest"> <!-- d-md-block d-sm-none -->
            <nav class="navbar navbar-expand-md">
                <div class="container-fluid navbar-width">
                    <!-- for save condition -->
                    <div class="d-none">
                        <input type="text" id="txtEmail" value="null">
                    </div>
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
                    
                    <!-- Avatar - guest on small screen -->
                    <div class="dropdown ms-auto d-sm-block d-md-none">
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
                                <a class="nav-link" href="rentals.php">Find Rentals</a>
                            </li>
                        </ul>

                        <ul class="d-flex align-items-center ms-auto">
                            <!-- Avatar - guest big-->
                            <div class="dropdown">
                                <button onclick="dropdownAvatarFunction2()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block" type="button" id="dropdrownbtn-avatar" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="imgs/profile.png" alt="" class="img-avatar-guest me-1">
                                    <i class="bi bi-chevron-down nav-icons" id="chevron-down-avatar2"></i>
                                    <i class="bi bi-chevron-up nav-icons" id="chevron-up-avatar2"></i>
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
        <?php
             }
            ?>
<!-- end navbar - guest -->

<!-- Navbar - Renter -->
<?php
if(isset($_SESSION['rEmail'])){
    $renterEmail = $_SESSION['rEmail'];
    $selectUser = "SELECT * FROM user_renter WHERE rEmail	='$renterEmail'";
    $executeSelectUser = mysqli_query($con, $selectUser);
    $getUser = mysqli_fetch_assoc($executeSelectUser);
    $activeuserid = "r".$getUser['rId'];

    $userProfile = str_replace("../", "", $getUser['rImgProfile']);
    ?>
<div class="nav-container fixed-top ">
    <nav class="navbar navbar-expand-md px-3 px-md-5">
        <div class="container-fluid navbar-width">

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
                        <a class="dropdown-item dropdown-item-first d-flex justify-content-between active-dropdown" href="renterNotifications.php" id="smnNotifCount"> 
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
                        <a class="nav-link" href="rentals.php">Find Rentals</a>
                    </li>
                    
                    <!-- Manage Renters -->
                    <li class="nav-item dropdown d-none d-sm-none d-md-block">
                        <button onclick="dropdownManageFunction()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block dd-renter-manage" type="button" id="" data-bs-toggle="dropdown" aria-expanded="false">
                            Manage
                            <i class="bi bi-chevron-down nav-icons" id="chevron-down-manage"></i>
                            <i class="bi bi-chevron-up nav-icons" id="chevron-up-manage"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-manage" aria-labelledby="dropdrownbtn-manage">
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
                            <img src="<?php echo $userProfile ?>" alt="" class="img-avatar me-1">
                            <i class="bi bi-chevron-down nav-icons" id="chevron-down-avatar2"></i>
                            <i class="bi bi-chevron-up nav-icons" id="chevron-up-avatar2"></i>

                        <span id="notifyCircle">
                        </span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-avatar-renter" aria-labelledby="dropdrownbtn-avatar">
                                <li>
                                    <a class="dropdown-item dropdown-item-first d-flex justify-content-between " href="RentersPage/renterNotifications.php" id="notifCount"> 
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex justify-content-between" href="messages.php" id="messageCount">
                                         
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
    $activeuserid = "l".$getUser['lID'];

    $userProfile = str_replace("../", "", $getUser['lImgProfile']);

    if(isset($_GET['notifId']) && $_GET['notifId'] != ""){
        $update_notif="UPDATE landlord_notification SET notif_status='read' WHERE id = '".$_GET['notifId']."'";
        $newnotif_update_executed=mysqli_query($con,$update_notif);
    }
    ?>
<div class="nav-container fixed-top d-block" id="navLandlord">
    <nav class="navbar navbar-expand-md px-3 px-md-5">
        <div class="container-fluid navbar-width">
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
                        <!-- <a class="nav-link listProperty" href="landlordPage/listAProperty.php">List a Property</a> -->
                        
                    </li>

                </ul>
                
                <ul class="d-flex align-items-center ms-auto">
                    <!-- Avatar - Landlord big-->
                    <div class="dropdown me-2 d-none d-sm-none d-md-block ">
                        <button onclick="dropdownAvatarFunction2()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block" type="button" id="dropdrownbtn-avatar" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?php echo $userProfile ?>" alt="" class="img-avatar me-1">
                            <i class="bi bi-chevron-down nav-icons" id="chevron-down-avatarL"></i>
                            <i class="bi bi-chevron-up nav-icons" id="chevron-up-avatarL"></i>
                            <div class="d-none">
                                <input type="text" id="txtUserId" value="<?php echo $getUser['lID'] ?>">
                            </div>
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
                                <li><a class="dropdown-item" href="RentersPage/renterProfile.php">My Profile</a></li>
                                <li><a class="dropdown-item dropdown-item-last" data-bs-toggle="modal" data-bs-target="#logoutModal">Log out</a></li>
                            </ul>
                        </div>

                    <!-- List property button -->
                    <div class=" nav-item d-none d-sm-none d-md-block">
                        <!-- <a  class="btn btns listProperty btn_listProperty pt-2" onclick="checklistProperty()">List a Property</a> -->
                        <a onclick="checklistProperty()" class="btn btns listProperty btn_listProperty pt-2">List a Property</a>
                        <!-- <a href="landlordPage/listAProperty.php" >List a Property</a> -->
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

    <!-- MODAL LOGOUT -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content modals container_modalLogout">

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

<!-- MODAL LISTING REVIEW -->
<div class="modal fade" id="listingReviewModal" tabindex="-1" aria-labelledby="logoutModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content modals modal-listing-review">

                <div class="modal-body px-4 mt-3">
                        <div class="d-flex flex-column align-items-center justify-content-center mt-5">
                            <img src="imgs/house-check1.png" alt="" class="img-logout">
                            <h5 class="text-center mt-3">This will be the view of the property you have listed. This view will be available soon after the admin had approved your property. </h5>
                        </div>
                </div>

                <div class="modal-footer d-flex gap-2 p-3">
                    <button type="button" class="btn btn-view-ok modal-logout-btns" data-bs-dismiss="modal">Ok</button>
                  </div>
            </div>
        </div>
    </div>
    <div class="d-none">
        <?php 
            if($getPropertyinfo['occular_visit_status'] == "visited"){
                ?>
                <input type="text" id="txtVisitedStatus" value="<?php echo $getPropertyinfo['occular_visit_status'] ?>">
                <?php
            }
            else if(isset($_SESSION['useradmin'])){
                ?>
                <input type="text" id="txtVisitedStatus" value="<?php echo $_SESSION['useradmin'] ?>">
                <?php
            }
            else{
                ?>
                <input type="text" id="txtVisitedStatus" value="null">
                <?php
            }
            ?>
    </div>
<!-- modal end - LISTING REVIEW -->

    <!-- modal if the user is not a landlord -->
    <!-- <div class="modal fade" id="notlandlordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content modals container_modalnotL ">
                <div class="modal-body notlandlordmodalbody">
                    Log in as renter to be able to message a landlord.
                </div>
                <div class="modal-footer logoutmodalfooter d-flex gap-3 p-3">
                    <button type="button" class="btn btn-cancel px-3 py-1" id="btnOkNot" data-bs-dismiss="modal">Ok</button>
                </div>

            </div>
        </div>
    </div> -->

        <!-- MODAL if user is not logged in or a landlord -->
        <!-- <div class="modal fade" id="notlandlordModal" tabindex="-1" aria-labelledby="logoutModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content modals container_modalLogout modal-not-renter">

                    <div class="modal-body modal-body-logout mt-4">
                        <section class="section_logout">
                            
                            <div class="div-logout d-flex flex-column align-items-center justify-content-center mt-3">
                                <img src="imgs/warning.png" alt="" class="img-logout">
                                <h5 class="text-center mt-1">Log in first as renter to message a landlord.</h5>
                            </div>
                        </section>
                    </div>

                    <div class="modal-footer d-flex gap-2 p-3">
                        <button type="button" class="btn btn-cancel modal-logout-btns" data-bs-dismiss="modal">Ok</button>
                        
                    </div>
                </div>
            </div>
        </div> -->
<!-- modal end - LOGOUT -->

<!-- navbar with save -->
    <div class="nav-container fixed-top d-md-none d-sm-block nav-sm">
        <nav class="navbar navbar-expand-md navbar-view-sm">
            <div class="container-fluid d-flex">

                <div class="btn-back-view" onclick="GorentalsPage()">
                    <i class="bi bi-chevron-left"></i>
                </div>

                <div>
                <?php 
                if(!isset($_SESSION['rEmail']) && !isset($_SESSION['lEmail']) && !isset($_SESSION['useradmin'])){
                ?>
                    <button onclick="saveFunction()" class="nav-save-btns d-block" id="btnNavSave" value="<?php echo $getPropertyinfo['propertyID']; ?>"> Save &nbsp;&nbsp;<i class="bi bi-heart heart-icons" ></i></button>
                    <button onclick="saveFunction()" class="nav-save-btns d-none" id="btnNavSaved" value="unsave"> Saved &nbsp;&nbsp; <i class="bi bi-heart-fill heart-icons"></i></button>
                <?php
                }
                else{
                    if(isset($_SESSION['rEmail'])){
                            $select_favorite = "SELECT * FROM user_favorites WHERE favorite_id='$propertyId' AND user_id='r" . $getUser['rId'] . "'";
                            $favorite_result=mysqli_query($con, $select_favorite);
                            $favorite_count = mysqli_num_rows($favorite_result);
                            if($favorite_count > 0){?>
                                <button onclick="saveFunction()" class="nav-save-btns d-none" id="btnNavSave" value="<?php echo $getPropertyinfo['propertyID']; ?>"> Save &nbsp;&nbsp;<i class="bi bi-heart heart-icons" ></i></button>
                                <button onclick="saveFunction()" class="nav-save-btns d-block" id="btnNavSaved" value="unsave"> Saved &nbsp;&nbsp; <i class="bi bi-heart-fill heart-icons"></i></button>
                            <?php
                            }
                            else{
                            ?>
                            
                                <button onclick="saveFunction()" class="nav-save-btns d-block" id="btnNavSave" value="<?php echo $getPropertyinfo['propertyID']; ?>"> Save &nbsp;&nbsp;<i class="bi bi-heart heart-icons" ></i></button>
                                <button onclick="saveFunction()" class="nav-save-btns d-none" id="btnNavSaved" value="unsave"> Saved &nbsp;&nbsp; <i class="bi bi-heart-fill heart-icons"></i></button>
                                <?php
                                }
                            }
                        }
                        ?>
                </div>

            </div>
        </nav>
    </div>
<!-- end with save -->

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

<!-- Modal - Amenities -->
<div class="modal fade" id="showAmenities" tabindex="-1" aria-labelledby="showAmenities" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content container_modalAmenity">

            <div class="modal-header modal-header-amenity">
                <button type="button" class="btn-close btn-close-amenity" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

            <div class="modal-body modal-body-amenity">
                <section class="section_amenities">
                    <h4 class="text-center mt-3">Amenities</h4>
                    <div class="div-amenity d-flex flex-column align-items-center justify-content-center">
            
                    <!-- AMENITIES SHOW ALL BUTTON -->
                    <?php for($i = 0; $i < count($amenitiesArray); $i++){?>
                        <div id="amenityWifi" class="amenity-item amenity-wifi d-flex justify-content-between align-items-center w-100">
                            <p class="amenity-name"><?php echo $amenitiesArray[$i]; ?></p>
                            <img src="imgs/icons/<?php echo $amenitiesArray[$i]; ?>.png" alt="" class="amenity-icon">
                        </div>
                    <?php
                    } 
                    ?>
                    </div>
                </section>
                
            </div>
        </div>
    </div>
</div>
<!-- modal end - Amenities -->

<!-- MODAL REVIEWS -->
<div class="modal fade" id="modalReviews" tabindex="-1" aria-labelledby="modalReviews" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content container_modalReviews">

            <div class="modal-header modal-header-review">
                <button type="button" class="btn-close btn-close-review" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

            <div class="modal-body modal-body-review">
                <section class="section-reviews d-flex justify-content-center align-items-center flex-column">
                    <div class="review-overall-ratings d-flex align-items-center gap-3 mt-3">
                        <i class="bi bi-star-fill big-star-modal"></i>
                        <h3 class="review-overall-rating"><?php echo $totalrate ?> <span>/ 5</span></p>
                        <h3 class="review-overall-count"> <i class="bi bi-dot"></i><?php echo count($getcomment) ?> reviews</h3>
                    </div>

                <!-- OVERALL RATINGS -->
                    <div class="row w-100 div-overall">

                    <!-- OVERALL CLEANLINESS -->
                        <div class="col-12 mt-3 review-overall-cleanliness">
                            <h6 class="left-side">
                                <div class="overall-label overall-cleanliness">Cleanliness</div>
                            </h6>

                            <div class="middle">
                                <div class="bar-container">
                                    <div class="overall-result-bar overall-cleanliness-bar">
                                        <!-- this area will contain the overall score bar -->
                                    </div>
                                </div>
                            </div>

                            <!-- NUMBER RATING -->
                            <h6 class="right-side ">
                            <div class="overall-result-score overall-cleanliness-score"><?php echo $cleanlinessrate ?></div>
                            </h6>
                        </div>

                    <!-- OVERALL COMMUNICATION -->
                        <div class="col-12 mt-3 review-overall-communication">
                            <h6 class="left-side">
                                <div class="overall-label overall-communication">Communication</div>
                            </h6>

                            <div class="middle">
                                <div class="bar-container">
                                    <div class="overall-result-bar overall-communication-bar">
                                        <!-- this area will contain the overall score bar -->
                                    </div>
                                </div>
                            </div>

                            <!-- NUMBER RATING -->
                            <h6 class="right-side ">
                            <div class="overall-result-score overall-communication-score"><?php echo $communicationrate ?></div>
                            </h6>
                        </div>
                    
                    <!-- OVERALL ACCURACY -->
                        <div class="col-12 mt-3 review-overall-accuracy">
                            <h6 class="left-side">
                                <div class="overall-label overall-accuracy">Accuracy</div>
                            </h6>

                            <div class="middle">
                                <div class="bar-container">
                                    <div class="overall-result-bar overall-accuracy-bar">
                                        <!-- this area will contain the overall score bar -->
                                    </div>
                                </div>
                            </div>
                            <!-- NUMBER RATING -->
                            <h6 class="right-side ">
                            <div class="overall-result-score overall-accuracy-score"><?php echo $accuracyrate ?></div>
                            </h6>
                        </div>


                    <!-- OVERALL LOCATION -->
                        <div class="col-12 mt-3 review-overall-location">
                            <h6 class="left-side">
                                <div class=" overall-label overall-location">Location</div>
                            </h6>

                            <div class="middle">
                                <div class="bar-container">
                                    <div class="overall-result-bar overall-location-bar">
                                        <!-- this area will contain the overall score bar -->
                                    </div>
                                </div>
                            </div>
                            <!-- NUMBER RATING -->
                            <h6 class="right-side ">
                            <div class="overall-result-score overall-location-score"><?php echo $locationrate ?></div>
                            </h6>
                        </div>

                    </div>

                    <!-- INDIVIDUAL REVIEWS -->
                    <div class="individual-reviews d-flex flex-column w-100 mt-3">

                    <?php
                    for($i = 0; $i < count($getcomment); $i++){
                        $commentdate = $getcomment[$i]['commentdate'];
                        $commentdateformat = new DateTime($commentdate);
                        $formattedcommentdate = $commentdateformat->format('F d, Y');

                        $selectcommenter = "SELECT * FROM user_renter WHERE rId='".$getcomment[$i]['renter_id']."'";
                        $executecommenter = mysqli_query($con, $selectcommenter);
                        $getcommenter = mysqli_fetch_assoc($executecommenter);

                        $commenterprofile = str_replace("../", "", $getcommenter['rImgProfile']);
                    ?>
                        <!-- REVIEW -->
                        <div class="individual-review mt-4">
                        
                            <div class="review-specific d-flex gap-2">
                                <img src="<?php echo $commenterprofile ?>" alt="" class="overall-renter-avatar">
                                <div class="d-flex flex-column">
                                    <h6 class="modal-renter-name mt-1"><b><?php echo $getcommenter['rFname'] . " " . $getcommenter['rLname'] ?></b></h6>
                                    <p class="modal-review-date mt-1"><?php echo $formattedcommentdate ?></p>
                                </div>
                            </div>
                            <!-- REVIEW MESSAGE -->
                            <div class="mt-3">
                                <p class="modal-review-message"><?php echo $getcomment[$i]['comment'] ?></p>
                            </div>
                        </div>
                        <?php   
                        }
                        ?>
                        <div class="individual-review mt-4">
                            
                        </div>
                </section>
            </div>
        </div>
    </div>
</div>
<!-- modal end - REVIEWS -->

<!-- MAIN -->

    <div class="main-content container-fluid">

        <!-- VIEW NG ADMIN PAG IAAPPROVE NIA UNG PROPERTY -->
        <?php
        if(isset($_SESSION['useradmin'])){
            $activeuserid = "NULL";
            ?>
        <div class="admins-view d-flex justify-content-center container-fluid pt-3 pb-5">
            <p class="view-main-container">These are the information submitted by the landlord regarding his/her property. 
                Please ensure that all the information matches his/her actual property by conducting an ocular visit before approving.
            </p>
        </div>
        <?php
        }
        ?>
        <!-- PHOTO GALLERY SECTION 3 FEATURED PHOTOS -->
        <div class="d-flex justify-content-center container-fluid">
            <div class="view-main-container d-flex flex-column">
            
                <!-- FEATURED PHOTOS SECTION-->
                <section class="gallery-section">
                    <!-- left big img -->
                    <div class="row gap-2">
                        <div class="col col-img-left">
                        <a href="<?php echo 'propertyGallery.php?id='.$propertyId;?>">
                            <img src="<?php echo $setImg1 ?>" alt="" class="img-left1 img-hover">
                        </a>
                        </div>
                        <!-- right 2 imgs hide on sm -->
                        <div class="col d-md-block d-sm-none d-none">
                            <div class="row gap-2">
                                <div class="col-12 col-img img2">
                                    <a href="<?php echo 'propertyGallery.php?id='.$propertyId;?>">
                                        <img src="<?php echo $setImg2 ?>" alt="" class="img-right2 img-hover">
                                    </a>
                                </div>
                                <div class="col-12 col-img img3">
                                    <a href="<?php echo 'propertyGallery.php?id='.$propertyId;?>">
                                        <img src="<?php echo $setImg3 ?>" alt="" class="img-right3 img-hover">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


                <!-- MAIN BUTTON SECTION -->
                <section class="mt-3 save-section d-flex justify-content-between">
                    <!-- SAVE BUTTON -->
                    <div>
                        <?php
                        if(!isset($_SESSION['rEmail']) && !isset($_SESSION['lEmail']) && !isset($_SESSION['useradmin'])){
                        ?>
                            <button class="btn-save view-btns d-block" id="btnSave" onclick="saveFunction()" value="<?php echo $getPropertyinfo['propertyID']; ?>"> <i class="bi bi-heart heart-icons" ></i>&nbsp;&nbsp;Save</button>
                            <button class="btn-save view-btns d-none" id="btnSaved" onclick="saveFunction()" value="unsave"> <i class="bi bi-heart-fill heart-icons"></i>&nbsp;&nbsp;Saved</button>
                            
                        <?php
                        }
                        else{
                            if(isset($_SESSION['rEmail'])){
                                $select_favorite = "SELECT * FROM user_favorites WHERE favorite_id='$propertyId' AND user_id='r" . $getUser['rId'] . "'";
                                $favorite_result=mysqli_query($con, $select_favorite);
                                $favorite_count = mysqli_num_rows($favorite_result);
                                if($favorite_count > 0){?>
                                    <button class="btn-save view-btns d-none" id="btnSave" onclick="saveFunction()" value="<?php echo $getPropertyinfo['propertyID']; ?>"> <i class="bi bi-heart heart-icons" ></i>&nbsp;&nbsp;Save</button>
                                    <button class="btn-save view-btns d-block" id="btnSaved" onclick="saveFunction()" value="unsave"> <i class="bi bi-heart-fill heart-icons"></i>&nbsp;&nbsp;Saved</button>
                                <?php
                                }
                                else{
                                    ?>
                                    <button class="btn-save view-btns d-block" id="btnSave" onclick="saveFunction()" value="<?php echo $getPropertyinfo['propertyID']; ?>"> <i class="bi bi-heart heart-icons" ></i>&nbsp;&nbsp;Save</button>
                                    <button class="btn-save view-btns d-none" id="btnSaved" onclick="saveFunction()" value="unsave"> <i class="bi bi-heart-fill heart-icons"></i>&nbsp;&nbsp;Saved</button>
                                <?php
                                }
                            }
                        }
                        ?>
                    </div>

                    <!-- VIEW ALL PHOTOS BUTTON -->
                    <div class="d-flex">
                        <a href="<?php echo 'propertyGallery.php?id='.$propertyId;?>"><button class="btn-view-all view-btns" id="btnViewPhotos"> <i class="bi bi-images"></i>&nbsp;&nbsp;View all photos</button></a>
                    </div>
                </section>

            </div>
        </div>

        <!--  INFO SECTION LEFT COLUMN -->
        <div class="d-flex justify-content-center align-items-center mt-5 info-main-container">
        <section class="info-section">
            <div class="row row-details">

                <!-- LEFT COLUMN -->
                <div class="col-lg-7 mt-3">

                    <!-- MAIN DETAILS HEADER SECTION -->
                    <section class="sec-view-header">
                    <?php
                            $selectlease = "SELECT * FROM lease WHERE property_id='$propertyId'";
                            $executelease = mysqli_query($con, $selectlease);
                            $row_lease = mysqli_fetch_all($executelease, MYSQLI_ASSOC);

                            if(count($row_lease) == 0){
                                if($getPropertyinfo['renting_status'] == 'unavailable'){
                                    $propertystatus = "residing";
                                    ?>
                                    <p class="reserved-label px-2 py-1 mb-3 text-center"> <i class="bi bi-house-heart-fill"></i> Rented</p>
                                    <?php
                                }
                                else{
                                    ?>
                                    <p class="reserved-label px-2 py-1 mb-3 text-center"> <i class="bi bi-house"></i> Available</p>
                                    <?php
                                }
                            }
                            else{
                                if($row_lease[$i]['lease_status'] == "signed"){
                                    $propertystatus = "signed";
                                    ?>
                                    <p class="reserved-label px-2 py-1 mb-3 text-center"> <i class="bi bi-house-lock-fill"></i> Reserved</p>
                                    <?php
                                }
                                else if($row_lease[$i]['lease_status'] == "residing" || $row_lease[$i]['lease_status'] == "moved-out" || $getPropertyinfo['renting_status'] == 'unavailable'){
                                    $propertystatus = "residing";
                                    ?>
                                    <p class="reserved-label px-2 py-1 mb-3 text-center"> <i class="bi bi-house-heart-fill"></i> Rented</p>
                                    <?php
                                }
                                else{
                                    ?>
                                    <p class="reserved-label px-2 py-1 mb-3 text-center"> <i class="bi bi-house"></i> Available</p>
                                    <?php
                                }
                            }
                        ?>
                        <h3 class="view-property-title"><?php echo $getPropertyinfo['propertyTitle']; ?></h3>
                        <h5 class="view-property-location mt-3"> <i class="bi bi-geo-alt-fill icons pe-2"></i><?php echo $getPropertyinfo['house_num'] . ', ' . $getPropertyinfo['propertyBarangay'] . ', ' . $getPropertyinfo['propertyCity'] . ', ' . $getPropertyinfo['propertyProvince']; ?></h3>
                        <div class="d-flex gap-2 align-items-center">
                            <h3 class="property-price mt-3">₱ <?php echo number_format($getPropertyinfo['propertyPrice']); ?> </h3> 
                            <p class="mt-3 txts-bld"> per month</p>
                        </div>
                        

                   </section>

                   <!-- DESCRIPTION -->
                   <section class="sec-view-description mt-5">
                        <h4 class="view-titles">Description</h4>
                        <div class="view-description mt-3">
                            <?php echo nl2br(htmlspecialchars($getPropertyinfo['propertyDescription'])); ?>
                    </div>
                    </section>


                    <!-- DETAILS SECTION -->
                    <section class="sec-view-details mt-5">
                        <h4 class="view-titles">Details</h4>
                        <!-- details by column -->
                        <div class="row">
                        <div class="col-6 mt-3">
                                <div class="d-flex justify-content-between">
                                    <p class="detail-name">Floor Area (m<sup>2</sup>)</p>
                                    <p class="detail-specification pe-5"><?php echo $getPropertyinfo['propertyFloorArea']; ?></p>
                                </div>
                            </div>
                            <div class="col-6 mt-3">
                                <div class="d-flex justify-content-between">
                                    <p class="detail-name ps-3">Maximum Occupants</p>
                                    <p class="detail-specification pe-3"><?php echo $getPropertyinfo['maxOccupants']; ?></p>
                                </div>
                            </div>
                            <div class="col-6 mt-3">
                                <div class="d-flex justify-content-between">
                                    <p class="detail-name">Unit/Floor Number</p>
                                    <p class="detail-specification pe-5"><?php echo $getPropertyinfo['propertyUnit']; ?></p>
                                </div>
                            </div>
                            <div class="col-6 mt-3">
                                <div class="d-flex justify-content-between">
                                    <p class="detail-name ps-3">Car Space</p>
                                    <p class="detail-specification pe-3"><?php echo $getPropertyinfo['propertyParkingArea']; ?></p>
                                </div>
                            </div>
                            <div class="col-6 mt-3">
                                <div class="d-flex justify-content-between">
                                    <p class="detail-name">Bedrooms</p>
                                    <p class="detail-specification pe-5"><?php echo $getPropertyinfo['propertyBedrooms']; ?></p>
                                </div>
                            </div>
                            <div class="col-6 mt-3">
                                <div class="d-flex justify-content-between">
                                    <p class="detail-name ps-3">Bathrooms</p>
                                    <p class="detail-specification pe-3"><?php echo $getPropertyinfo['propertyBathroom']; ?></p>
                                </div>
                            </div>
                            <div class="col-6 mt-3">
                                <div class="d-flex justify-content-between">
                                    <p class="detail-name">Pet Friendly</p>
                                    <p class="detail-specification pe-5"><?php echo $getPropertyinfo['propertyPetAllowed']; ?></p>
                                </div>
                            </div>
                            <div class="col-6 mt-3">
                                <div class="d-flex justify-content-between">
                                    <p class="detail-name ps-3">Fully Furnished</p>
                                    <p class="detail-specification pe-3"><?php echo $getPropertyinfo['propertyFullyFurnished']; ?></p>
                                </div>
                            </div> 
                        </div>
                    </section>

                    <!-- AMENITIES SECTION -->
                    <?php 
                    if($amenitiesArray[0] != ""){
                        ?>
                        <section class="sec-view-amenities mt-5 justify-content-start align-items-start">
                            <h4 class="view-titles">Amenities</h4>
                            <div class="row row-amenities d-flex flex-wrap align-items-start">
                            <?php 
                            if(count($amenitiesArray) <= 6){
                                for($i = 0; $i < count($amenitiesArray); $i++){?>
                                    <div class="col-4 d-flex flex-column align-items-center my-4">
                                        <img src="imgs/icons/<?php echo $amenitiesArray[$i];?>.png" class="amenity-icon" alt="">
                                        <p class="amenity-specification mt-2"><?php echo $amenitiesArray[$i]; ?></p>
                                    </div>
                            <?php 
                                } 
                            }
                            else{
                                for($i = 0; $i < 6; $i++){?>
                                    <div class="col-4 d-flex flex-column align-items-center my-4">
                                        <img src="imgs/icons/<?php echo $amenitiesArray[$i]; ?>.png" class="amenity-icon" alt="">
                                        <p class="amenity-specification mt-2"><?php echo $amenitiesArray[$i]; ?></p>
                                    </div>
                            <?php 
                                } 
                                ?>
                                <button type="button" class="view-btns mt-3" id="btnShowAmenity" data-bs-toggle="modal" data-bs-target="#showAmenities">
                                    Show all amenities
                                </button>
                            <?php    
                            }
                            ?>
                                
                            </div>
                        </section>
                    <?php
                    }
                    if(count($getcomment) == 0){
                    ?>
                    <!-- REVIEW SECTION no review yet -->
                    <section class="sec-view-reviews0 mt-5">
                        <h4 class="view-titles">Reviews</h4>
                        <div class="view-reviews mt-3">
                            <div class="review-ratings d-flex align-items-center gap-3 ps-2">
                                <i class="bi bi-star-fill big-star"></i>
                                <h5 class="review-overall-rating">No reviews yet.</h5>
                            </div>
                        </div>
                   </section>
                   <?php
                    }
                    else{
                   ?>
                    <!-- REVIEW SECTION with review -->
                    <section class="sec-view-reviews1 mt-5">
                        <h4 class="view-titles">Reviews</h4>
                        <div class="view-reviews mt-3">
                        <div class="review-ratings d-flex align-items-center gap-3 ps-2">
                            <i class="bi bi-star-fill big-star"></i>
                            <h3 class="review-overall-rating"><?php echo $totalrate ?> <span>/ 5</span></h3>
                            <h4 class="review-count"> <i class="bi bi-dot"></i><?php echo count($getcomment) ?> reviews</h4>
                        </div>

                        <!-- OVERALL RATINGS -->
                    <div class="row w-100 div-overall">

                    <!-- OVERALL CLEANLINESS -->
                        <div class="col-12 mt-3 review-overall-cleanliness">
                            <h6 class="left-side">
                                <div class="overall-label overall-cleanliness">Cleanliness</div>
                            </h6>

                            <div class="middle">
                                <div class="bar-container">
                                    <div class="overall-result-bar overall-cleanliness-bar">
                                        <!-- this area will contain the overall score bar -->
                                    </div>
                                </div>
                            </div>

                            <!-- NUMBER RATING -->
                            <h6 class="right-side ">
                            <div class="overall-result-score overall-cleanliness-score"><?php echo $cleanlinessrate ?></div>
                            </h6>
                        </div>

                    <!-- OVERALL COMMUNICATION -->
                        <div class="col-12 mt-3 review-overall-communication">
                            <h6 class="left-side">
                                <div class="overall-label overall-communication">Communication</div>
                            </h6>

                            <div class="middle">
                                <div class="bar-container">
                                    <div class="overall-result-bar overall-communication-bar">
                                        <!-- this area will contain the overall score bar -->
                                    </div>
                                </div>
                            </div>

                            <!-- NUMBER RATING -->
                            <h6 class="right-side ">
                            <div class="overall-result-score overall-communication-score"><?php echo $communicationrate ?></div>
                            </h6>
                        </div>

                    <!-- OVERALL ACCURACY -->
                        <div class="col-12 mt-3 review-overall-accuracy">
                            <h6 class="left-side">
                                <div class="overall-label overall-accuracy">Accuracy</div>
                            </h6>

                            <div class="middle">
                                <div class="bar-container">
                                    <div class="overall-result-bar overall-accuracy-bar">
                                        <!-- this area will contain the overall score bar -->
                                    </div>
                                </div>
                            </div>
                            <!-- NUMBER RATING -->
                            <h6 class="right-side ">
                            <div class="overall-result-score overall-accuracy-score"><?php echo $accuracyrate ?></div>
                            </h6>
                        </div>


                    <!-- OVERALL LOCATION -->
                        <div class="col-12 mt-3 review-overall-location">
                            <h6 class="left-side">
                                <div class=" overall-label overall-location">Location</div>
                            </h6>

                            <div class="middle">
                                <div class="bar-container">
                                    <div class="overall-result-bar overall-location-bar">
                                        <!-- this area will contain the overall score bar -->
                                    </div>
                                </div>
                            </div>
                            <!-- NUMBER RATING -->
                            <h6 class="right-side ">
                            <div class="overall-result-score overall-location-score"><?php echo $locationrate ?></div>
                            </h6>
                        </div>

                    </div>

                        <?php
                            for($i = 0; $i < count($getcomment); $i++){
                                
                                if($i == 3){
                                    break;
                                }

                                $commentdate = $getcomment[$i]['commentdate'];
                                $commentdateformat = new DateTime($commentdate);
                                $formattedcommentdate = $commentdateformat->format('F d, Y');

                                $selectcommenter = "SELECT * FROM user_renter WHERE rId='".$getcomment[$i]['renter_id']."'";
                                $executecommenter = mysqli_query($con, $selectcommenter);
                                $getcommenter = mysqli_fetch_assoc($executecommenter);

                                $commenterprofile = str_replace("../", "", $getcommenter['rImgProfile']);
                                ?>
                                <div class="review-specific d-flex mt-5 gap-2">
                                    <img src="<?php echo $commenterprofile ?>" alt="" class="renter-review-avatar">
                                    <div class="d-flex flex-column">
                                        <h6 class="renter-name-review mt-1"><b><?php echo $getcommenter['rFname'] . " " . $getcommenter['rLname'] ?></b></h6>
                                        <h6 class="review-date mt-2"><?php echo $formattedcommentdate ?></h6>
                                    </div>
                                   
                                </div>
                                <!-- REVIEW MESSAGE -->
                                <div class="mt-4">
                                    <p class="review-message"><?php echo $getcomment[$i]['comment'] ?></p>
                                </div>
                            <?php   
                                }
                            ?>                          
                            </div>
                        <?php
                        if(count($getcomment) >= 4){
                        ?>
                        <button type="button" class="view-btns mt-3" id="btnShowReviews" data-bs-toggle="modal" data-bs-target="#modalReviews">
                            Show all reviews
                        </button>
                        <?php
                        }
                        ?>

                   </section>
                <?php
                    }
                    ?>
                   <!-- LOCATION SECTION -->
                   <section class="sec-view-location mt-5">
                        <h4 class="view-titles">Location</h4>
                        <div class="view-location mt-3">
                            <div id="propertyLocation" class="location-map"></div>
                        </div>
                   </section>
                   <!-- getting the longitude and latitude from db for js to get -->
                   <div class="d-none">
                            <input type="text" id="txtLatitude" value="<?php echo $getPropertyinfo['propertyLatitude'];?>">
                            <input type="text" id="txtLongitude" value="<?php echo $getPropertyinfo['propertyLongitude'];?>">
                   </div>

                   <!-- LANDMARK SECTION -->
                   <section class="sec-view-landmark mt-5">
                    <h4 class="view-titles">Nearby Landmarks</h4>
                    <div class="view-landmark mt-3">
                    <?php 
                    if($getPropertyinfo['propertyNearby'] != NULL){
                        if($firstNearby[1] == "Market" || $secondNearby[1] == "Market" ||
                        $thirdNearby[1] == "Market" || $fourthNearby[1] == "Market"){    
                    ?> 
                        <!-- MARKET LANDMARK -->
                        <div class="market-landmark d-flex gap-3 flex-column mt-5">
                            <div class="d-flex align-items-center justify-content-between gap-3">
                                <b>Market</b>
                                <img src="imgs/icons/market.png" alt="" class="landmark-icons">
                            </div>
                            <?php
                                if($firstNearby[1] == "Market"){
                            ?>
                            <div class="d-flex justify-content-between">
                                <p class="m-landmark-name"><?php echo $firstNearby[0]; ?></p>
                                <p class="landmark-distance m-landmark-distance"><?php echo $firstNearby[2]; ?></p>
                            </div>
                            <?php
                            }
                                if($secondNearby[1] == "Market"){
                            ?>
                            <div class="d-flex justify-content-between">
                                <p class="t-landmark-name"><?php echo $secondNearby[0]; ?></p>
                                <p class="landmark-distance t-landmark-distance"><?php echo $secondNearby[2]; ?></p>
                            </div>
                            <?php
                            }
                                if($thirdNearby[1] == "Market"){
                            ?>
                            <div class="d-flex justify-content-between">
                                <p class="t-landmark-name"><?php echo $thirdNearby[0]; ?></p>
                                <p class="landmark-distance t-landmark-distance"><?php echo $thirdNearby[2]; ?></p>
                            </div>
                            <?php
                                }
                                if($fourthNearby[1] == "Market")
                            {
                            ?>
                                <div class="d-flex justify-content-between">
                                <p class="t-landmark-name"><?php echo $fourthNearby[0]; ?></p>
                                <p class="landmark-distance t-landmark-distance"><?php echo $fourthNearby[2]; ?></p>
                            </div>
                            <?php
                                }
                                ?>
                        </div>
                        <?php 
                        }

                        if($firstNearby[1] == "School" || $secondNearby[1] == "School" ||
                        $thirdNearby[1] == "School" || $fourthNearby[1] == "School"){    
                        ?>  
                        <!-- SCHOOLS LANDMARK -->
                        <div class="school-landmark d-flex gap-3 flex-column mt-5">
                            <div class="d-flex align-items-center justify-content-between gap-3">
                                <b>Schools</b>
                                <img src="imgs/icons/school.png" alt="" class="landmark-icons">
                            </div>
                            <?php
                                if($firstNearby[1] == "School"){
                            ?>
                            <div class="d-flex justify-content-between">
                                <p class="s-landmark-name"><?php echo $firstNearby[0] ?></p>
                                <p class=" landmark-distance s-landmark-distance"><?php echo $firstNearby[2] ?></p>
                            </div>
                            <?php
                                }
                                if($secondNearby[1] == "School"){
                            ?>
                            <div class="d-flex justify-content-between">
                                <p class="s-landmark-name"><?php echo $secondNearby[0] ?></p>
                                <p class="landmark-distance s-landmark-distance"><?php echo $secondNearby[2] ?></p>
                            </div>
                            <?php
                                }
                                if($thirdNearby[1] == "School"){
                            ?>
                            <div class="d-flex justify-content-between">
                                <p class="s-landmark-name"><?php echo $thirdNearby[0] ?></p>
                                <p class="landmark-distance s-landmark-distance"><?php echo $thirdNearby[2] ?></p>
                            </div>
                            <?php
                                }
                                if($fourthNearby[1] == "School"){
                            ?>
                            <div class="d-flex justify-content-between">
                                <p class="s-landmark-name"><?php echo $fourthNearby[0] ?></p>
                                <p class="landmark-distance s-landmark-distance"><?php echo $fourthNearby[2] ?></p>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                        <?php 
                        }
                        
                        if($firstNearby[1] == "Church" || $secondNearby[1] == "Church" ||
                        $thirdNearby[1] == "Church" || $fourthNearby[1] == "Church"){    
                        ?> 
                        <!-- CHURCH LANDMARK -->
                        <div class="mall-landmark d-flex gap-3 flex-column mt-5">
                            <div class="d-flex align-items-center justify-content-between gap-3">
                                <b>Church</b>
                                <img src="imgs/icons/church.png" alt="" class="landmark-icons"> 
                            </div>
                            <?php
                                if($firstNearby[1] == "Church"){
                            ?>
                            <div class="d-flex justify-content-between">
                                <p class="c-landmark-name"><?php echo $firstNearby[0]; ?></p>
                                <p class="landmark-distance c-landmark-distance"><?php echo $firstNearby[2]; ?></p>
                            </div>
                            <?php
                                }
                                if($secondNearby[1] == "Church"){
                            ?>
                            <div class="d-flex justify-content-between">
                                <p class="c-landmark-name"><?php echo $secondNearby[0]; ?></p>
                                <p class="landmark-distance c-landmark-distance"><?php echo $secondNearby[2]; ?></p>
                            </div>
                            <?php
                                }
                                if($thirdNearby[1] == "Church"){
                            ?>
                            <div class="d-flex justify-content-between">
                                <p class="c-landmark-name"><?php echo $thirdNearby[0]; ?></p>
                                <p class="landmark-distance c-landmark-distance"><?php echo $thirdNearby[2]; ?></p>
                            </div>
                            <?php
                                }
                                if($fourthNearby[1] == "Church"){
                            ?>
                            <div class="d-flex justify-content-between">
                                <p class="c-landmark-name"><?php echo $fourthNearby[0]; ?></p>
                                <p class="landmark-distance c-landmark-distance"><?php echo $fourthNearby[2]; ?></p>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                        <?php 
                        }
                        
                        if($firstNearby[1] == "Other" || $secondNearby[1] == "Other" ||
                        $thirdNearby[1] == "Other" || $fourthNearby[1] == "Other"){    
                        ?> 
                        <!-- OTHERS LANDMARK -->
                        <div class="food-landmark d-flex gap-3 flex-column mt-5">
                            <div class="d-flex align-items-center justify-content-between gap-3">
                                <b>Others</b>
                                <img src="imgs/icons/other.png" alt="" class="landmark-icons"> 
                            </div>
                            <?php
                                if($firstNearby[1] == "Other"){
                            ?>
                            <div class="d-flex justify-content-between">
                                <p class="o-landmark-name"><?php echo $firstNearby[0] ?></p>
                                <p class="landmark-distance o-landmark-distance"><?php echo $firstNearby[2] ?></p>
                            </div>
                            <?php
                                }
                                if($secondNearby[1] == "Other"){
                            ?>
                            <div class="d-flex justify-content-between">
                                <p class="o-landmark-name"><?php echo $secondNearby[0] ?></p>
                                <p class="landmark-distance o-landmark-distance"><?php echo $secondNearby[2] ?></p>
                            </div>
                            <?php
                                }
                                if($thirdNearby[1] == "Other"){
                            ?>
                            <div class="d-flex justify-content-between">
                                <p class="o-landmark-name"><?php echo $thirdNearby[0] ?></p>
                                <p class="landmark-distance o-landmark-distance"><?php echo $thirdNearby[2] ?></p>
                            </div>
                            <?php
                                }
                                if($fourthNearby[1] == "Other"){
                            ?>
                            <div class="d-flex justify-content-between">
                                <p class="o-landmark-name"><?php echo $fourthNearby[0] ?></p>
                                <p class="landmark-distance o-landmark-distance"><?php echo $fourthNearby[2] ?></p>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                        <?php 
                        }
                    }
                    else{
                        ?>
                    <section class="sec-view-reviews0 mt-5">
                        <div class="view-reviews mt-3">
                            <div class="review-ratings d-flex align-items-center gap-3 ps-2">
                                <i class="bi bi-star-fill big-star"></i>
                                <h5 class="review-overall-rating">No places nearby.</h5>
                            </div>
                        </div>
                   </section>
                        <?php
                    }
                        ?> 
                    </div>
                    </section><br>

                    
                </div>
            <!-- end left column -->

                <!--  INFO SECTION RIGHT COLUMN -->
                <!-- CONTACT BOX -->

                <?php
                if(isset($_SESSION['rEmail'])){
                    $userValue = $_SESSION['rEmail'];
                }
                else{
                    $userValue="null";
                }



                ?>
                <div class="col-lg-5 d-flex justify-content-lg-end justify-content-center mt-lg-0 mt-md-5 mt-5">
                    <div class="contact-box d-flex flex-column">
                        <h3 class="contact-header py-3 text-center">Ask about the property</h3>
                        <div class="contact-info">
                            <p class="contact-listing text-center py-2">Listing provided by</p>
                            <div class="contact-landlord my-3 d-flex ps-3 gap-2 justify-content-start">
                                <div class="d-flex flex-column ms-1">
                                    <img src="<?php echo $ownerProfile;?>" alt="" class="contact-landlord-avatar">
                                    <?php 
                                    if($getOwnerInfo['lStatus'] == "rejected"){
                                        ?>
                                    <span class="d-flex gap-1 l-verification-status justify-content-end ">
                                        <img src="imgs/verified.png" alt="" class="view-badge-2" title="VERIFIED">
                                        <!-- rejected -->
                                    </span>
                                    <?php
                                    }
                                    else if($getOwnerInfo['lStatus'] == "fully-verified"){
                                        ?>
                                    <span class="d-flex gap-1 l-verification-status justify-content-end ">
                                        <img src="imgs/verified.png" alt="" class="view-badge-2" title="FULLY VERIFIED">
                                        <!-- VERIFIED -->
                                    </span>
                                    <?php
                                    }
                                    else if($getOwnerInfo['lStatus'] == "semi-verified"){
                                        ?>
                                    <span class="d-flex gap-1 l-verification-status justify-content-end ">
                                        <img src="imgs/verified.png" alt="" class="view-badge-2" title="VERIFIED">
                                        <!-- SEMI VERIFIED -->
                                    </span>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="d-flex flex-column">
                                    <p class="contact-landlord-name"><?php echo $getOwnerInfo['lFname'] . " " . $getOwnerInfo['lLname']; ?></p>
                                    <!-- <p class="contact-landlord-num"></p> -->
                                    <!-- VERIFIED -->

                                    <div class="d-flex align-items-center ">
                                        <i class="bi bi-telephone-fill icons contact-icons pe-1"></i>
                                        <span class="contact-info-l"><?php echo $getOwnerInfo['lNumber']; ?></span>
                                    </div>
                                    <div class="d-flex align-items-center ">
                                    <i class="bi bi-envelope-fill icons contact-icons pe-1"></i>
                                        <span class="contact-info-l"><?php echo $getOwnerInfo['lEmail']; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center flex-column mt-4 w-100 px-3">
                                <textarea name="" class="message-box " id="startMessage" cols="35" rows="5" value="Hi! I would like to know more details about your property.">Hi! I would like to know more details about your property.</textarea>
                                <?php
                                if(isset($_SESSION['rEmail'])){
                                    ?>
                                    <button onclick="messageButton()" class="btn-message-owner btn-view-renter contact-btns mt-3">Message owner</button>
                                    <?php
                                    if($propertystatus == "signed"){
                                    ?>
                                    <button class="btn-apply btn-view-landlord contact-btns mt-3" title="You can't apply. This property is reserved.">Apply</button>
                                    <?php
                                    }
                                    else if($propertystatus == "residing"){
                                        ?>
                                        <button class="btn-apply btn-view-landlord contact-btns mt-3" title="You can't apply. This property is already rented.">Apply</button>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <button onclick="applyButton()" class="btn-apply btn-view-renter contact-btns mt-3">Apply</button>
                                        <?php
                                    }
                                }
                                else if($activeuserid == "l".$getPropertyinfo['landlord_id']){
                                    ?>
                                    <button class="btn-message-owner btn-view-landlord contact-btns mt-3" title="You can't message yourself.">Message owner</button>
                                    <button class="btn-apply btn-view-landlord contact-btns mt-3" title="You can't apply as a landlord.">Apply</button>
                                    <?php
                                }
                                else if(isset($_SESSION['lEmail'])){
                                    ?>
                                    <button class="btn-message-owner btn-view-landlord contact-btns mt-3" title="It is not permissible for you to send message to another landlord.">Message owner</button>
                                    <button class="btn-apply btn-view-landlord contact-btns mt-3" title="You cannot apply as a landlord. Be a renter instead.">Apply</button>
                                    <?php
                                }
                                else if(isset($_SESSION['useradmin'])){
                                    ?>
                                    <button class="btn-message-owner btn-view-landlord contact-btns mt-3" title="This is just a preview.">Message owner</button>
                                    <button class="btn-apply btn-view-landlord contact-btns mt-3" title="This is just a preview.">Apply</button>
                                    <?php
                                }
                                else{
                                    ?>
                                    <button onclick="messageButton()" class="btn-message-owner btn-view-renter contact-btns mt-3" title="Login as renter first.">Message owner</button>
                                    <button onclick="applyButton()" class="btn-apply btn-view-renter contact-btns mt-3" title="Login as renter first.">Apply</button>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
    </div>

    <!-- for admin lang po to -->
    <?php
        if(isset($_SESSION['useradmin'])){
            if(isset($_GET['notifid']) && $_GET['notifid'] != ""){
                $update_notif="UPDATE admin_notification SET notif_status='read' WHERE id = '".$_GET['notifid']."'";
                $newnotif_update_executed=mysqli_query($con,$update_notif);
            }
            else{
                $update_notif="UPDATE admin_notification SET notif_status='read' WHERE landlord_id='$ownerId' AND property_id = '".$_GET['id']."' AND notif_info='List-Property'";
                $newnotif_update_executed=mysqli_query($con,$update_notif);
            }
            ?>
        <div class="d-flex gap-2 mt-5 pt-5 justify-content-center ps-1">
            <span class="admin-back view-main-container " onclick="GobackPage()">
                <i class="bi bi-arrow-left"></i>
                <span>Back</span>
            </span>
        </div>
        <?php
        }
        ?>
    <br><br>
        
    <!-- end - content -->
    </div>

</div>

<div class="d-none">
    <input type="text" id="txtActiveUserId" value="<?php echo $activeuserid ?>">
    <input type="text" id="txtViewedProperty" value="<?php echo "l".$getPropertyinfo['landlord_id'] ?>">
    <input type="text" id="textUser" value="<?php echo $userValue ?>">
    <input type="text" id="messagingButton" value="<?php echo $getOwnerInfo['lID'] ?>">
    <input type="text" id="property_id" value="<?php echo $_GET['id'] ?>">
</div>

<!-- JS -->
<script src="Javascripts/functionNav.js"></script>
<script>
    function blurFunction(){
            var up = document.getElementById("chevron-up-manage");
            var down = document.getElementById("chevron-down-manage");
            var upAvatar = document.getElementById("chevron-up-avatar");
            var downAvatar = document.getElementById("chevron-down-avatar");
            var upAvatar2 = document.getElementById("chevron-up-avatar2");
            var downAvatar2 = document.getElementById("chevron-down-avatar2");
            var upAvatarR = document.getElementById("chevron-up-avatarR");
            var downAvatarR = document.getElementById("chevron-down-avatarR");
            var upAvatarL = document.getElementById("chevron-up-avatarL");
            var downAvatarL = document.getElementById("chevron-down-avatarL");


            up.style.display = "none";
            down.style.display = "inline-block";

            upAvatar.style.display = "none";
            downAvatar.style.display = "inline-block";

            upAvatar2.style.display = "none";
            downAvatar2.style.display = "inline-block";

            upAvatarR.style.display = "none";
            downAvatarR.style.display = "inline-block";

            upAvatarL.style.display = "none";
            downAvatarL.style.display = "inline-block";
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
        function ratings(){
            var rev = document.getElementById('reviews');

            if(rev.value == "NotEmpty"){
                var cleanliness = document.getElementsByClassName('overall-cleanliness-bar');
                var communication = document.getElementsByClassName('overall-communication-bar');
                var accuracy = document.getElementsByClassName('overall-accuracy-bar');
                var location = document.getElementsByClassName('overall-location-bar');

                //chinging the width of this elements
                var cleanliness1 = cleanliness[0];
                var communication1 = communication[0];
                var accuracy1 = accuracy[0];
                var location1 = location[0];

                var cleanliness2 = cleanliness[1];
                var communication2 = communication[1];
                var accuracy2 = accuracy[1];
                var location2 = location[1];

                var cleanlinessValue = document.getElementById('cleanlinessrate');
                var communicationValue = document.getElementById('communicationrate');
                var accuracyValue = document.getElementById('accuracyrate');
                var locationValue = document.getElementById('locationrate');

                cleanliness1.style.width = cleanlinessValue.value * 20 + "%";
                communication1.style.width = communicationValue.value * 20 + "%";
                accuracy1.style.width = accuracyValue.value * 20 + "%";
                location1.style.width = locationValue.value * 20 + "%";

                cleanliness2.style.width = cleanlinessValue.value * 20 + "%";
                communication2.style.width = communicationValue.value * 20 + "%";
                accuracy2.style.width = accuracyValue.value * 20 + "%";
                location2.style.width = locationValue.value * 20 + "%";
            }
        }
        window.onload = function() {
            ratings();
        };
</script>
</body>
</html>
<?php
// Close the database connection
mysqli_close($con);
?>