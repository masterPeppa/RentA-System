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
    <title>RentA</title>
    <link rel="icon" type="image/x-icon" href="imgs/key.ico">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <!-- CSS -->
    <link rel="stylesheet" href="CSS/">
    <link rel="stylesheet" href="CSS/stylesLoginAs.css">
    <link rel="stylesheet" href="CSS/stylesIndex.css">
    <link rel="stylesheet" href="CSS/stylesNav.css">

    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script>
        $(document).ready(function(){
            var successful = document.getElementById("successful").value;

            if(successful == 1) {
                $("#loginSuccessModal").modal('show');
            }
            
    });
    function explore(){
        var newUrl = "../RentA/";
        window.history.pushState({path: newUrl}, "", newUrl);
    }
    function showSuggestion(name){ 
			
            if (name.length == 0) {
                document.getElementById("suggestionList").innerHTML = "";
                document.getElementById("suggestionList").style.visibility = "hidden";
                return;
            }
            else{
                http = new XMLHttpRequest();
                
                http.onreadystatechange = function() {
                    
                    if (http.readyState == 4 && http.status == 200) { 
                    
                        document.getElementById("suggestionList").innerHTML = http.responseText;
                        document.getElementById("suggestionList").style.visibility = "visible";
                    }
                    else{
                        
                        document.getElementById("suggestionList").innerHTML = "Loading...";
                        document.getElementById("suggestionList").style.visibility = "visible";
                    }
                };
                if (name.includes("sto")) {
                    name = name.replace(/\bsto\b/g, "santo");
                }
                if (name.includes(".")) {
                    name = name.replace(".", " ");
                }
                if (name.includes(",")) {
                    name = name.replace(",", " ");
                }
                if (name.includes("  ")) {
                    name = name.replace(" ", "");
                }
                if (name.includes("sta")) {
                    name = name.replace(/\bsta\b/g, "santa");
                }
                http.open("GET", "Functions/gettextlocation.php?q=" + name, true); 
                http.send(); 
            }
        } 
        document.addEventListener("click", function(event) {
            if (event.target.classList.contains("btnSuggestion")) {
                var btnSuggest = event.target.value;
                document.getElementById("searchbar").value = btnSuggest;
                document.getElementById("suggestionList").style.visibility = "hidden";

                sendingSearchValue();
            }
        });
    </script>
