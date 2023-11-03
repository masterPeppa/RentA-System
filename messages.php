<?php
    session_start();
    include('DataBase/connection.php');
    if(isset($_SESSION['lEmail']) || isset($_SESSION['rEmail'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentA | Messages</title>
    <link rel="icon" type="image/x-icon" href="imgs/key.ico">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <!-- CSS -->
    <link rel="stylesheet" href="CSS/">
    <link rel="stylesheet" href="CSS/stylesNav.css">
    <link rel="stylesheet" href="CSS/stylesMessages.css">

     <!-- jquery -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

</head>
<body>
    <!-- renter messaging -->
    <?php
        if(isset($_SESSION['rEmail'])){
            $identification = "renter";
            $activeUser = $_SESSION['rEmail'];
            $selectUser = "SELECT * FROM user_renter WHERE rEmail='$activeUser'";
            $executeSelectUser = mysqli_query($con, $selectUser);
            $getUser = mysqli_fetch_assoc($executeSelectUser);
            
            $userProfile = str_replace("../", "", $getUser['rImgProfile']);
            $activeUserId = $getUser['rId'];
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
                        <a class="dropdown-item dropdown-item-first d-flex justify-content-between" href="RentersPage/renterNotifications.php" id="smNotifCount"> 
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item active-dropdown d-flex justify-content-between" href="messages.php" id="smmessageCount">
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
                                    <a class="dropdown-item active-dropdown d-flex justify-content-between" href="messages.php" id="messageCount"> 
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
    <!-- end navbar renter -->


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

<!-- MAIN -->
    <?php
    //checking Message
    
    if(isset($_GET['landlordId'])){
        $ownerId = $_GET['landlordId'];

        $selectOwner = "SELECT * FROM user_landlord WHERE lID='$ownerId'";
        $executeOwner = mysqli_query($con, $selectOwner);
        $getOwnerInfo = mysqli_fetch_assoc($executeOwner);
    
        $ownerProfile = str_replace("../", "", $getOwnerInfo['lImgProfile']);
    }
    //get the messages that has the active user id
    $selectMessages = "SELECT * FROM users_messages WHERE sender='$activeUserId'";
    $executeSelectedMessage = mysqli_query($con, $selectMessages);
    $countMessages = mysqli_num_rows($executeSelectedMessage);

    //check if the user already messsage the landlord
    $selectConnection = "SELECT * FROM conectivity_status WHERE landlord_id='$activeUserId' OR renter_id='$activeUserId'";
    $executeConnection = mysqli_query($con, $selectConnection);
    $getConnection = mysqli_num_rows($executeConnection);

    if($getConnection == 0 && !isset($_GET['landlordId'])){
    ?>
    <!-- NO MESSAGE -->
        <div class="no-message-container">
            <!-- HEADER, TOGETHER WITH THE NAME OF THE OPENED MESSAGE -->
            <div class="grid-2-cols">
                <div class="box-message">
                    <span class="btn-back pe-1"><i class="bi bi-chevron-left"></i></span>
                    <span class="ps-3">Messages</span>
                </div>
                
                <div class="box-message no-box-message">
                </div>
        
                <!-- IF MESSAGE IS EMPTY -->
                <div class="no-message d-flex align-items-center justify-content-center flex-column gap-3">
                    <h4>No messages yet.</h4>
                    <p class="text-center no-msg-txt">You currently have no message.</p>
                    <a href="rentals.php" role="button" class="btn-explore px-4 py-3 d-flex align-items-center justify-content-center gap-2">
                        <span><i class="bi bi-search-heart-fill "></i></span>
                        <span class="no-msg-txt">Explore RentA</span>
                    </a>
                </div>

                <div class="users-list no-message-list">      
                    
                </div>
            </div>
        </div>
        <?php
    }
    else{
        ?>

    <!-- `````````````````` -->

    <!-- THERE'S MESSAGE -->
    <div class="message-container">
        <!-- HEADER, TOGETHER WITH THE NAME OF THE OPENED MESSAGE -->
        <div class="grid-2-cols">

        <!-- 1 -->
            <div class="box-message messages-label">
                <span class="ps-3">Messages</span>
            </div>
                <?php
                        if(isset($_GET['landlordId'])){
                    ?>

            <!-- 2 -->
            <div class="box-message box-name d-flex align-items-center justify-content-between hide">
                    <div class="d-flex div-inside">
                        <span class="btn-back-inside pe-1 d-md-none d-block"><i class="bi bi-chevron-left"></i></span>
                        <span class="ps-3"><?php echo ucwords($getOwnerInfo['lFname']) . " " . ucwords($getOwnerInfo['lLname']); ?></span>
                    </div>
                <!-- verified status -->
                <?php
                if($getOwnerInfo['lStatus'] == "rejected"){
                ?>
                <span class="div-semi-verified d-flex align-items-center gap-2 ">
                    <p class="verified-status">SEMI VERIFIED</p>
                    <img src="imgs/semi-verified.png" alt="" class="img-verified">
                </span>
                <?php
                }
                else if($getOwnerInfo['lStatus'] == "semi-verified"){
                ?>
                <span class="div-semi-verified d-flex align-items-center gap-2 ">
                    <p class="verified-status">SEMI VERIFIED</p>
                    <img src="imgs/semi-verified.png" alt="" class="img-verified">
                </span>
                <?php
                }
                else if($getOwnerInfo['lStatus'] == "fully-verified"){
                ?>
                <span class="div-verified d-flex align-items-center gap-2">
                    <p class="verified-status">FULLY VERIFIED</p>
                    <img src="imgs/verified.png" alt="" class="img-verified">
                </span>
                <?php
                }
                ?>

            </div>
                <?php
                        }
                        else{
                            ?>
                            <div class="box-message box-name d-flex align-items-center justify-content-between hide">
                                
                            </div>
                            <?php
                        }
                        ?>
    
            <!-- 3 -->
            <div class="users-list users-with-message hide" id="userConnected">     
                
            </div><!-- end of  'users-list' div -->
    
    
        <!-- 4 -->
        <section class="chat-area d-flex flex-column">
            <div class="chat-box vh-75" id="messageBody">
                
                      
            </div><!-- end of 'chat-box' div-->
            <div class="typing-area hide py-2 px-4 d-flex">
                <div class="d-none">
                    <input type="text" id="userSender" value="<?php echo $activeUserId; ?>">
                    <input type="text" id="userReceiver" value="<?php echo $ownerId; ?>">
                    <input type="text" id="ownerProfile" value="<?php echo $ownerProfile; ?>">
                    <input type="text" id="userProfile" value="<?php echo $userProfile; ?>">
                    <input type="text" id="identification" value="<?php echo $identification; ?>">
                </div>
                
    <?php if(isset($_GET['landlordId'])){
        if(isset($_SESSION['firstMessage'])){
        ?>
                <input type="text" placeholder="Type message here..." value="<?php echo $_SESSION['firstMessage']?>" id="userMessages">
                <?php
                unset($_SESSION['firstMessage']);
        }
        else {
            ?>
                <input type="text" placeholder="Type message here..." id="userMessages">
            <?php
        }
                ?>
                <button id="btn_sendMessage"><img src="imgs/send.png"></button>
                
    <?php
    }
    ?>
            </div>
        </section>
        </div><!-- end of div with grid -->
    </div>
    <?php
    }
}
    ?>








<!-- `````````` LANDLORD MESSAGING  -->

<?php
    if(isset($_SESSION['lEmail'])){
        $identification = "landlord";
        $activeUser = $_SESSION['lEmail'];
        $delete_query = mysqli_query($con, "DELETE FROM landing_properties WHERE publishing_status='Not yet' AND landlord_id='".$_SESSION['landlordId']."'");
        $delete_query1 = mysqli_query($con, "DELETE FROM landing_properties_new WHERE publishing_status='Not yet' AND landlord_id='".$_SESSION['landlordId']."'");
        $selectUser = "SELECT * FROM user_landlord WHERE lEmail	='$activeUser'";
        $executeSelectUser = mysqli_query($con, $selectUser);
        $getUser = mysqli_fetch_assoc($executeSelectUser);

        $userProfile = str_replace("../", "", $getUser['lImgProfile']);

        $activeUserId = $getUser['lID'];
    ?>
<!-- Navbar - Landlord -->
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
                            <a class="dropdown-item active-dropdown d-flex justify-content-between" href="messages.php" id="smmessageCount"> 
                                
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
                                    <a class="dropdown-item active-dropdown d-flex justify-content-between" href="messages.php" id="messageCount"> 
                                    </a>
                                </li>
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
    <!-- end navbar - landlord -->
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
    <!-- MAIN -->

<!-- `````````````````` -->

<?php
//checking Message

if(isset($_GET['renterId'])){
    $renterMessageId = $_GET['renterId'];

    $selectMessageRenter = "SELECT * FROM user_renter WHERE rId='$renterMessageId'";
    $executeMessageRenter = mysqli_query($con, $selectMessageRenter);
    $getRenterInfo = mysqli_fetch_assoc($executeMessageRenter);

    $renterProfile = str_replace("../", "", $getRenterInfo['rImgProfile']);
}
//get the messages that has the active user id
$selectMessages = "SELECT * FROM users_messages WHERE sender='$activeUserId'";
$executeSelectedMessage = mysqli_query($con, $selectMessages);
$countMessages = mysqli_num_rows($executeSelectedMessage);

//check if the user already messsage the landlord
$selectConnection = "SELECT * FROM conectivity_status WHERE landlord_id='$activeUserId' OR renter_id='$activeUserId'";
$executeConnection = mysqli_query($con, $selectConnection);
$getConnection = mysqli_num_rows($executeConnection);

if($getConnection == 0 && !isset($_GET['renterId'])){
?>
<!-- NO MESSAGE -->
    <div class="no-message-container">
        <!-- HEADER, TOGETHER WITH THE NAME OF THE OPENED MESSAGE -->
        <div class="grid-2-cols">
            <div class="box-message">
                <span class="btn-back pe-1"><i class="bi bi-chevron-left"></i></span>
                <span class="ps-3">Messages</span>
            </div>
            
            <div class="box-message no-box-message">
            </div>
    
            <!-- IF MESSAGE IS EMPTY -->
            <div class="no-message d-flex align-items-center justify-content-center flex-column gap-3">
                <h4>No messages yet.</h4>
                <p class="text-center no-msg-txt">You currently have no message.</p>
                <a href="rentals.php" role="button" class="btn-explore px-4 py-3 d-flex align-items-center justify-content-center gap-2">
                    <span><i class="bi bi-search-heart-fill "></i></span>
                    <span class="no-msg-txt">Explore RentA</span>
                </a>
            </div>

            <div class="users-list no-message-list">      
                
            </div>
        </div>
    </div>
    <?php
}
else{
    ?>

<!-- `````````````````` -->

<!-- THERE'S MESSAGE -->
<div class="message-container">
    <!-- HEADER, TOGETHER WITH THE NAME OF THE OPENED MESSAGE -->
    <div class="grid-2-cols">
        <div class="box-message messages-label">
                <!-- <span class="btn-back-inside pe-1"><i class="bi bi-chevron-left"></i></span> -->
                <span class="">Messages</span>
            </div>
            <?php
                    if(isset($_GET['renterId'])){
                ?>
            <div class="box-message box-name d-flex align-items-center justify-content-between hide">
                <div class="d-flex div-inside">
                    <span class="btn-back-inside pe-1 d-md-none d-block"><i class="bi bi-chevron-left"></i></span>
                    <span class="ps-3"><?php echo ucwords($getRenterInfo['rFname']) . " " . ucwords($getRenterInfo['rLname']); ?></span>
                </div>
                <!-- verified status -->
                <!-- <?php
                // if($getRenterInfo['rStatus'] == "semi-verified"){
                ?>
                <span class="div-semi-verified d-flex align-items-center gap-2 ">
                    <p class="verified-status">SEMI VERIFIED</p>
                    <img src="imgs/semi-verified.png" alt="" class="img-verified">
                </span>
                <?php
                // }
                // else if($getRenterInfo['rStatus'] == "fully-verified"){
                ?>
                <span class="div-verified d-flex align-items-center gap-2">
                    <p class="verified-status">FULLY VERIFIED</p>
                    <img src="imgs/verified.png" alt="" class="img-verified">
                </span>
                <?php
                // }
                // else{
                ?>
                <span class="div-semi-verified d-flex align-items-center gap-2">
                    <p class="verified-status">NOT YET VERIFIED</p>
                    <img src="imgs/not-yet-verified.png" alt="" class="img-verified">
                </span>
                <?php
                // }
                ?> -->

            </div>
            <?php
                    }
                    else{
                        ?>
                        <div class="box-message box-name d-flex align-items-center justify-content-between hide">
                            
                        </div>
                        <?php
                    }
                    ?>

            <!-- IF THERE'S MESSAGE -->
            <div class="users-list users-with-message hide" id="userConnected">     
                
            </div><!-- end of  'users-list' div -->


        <section class="chat-area d-flex flex-column">
            <div class="chat-box vh-75" id="messageBody">
                
            </div><!-- end of 'chat-box' div-->
            <div class="typing-area hide py-2 px-4 d-flex">
                <div class="d-none">
                    <input type="text" id="userSender" value="<?php echo $activeUserId; ?>">
                    <input type="text" id="userReceiver" value="<?php echo $renterMessageId; ?>">
                    <input type="text" id="ownerProfile" value="<?php echo $renterProfile; ?>">
                    <input type="text" id="userProfile" value="<?php echo $userProfile; ?>">
                    <input type="text" id="identification" value="<?php echo $identification; ?>">
                </div>
                
    <?php if(isset($_GET['renterId'])){
            if(isset($_SESSION['firstMessage'])){
            ?>

                    <input type="text" placeholder="Type message here..." value="<?php echo $_SESSION['firstMessage']?>" id="userMessages">
                    <?php
                    unset($_SESSION['firstMessage']);
            }
            else {
                ?>
                    <input type="text" placeholder="Type message here..." id="userMessages">
                <?php
            }
                    ?>
                    <button id="btn_sendMessage"><img src="imgs/send.png"></button>
                    
        <?php
        }
        ?>
                </div>
            </section>
        </div><!-- end of div with grid -->
    </div>
<?php
}
    }
?>








    


    
    <!-- JS -->
    <script src="JavaScripts/functionNav.js"></script>
    <script defer src="JavaScripts/functionOpenMessage.js"></script>

   
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
            var currentUrl = window.location.href;
            if(currentUrl != "http://localhost/RentA/messages.php"){    
                $(".box-name").removeClass("hide");
                $(".messages-label").addClass("hide");
                $(".chat-box").removeClass("hide");
                $(".typing-area").removeClass("hide");
                $(".users-with-message").addClass("hide");

                let messageIntervalId;

                function updateMessage() {
                    $.ajax({
                        url: "Functions/realTimeChat.php",
                        method: "POST",
                        data: {
                            send: $("#userSender").val(),
                            receive: $("#userReceiver").val(),
                            owner: $("#ownerProfile").val(),
                            user: $("#userProfile").val()
                        },
                        dataType: "text",
                        success: function (data) {
                            $("#messageBody").html(data);
                            scrollToBottom();
                        }
                    });
                }

                function startMessageInterval() {
                    messageIntervalId = setInterval(updateMessage, 100); // Change the interval time as needed
                }

                function stopMessageInterval() {
                    clearInterval(messageIntervalId);
                }

                // Start the interval when the page loads
                startMessageInterval();

                // Add a mouseover event listener to the div
                const divMessage = document.getElementById('messageBody');
                divMessage.addEventListener('mouseover', stopMessageInterval);

                // Add a mouseout event listener to resume the interval when the mouse leaves the div
                divMessage.addEventListener('mouseout', startMessageInterval);


            }
            else{
                $(".box-name").addClass("hide");
                $(".messages-label").removeClass("hide");
                $(".chat-box").addClass("hide");
                $(".typing-area").addClass("hide");
                $(".users-with-message").removeClass("hide");
            }

            function updateMessageCount() {
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
                        $("#messageCount").html(data);
                    }
                });
            }

            updateMessageCount();

            setInterval(updateMessageCount, 700);

            function updateNotifications() {
                $.ajax({
                    url: "Functions/realtimeNotif.php",
                    method: "POST",
                    data: {
                        userid: $("#txtUserId").val()
                    },
                    dataType: "text",
                    success: function (data) {
                        $("#smnotifyCircle").html(data);
                        $("#notifyCircle").html(data);
                    }
                });
            }

            updateNotifications();

            setInterval(updateNotifications, 700);

            function scrollToBottom() {
                var scrollableDiv = document.getElementById("messageBody");
                scrollableDiv.scrollTop = scrollableDiv.scrollHeight;
            }
            
            let intervalOrder;

            function updateMessageOrder() {
                $.ajax({
                    url: "Functions/realTimeOrder.php",
                    method: "POST",
                    data: {
                        send: $("#userSender").val(),
                        receive: $("#userReceiver").val()
                    },
                    dataType: "text",
                    success: function (data) {
                        $("#userConnected").html(data);
                    }
                });
            }

            function startIntervalorder() {
                intervalOrder = setInterval(updateMessageOrder, 100); // Change the interval time as needed
            }

            function stopIntervalorder() {
                clearInterval(intervalOrder);
            }

            // Start the interval when the page loads
            startIntervalorder();

            // Add a mouseover event listener to the div
            const divOrder = document.getElementById('userConnected');
            divOrder.addEventListener('mouseover', stopIntervalorder);

            // Add a mouseout event listener to resume the interval when the mouse leaves the div
            divOrder.addEventListener('mouseout', startIntervalorder);

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
                        $("#notifCount").html(data);
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
                        $("#smNotifCount").html(data);
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
        if(isset($_GET['renterId']) && $_GET['renterId'] != ""){
            echo "<script>window.location.href = 'landlordPage/starterPage.php?id=".$_GET['renterId']."'</script>";
        }
        else if(isset($_GET['landlordId']) && $_GET['landlordId'] != ""){
            echo "<script>window.location.href = 'RentersPage/starterPage.php?id=".$_GET['landlordId']."'</script>";
        }
        else{
            echo "<script>window.location.href = 'RentersPage/starterPage.php'</script>";
        }
    }
    // Close the database connection
mysqli_close($con);
?>