</head>
<body>

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

    <div class="container-fluid d-flex flex-column">
    <!-- Navbar - Guest -->
    <?php
    if(isset($_GET['start']) && $_GET['start'] == 1){
    ?>
    <div class="d-none">
        <input type="text" id="successful" value="1">
    </div>
        <?php
    }
    else{
        ?>
    <div class="d-none">
        <input type="text" id="successful" value="0">
    </div>
        <?php
    }
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
                    <div class="dropdown ms-auto d-sm-block d-md-none">
                        <button onclick="dropdownAvatarFunction()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block" type="button" id="dropdrownbtn-avatar" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="imgs/profile.png" alt="" class="img-avatar">
                            <i class="bi bi-chevron-down nav-icons" id="chevron-down-avatar"></i>
                            <i class="bi bi-chevron-up nav-icons" id="chevron-up-avatar"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-avatar-renter-sm " aria-labelledby="dropdrownbtn-avatar">
                            <li><a class="dropdown-item dropdown-item-first" data-bs-toggle="modal" data-bs-target="#modal_loginAs" href="#">Log In / Register</a></li>
                            <li><a class="dropdown-item dropdown-item-last" href="landlordPage/starterPage.php?action=listproperty">List a property</a></li>
                        </ul>
                    </div>

                    <!-- links center -->
                    <div class="collapse navbar-collapse" id="navMenuGuest">

                        <ul class="navbar-nav navbar-nav-renter d-flex align-items-center ms-auto">
                            <li class="nav-item px-3">
                                <a class="nav-link nav-link-home active-dropdown" href="#">Home</a>
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

        $selectresidinglease = "SELECT * FROM lease WHERE renter_id='".$getUser['rId']."' AND lease_status='residing'";
        $executeresidinglease = mysqli_query($con, $selectresidinglease);
        $getresidinglease = mysqli_fetch_all($executeresidinglease, MYSQLI_ASSOC);

            for($i = 0; $i < count($getresidinglease); $i++){

                $selectrenternotif = "SELECT * FROM renter_notification WHERE landlord_id='".$getresidinglease[$i]['landlord_id']."' AND renter_id='".$getresidinglease[$i]['renter_id']."' AND notif_info='contract-expiring' AND notif_status='unread'";
                $executerenternotif = mysqli_query($con, $selectrenternotif);
                $getrenternotifcount = mysqli_num_rows($executerenternotif);

                $currentYear = date("Y-m-d");
                $oneYearLater = date("Y-m", strtotime($getresidinglease[$i]['move_out_data']));
                $onewholeYearLater = date("Y-m-d", strtotime($getresidinglease[$i]['move_out_data']));

                $onecurrentdate = date("Y-m", strtotime($currentYear . " +1 month"));

                if ($oneYearLater == $onecurrentdate) {
                    if($getrenternotifcount == 0){
                        date_default_timezone_set('Asia/Manila');
                        $created_Time = date("Y-m-d H:i:s");
                        
                        $insertNotif = "INSERT INTO renter_notification (landlord_id, renter_id, property_id, notif_info, notif_date, notif_status) 
                        VALUES ('".$getresidinglease[$i]['landlord_id']."', '".$getresidinglease[$i]['renter_id']."', '".$getresidinglease[$i]['property_id']."', 'contract-expiring', '$created_Time', 'unread')";
                        $executeInsertNotif = mysqli_query($con, $insertNotif);
                    }
                }
                else if($currentYear == $onewholeYearLater){
                    $update_lease ="UPDATE lease SET lease_status='moved-out' WHERE landlord_id='".$getresidinglease[$i]['landlord_id']."' AND renter_id='".$getresidinglease[$i]['renter_id']."' AND property_id='".$getresidinglease[$i]['property_id']."' AND lease_status='residing'";
                    $newnotif_lease = mysqli_query($con,$update_lease);

                    $delete_application = mysqli_query($con, "DELETE FROM application_data WHERE renter_id='".$getresidinglease[$i]['renter_id']."' AND landlord_id='".$getresidinglease[$i]['landlord_id']."' AND property_id='".$getresidinglease[$i]['property_id']."' AND agreement='applied'");
                }
            }
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
                        <a class="dropdown-item d-flex justify-content-between" href="messages.php" id="smmessageCount"> 
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
                                <a class="dropdown-item d-flex justify-content-between" href="messages.php" id="messageCount"> 
                                </a>
                            </li>
                            <li><a class="dropdown-item" href="favorites.php">Favorites</a></li>
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
        $delete_query = mysqli_query($con, "DELETE FROM landing_properties WHERE publishing_status='Not yet' AND landlord_id='".$getUser['lID']."'");
        $delete_query1 = mysqli_query($con, "DELETE FROM landing_properties_new WHERE publishing_status='Not yet' AND landlord_id='".$getUser['lID']."'");

        $userProfile = str_replace("../", "", $getUser['lImgProfile']);

        $selectresidinglease = "SELECT * FROM lease WHERE landlord_id='".$getUser['lID']."' AND lease_status='residing'";
        $executeresidinglease = mysqli_query($con, $selectresidinglease);
        $getresidinglease = mysqli_fetch_all($executeresidinglease, MYSQLI_ASSOC);

            for($i = 0; $i < count($getresidinglease); $i++){
                $selectrenternotif = "SELECT * FROM renter_notification WHERE landlord_id='".$getresidinglease[$i]['landlord_id']."' AND renter_id='".$getresidinglease[$i]['renter_id']."' AND notif_info='contract-expiring' AND notif_status='unread'";
                $executerenternotif = mysqli_query($con, $selectrenternotif);
                $getrenternotifcount = mysqli_num_rows($executerenternotif);

                $currentYear = date("Y-m-d");
                $oneYearLater = date("Y-m", strtotime($getresidinglease[$i]['move_out_data']));
                $onewholeYearLater = date("Y-m-d", strtotime($getresidinglease[$i]['move_out_data']));

                $onecurrentdate = date("Y-m", strtotime($currentYear . " +1 month"));

                if ($oneYearLater == $onecurrentdate) {
                    if($getrenternotifcount == 0){
                        date_default_timezone_set('Asia/Manila');
                        $created_Time = date("Y-m-d H:i:s");
                        
                        $insertNotif = "INSERT INTO renter_notification (landlord_id, renter_id, property_id, notif_info, notif_date, notif_status) 
                        VALUES ('".$getresidinglease[$i]['landlord_id']."', '".$getresidinglease[$i]['renter_id']."', '".$getresidinglease[$i]['property_id']."', 'contract-expiring', '$created_Time', 'unread')";
                        $executeInsertNotif = mysqli_query($con, $insertNotif);
                    }
                }
                if($currentYear === $onewholeYearLater){
                    $update_lease ="UPDATE lease SET lease_status='moved-out' WHERE landlord_id='".$getresidinglease[$i]['landlord_id']."' AND renter_id='".$getresidinglease[$i]['renter_id']."' AND property_id='".$getresidinglease[$i]['property_id']."' AND lease_status='residing'";
                    $newnotif_lease = mysqli_query($con,$update_lease);

                    $delete_application = mysqli_query($con, "DELETE FROM application_data WHERE renter_id='".$getresidinglease[$i]['renter_id']."' AND landlord_id='".$getresidinglease[$i]['landlord_id']."' AND property_id='".$getresidinglease[$i]['property_id']."' AND agreement='applied'");
                }
            }
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
                            <a class="dropdown-item d-flex justify-content-between" href="messages.php" id="smmessageCount"> Message
                                
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

    <!-- MODAL LOGGED IN SUCCESSFULLY -->
    <div class="modal fade" id="loginSuccessModal" tabindex="-1" aria-labelledby="modalLogout" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content container_modalLoginSuccess">
                    <div class="modal-body modal-body-logout">
                        <section class="section_logout">
                            
                            <div class=" d-flex align-items-center justify-content-center mt-5">
                                <img src="imgs/welcome.png" alt="Log Out" class="img-login ms-2">
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                <div class="btn-successful" data-bs-dismiss="modal" onclick="explore()">
                                    <a><span><span><i class="bi bi-search-heart-fill icon-ex-success pe-2"></i></span>Explore</span></a>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    <!-- modal end - LOGGED IN SUCCESSFULLY -->
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

</div>

<!-- HEADER SECTION -->
    <section class="section-header d-flex justify-content-center align-items-center">
        <div class="container-header d-flex justify-content-center align-items-center">
            <div class="txts-header mt-auto d-flex flex-column justify-content-center align-items-center">
                <h1 class="">Find Your Home Easily.</h1>
                <h4>Search your home easily and quickly here</h3>
                <div class="d-flex flex-column search-div">
                    <div class="d-flex" >
                        <input type="text" name="" id="searchbar" placeholder="Search for a location" onkeyup="showSuggestion(this.value)" autocomplete="off">
                        <button class="btn-search" onclick="sendingSearchValue()"><img src="imgs/searchIcon.png" alt="" class="search-icon"></button>
                    </div>
                    <div id="suggestionList" class="suggestion-list-index" ></div>
                </div>
                
            </div>
        </div>
    </section>

<!-- PROPERTIES SECTION-->
    <section class="sections section-properties">
        <div class="d-flex flex-column justify-content-center align-items-center" >
            <h1 class="section-titles mb-5">RentA Properties</h1>
            <!-- <p class="text-center mt-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p> -->
        </div>
    </section>

<!-- PROPERTY CARDS  -->
    <section class="mt-3 section-cards ">
    <div class="wrapper-cards d-grid">
        <?php 
    $select_query = "SELECT * FROM landing_properties WHERE publishing_status='Published' AND occular_visit_status='visited'";
    $result=mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    $_SESSION['usedIDs'] = array();
    for($i = 0; $i < 4; $i++){
        if($row_count > $i){
        //select the id that not exist in the session array
        $selectId = "SELECT * FROM landing_properties WHERE publishing_status='Published' AND occular_visit_status='visited' AND propertyID NOT IN ('" . implode("','", $_SESSION['usedIDs']) . "') ORDER BY RAND() LIMIT 1";
        $executeSelectId = $con->query($selectId);

        if ($executeSelectId->num_rows > 0) {

            // Fetch the random row as an associative array
            $random_row = mysqli_fetch_assoc($executeSelectId);

            // Add the new random ID to the used IDs array in the session
            $_SESSION['usedIDs'][] = $random_row['propertyID'];

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
            <div class="card card-property">
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
                            <p class="card-text card-address mt-1">&nbsp;<?php echo $property_data['propertyBarangay'] . ', ' . $property_data['propertyCity']; ?></p>
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
                </div>
            </div>
            <?php 
            }
            else{
                ?>

        <!-- CARD 2 -->
            <div class="card card-property">
            
                <!-- carousel -->
                <div id="carousel<?php echo $i ?>" class="carousel" data-bs-interval="false" data-bs-ride="carousel">
                
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carousel<?php echo $i ?>" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carousel<?php echo $i ?>" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carousel<?php echo $i ?>" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                    
                        <button onclick="favoriteData('save<?php echo $i ?>','saved<?php echo $i ?>')" class=" heart-btns" id="" ><i class="bi bi-heart heart-icons" ></i></button>
                        <button onclick="favoriteData('save<?php echo $i ?>','saved<?php echo $i ?>')" class="heart-btns d-none" id=""> <i class="bi bi-heart-fill heart-icons"></i></button>
                        
                        <div class="carousel-item active">
                            <img src="imgs/property/interior.jpg" class="d-block card-img" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="imgs/property/in.png" class="d-block card-img" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="imgs/property/cover.jpg" class="d-block card-img" alt="...">
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
                        <h5 class="card-title txts-bld ms-1">Apartment for Rent</h5>
                        <div class="div-location d-flex mt-3">
                            <i class="bi bi-geo-alt-fill ms-1"></i> 
                            <p class="card-text card-address mt-1">&nbsp; Malolos, Bulacan</p>
                        </div> 
                    
                        <div class="div-price d-flex align-items-center gap-2 mt-2">
                            <p class="card-price ms-1"> ₱ 15,000</p>
                            <p class="card-per txts-bld"> per month</p>
                        </div>
                        
                        <div class="div-details d-flex mt-3 align-items-center gap-4 ps-1">
                            <div class="d-flex gap-2 align-items-center justify-content-center">
                                <img src="imgs/bedroomIcon.png" alt="Bedroom" class="card-icons bed-icon">
                                <span class="quantity">1</span>
                            </div>

                            <div class="d-flex gap-2 align-items-center justify-content-center">
                                <img src="imgs/bathroomIcon.png" alt="Bathroom" class="card-icons">
                                <span class="quantity">1</span>
                            </div>

                            <div class="d-flex gap-2 align-items-center justify-content-center">
                                <img src="imgs/sqmIcon.png" alt="Floor Area" class="card-icons">
                                <span class="quantity">30 <span> m<sup>2</sup></span> </span>
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
            ?>
            </div>
    <!-- VIEW ALL PROPERTY -->
        <div class="d-flex justify-content-center mt-5">
            <a href="rentals.php" class="text-center a-view" >View all properties <i class="bi bi-arrow-right"></i></a> 
        </div>
    </section>

    <!-- STEPS SECTION -->
    <section class="sections section-steps ">
        <div class="d-flex flex-column justify-content-center align-items-center ">
        <h1 class="section-titles text-center">Renting has never been easier</h1>
            <div class="div-steps d-flex flex-column mt-3 ">

                <div class="div-step d-flex align-items-center ">
                    <img src="imgs/step1.png" alt="" class="">
                    <div class="d-flex flex-column txt-steps mt-3 ms-5 ">
                        <h3>Search the kind of property you want</h3>
                        <h5 class="mt-3">We have a variety of the most relevant filters to help you narrow down your search.</h5>
                    </div>
                </div>

                <div class="div-step d-flex align-items-center mt-3 ">
                    <img src="imgs/step2.png" alt="">
                    <div class="d-flex flex-column txt-steps mt-3 ms-5">
                        <h3>Contact the landlord</h3>
                        <h5 class="mt-3">Landlords are eager to help you get what you want.</h5>
                    </div>
                </div>

                <div class="div-step d-flex align-items-center mt-3">
                    <img src="imgs/step3.png" alt="">
                    <div class="d-flex flex-column txt-steps mt-3 ms-5">
                        <h3>Submit an application</h3>
                        <h5 class="mt-3">Applying to rentals is easy and just takes a few minutes.</h5>
                    </div>
                </div>

                <div class="div-step d-flex align-items-center mt-3">
                    <img src="imgs/step4.png" alt="">
                    <div class="d-flex flex-column txt-steps mt-3 ms-5">
                        <h3>Sign your lease</h3>
                        <h5 class="mt-3">Digitally review and sign a lease.</h5>
                    </div>
                </div>
            
            </div>
        </div>
    </section>

    <br><br>


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
// Close the database connection
mysqli_close($con);
?>